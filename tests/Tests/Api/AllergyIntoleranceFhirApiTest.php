<?php

namespace DCL\Tests\Api;

use DCL\RestControllers\FHIR\FhirPatientRestController;
use DCL\Tests\Fixtures\FixtureManager;
use DCL\Tests\RestControllers\FHIR\Trait\JsonResponseHandlerTrait;
use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpFoundation\Response;

class AllergyIntoleranceFhirApiTest extends TestCase
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
//        $this->baseUrl = $baseUrl;
//        $this->oauthBaseUrl = $baseUrl . self::CAPABILITY_OAUTH_PREFIX;

        $this->fixtureManager = new FixtureManager();
        $this->fhirFixture = (array) $this->fixtureManager->getSingleFhirPatientFixture();
        $this->fhirPatientController = new FhirPatientRestController();
        unset($this->fhirFixture['id']);
        unset($this->fhirFixture['meta']);
    }

    public function tearDown(): void
    {
        $this->fixtureManager->removePatientFixtures();
        $this->testClient->cleanupRevokeAuth();
        $this->testClient->cleanupClient();
    }

    public function testGetBy_patient(): void
    {
        $actualResult = $this->fhirPatientController->post($this->fhirFixture);
        $contents = $this->getJsonContents($actualResult);
        $fhirId = $contents['uuid'];

        $actualResult = $this->testClient->get("/apis/default/fhir/AllergyIntolerance", ['patient' => $fhirId]);
        $this->assertEquals(Response::HTTP_OK, $actualResult->getStatusCode());
        $body = $actualResult->getBody()->getContents();
        $this->assertNotEmpty($body, "AllergyIntolerance search by patient should have returned a result");
        $contents = json_decode((string) $body, true);
        $this->assertArrayhasKey("total", $contents);
        $this->assertEquals(0, $contents['total'], "AllergyIntolerance search by patient should have returned no results for a new patient");
    }
}
