<?php

/**
 * PatientRetrieveOffsiteDocument
 *
 * @package   DCL
 * @link      https://www.dcl.org
 * @author    Sherwin Gaddis <sherwingaddis@gmail.com>
 * @copyright Copyright (c) 2024 Sherwin Gaddis <sherwingaddis@gmail.com>
 * @license   https://github.com/DCL/DCL/blob/master/LICENSE GNU General Public License 3
 */

namespace DCL\Events\PatientDocuments;

use Document;
use Symfony\Contracts\EventDispatcher\Event;

class PatientRetrieveOffsiteDocument extends Event
{
    const REMOTE_DOCUMENT_LOCATION = 'remote.document.retrieve.location';
    private $offsiteUrl;
    public function __construct(private readonly string $url, private readonly ?Document $document = null)
    {
    }

    /**
     * Returns the DCL document class that represents this document in the file system
     * @return Document|null
     */
    public function getDCLDocument(): ?Document
    {
        return $this->document;
    }

    public function getDCLDocumentUrl(): string
    {
        return $this->url;
    }

    public function setOffsiteUrl(string $offsiteUrl): void
    {
        $this->offsiteUrl = $offsiteUrl;
    }

    public function getOffsiteUrl()
    {
        return $this->offsiteUrl;
    }
}
