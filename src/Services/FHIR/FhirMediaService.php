<?php

/*
 * FhirMediaService.php
 * @package DCL
 * @link      https://www.dcl.org
 * @author    Stephen Nielson <snielson@discoverandchange.com>
 * @copyright Copyright (c) 2025 Stephen Nielson <snielson@discoverandchange.com>
 * @license   https://github.com/DCL/DCL/blob/master/LICENSE GNU General Public License 3
 */

namespace DCL\Services\FHIR;

use DCL\FHIR\R4\FHIRDomainResource\FHIRMedia;
use DCL\FHIR\R4\FHIRElement\FHIRAttachment;
use DCL\FHIR\R4\FHIRElement\FHIRMeta;
use DCL\FHIR\R4\FHIRElement\FHIRUrl;
use DCL\Services\DocumentService;
use DCL\Services\FHIR\Traits\BulkExportSupportAllOperationsTrait;
use DCL\Services\FHIR\Traits\FhirBulkExportDomainResourceTrait;
use DCL\Services\FHIR\Traits\FhirServiceBaseEmptyTrait;
use DCL\Services\Search\FhirSearchParameterDefinition;
use DCL\Services\Search\SearchFieldType;
use DCL\Services\Search\SearchModifier;
use DCL\Services\Search\ServiceField;
use DCL\Services\Search\StringSearchField;
use DCL\Services\Search\TokenSearchField;
use DCL\Services\Search\TokenSearchValue;
use DCL\Validators\ProcessingResult;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class FhirMediaService extends FhirServiceBase implements IFhirExportableResourceService, IPatientCompartmentResourceService
{
    use FhirServiceBaseEmptyTrait;
    use BulkExportSupportAllOperationsTrait;
    use FhirBulkExportDomainResourceTrait;

    /**
     * @var DocumentService The DCL Document Service
     */
    private DocumentService $service;

    public function __construct(?string $fhirApiURL = null)
    {
        parent::__construct($fhirApiURL);
        $this->service = new DocumentService();
    }

    public function setSession(SessionInterface $session): void
    {
        parent::setSession($session);
        $this->service->setSession($session);
    }

    /**
     * Returns an array mapping FHIR Media Resource search parameters to DCL Media search parameters
     * @return array The search parameters
     */
    protected function loadSearchParameters(): array
    {
        return  [
            '_id' => new FhirSearchParameterDefinition('uuid', SearchFieldType::TOKEN, [new ServiceField('uuid', ServiceField::TYPE_UUID)]),
            '_lastUpdated' => $this->getLastModifiedSearchField(),
            'patient' => $this->getPatientContextSearchField(),
            'content-type' => new FhirSearchParameterDefinition('content-type', SearchFieldType::STRING, ['mimetype']),
            'title' => new FhirSearchParameterDefinition('title', SearchFieldType::STRING, ['name']),
        ];
    }


    public function getPatientContextSearchField(): FhirSearchParameterDefinition
    {
        return new FhirSearchParameterDefinition('patient', SearchFieldType::REFERENCE, [new ServiceField('puuid', ServiceField::TYPE_UUID)]);
    }

    public function getLastModifiedSearchField(): ?FhirSearchParameterDefinition
    {
        return new FhirSearchParameterDefinition('_lastUpdated', SearchFieldType::DATETIME, ['date']);
    }

    /**
     * @inheritDoc
     */
    public function parseDCLRecord($dataRecord = [], $encode = false): FHIRMedia|string|false
    {
        $fhirMedia = new FHIRMedia();
        $fhirMeta = new FHIRMeta();
        $fhirMeta->setVersionId('1');
        if (!empty($dataRecord['date'])) {
            $fhirMeta->setLastUpdated(UtilsService::getLocalDateAsUTC($dataRecord['date']));
        } else {
            $fhirMeta->setLastUpdated(UtilsService::getDateFormattedAsUTC());
        }
        $fhirMedia->setMeta($fhirMeta);

        $fhirMedia->setId($dataRecord['uuid']);
        $fhirMedia->setStatus('completed'); // if the file is uploaded it is completed

        if (!empty($dataRecord['puuid'])) {
            $fhirMedia->setSubject(UtilsService::createRelativeReference('Patient', $dataRecord['puuid']));
        }

        $attachment = new FHIRAttachment();
        $url = $this->getFhirApiURL() . '/fhir/Binary/' . $dataRecord['uuid'];
        $attachment->setContentType($dataRecord['mimetype']);
        $attachment->setUrl(new FHIRUrl($url));
        $attachment->setTitle($dataRecord['name'] ?? '');
        $fhirMedia->setContent($attachment);

        if ($encode) {
            return json_encode($fhirMedia);
        }
        return $fhirMedia;
    }

    /**
     * @inheritDoc
     */
    protected function searchForDCLRecords($DCLSearchParameters): ProcessingResult
    {
        if (isset($DCLSearchParameters['patient'])) {
            // make sure that no other modifier such as NOT_EQUALS, OR missing=true is sent which would let system file names be
            // leaked out in the API
            $DCLSearchParameters['patient']->setModifier(SearchModifier::EXACT);
        } else {
            // make sure we only return documents that are tied to patients
            $DCLSearchParameters['patient'] = new TokenSearchField('puuid', [new TokenSearchValue(false, null)]);
            $DCLSearchParameters['patient']->setModifier(SearchModifier::MISSING);
        }
        // only pull in media with supported mimetypes
        $supportedMimetypes = ['application/dicom', 'image/jpeg', 'image/png', 'image/gif', 'image/bmp', 'image/tiff', 'video/mp4', 'video/quicktime'];
        if (isset($DCLSearchParameters['mimetype'])) {
            // grab all of the mime type codes
            /**
             * @var StringSearchField
             */
            $mimetype = $DCLSearchParameters['mimetype'];
            $mimetypeValues = $mimetype->getValues();
            $filteredMimetypes = array_intersect($mimetypeValues, $supportedMimetypes);
            $DCLSearchParameters['mimetype'] = new StringSearchField(
                'mimetype',
                array_values($filteredMimetypes),
                SearchModifier::EXACT
            );
        } else {
            $DCLSearchParameters['mimetype'] = new StringSearchField(
                'mimetype',
                $supportedMimetypes,
                SearchModifier::EXACT
            );
        }

        return $this->service->search($DCLSearchParameters);
    }
}
