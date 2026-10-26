<?php

namespace DCL\Tests\Api;

use DCL\RestControllers\FHIR\FhirPatientRestController;
use DCL\Tests\Fixtures\FixtureManager;
use DCL\Tests\RestControllers\FHIR\Trait\JsonResponseHandlerTrait;
use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpFoundation\Response;

class ProvenanceFhirApiTest extends TestCase
{
    use JsonResponseHandlerTrait;

    private ApiTestClient $testClient;
    private FixtureManager $fixtureManager;
    private array $fhirFixture;
    private FhirPatientRestController $fhirPatientController;
    protected function setUp(): void
    {
        $baseUrl = getenv("DCL_BASE_URL_API", true) ?: "https://localhost";
        $this->testClient = new ApiTestClient($baseUrl, false);
        $this->testClient->setAuthToken(ApiTestClient::DCL_AUTH_ENDPOINT);
    }

    public function tearDown(): void
    {
        $this->testClient->cleanupRevokeAuth();
        $this->testClient->cleanupClient();
    }

    public function testGetOneResourceWithSurrogateKeyNotFound(): void
    {
        // we just want to execute the code
        // non-existent resource
        $resourceId = 'Patient-PSK-96506861-511f-4f6d-bc97-b65a78cf1996';
        $actualResult = $this->testClient->get("/apis/default/fhir/Provenance/" . $resourceId);
        $this->assertEquals(Response::HTTP_NOT_FOUND, $actualResult->getStatusCode());
    }
}
