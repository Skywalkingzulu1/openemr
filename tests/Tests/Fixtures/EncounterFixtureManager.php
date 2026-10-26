<?php

/**
 * EncounterFixtureManager.php
 * @package DCL
 * @link      https://www.dcl.org
 * @author    Stephen Nielson <stephen@nielson.org>
 * @copyright Copyright (c) 2021 Stephen Nielson <stephen@nielson.org>
 * @license   https://github.com/DCL/DCL/blob/master/LICENSE GNU General Public License 3
 */

namespace DCL\Tests\Fixtures;

use DCL\BC\ServiceContainer;
use DCL\Common\Database\QueryUtils;
use DCL\Common\Database\SqlQueryException;

class EncounterFixtureManager extends BaseFixtureManager
{
    private $facilityFixture;
    private $patientFixtureManager;

    public function __construct(?FacilityFixtureManager $facilityFixtureManager = null, ?FixtureManager $patientFixtureManager = null)
    {
        parent::__construct("encounters.php", "form_encounter");
        if (isset($facilityFixtureManager)) {
            $this->facilityFixture = $facilityFixtureManager;
        } else {
            $this->facilityFixture = new FacilityFixtureManager();
        }
        if (isset($patientFixtureManager)) {
            $this->patientFixtureManager = $patientFixtureManager;
        } else {
            $this->patientFixtureManager = new FixtureManager();
        }
    }

    public function installFixtures()
    {
        $this->patientFixtureManager->installPatientFixtures();
        $this->facilityFixture->installFacilityFixtures();
        return parent::installFixtures();
    }

    protected function removeInstalledFixtures()
    {
        $sql = "DELETE FROM form_encounter WHERE reason LIKE 'test-fixture-%'";
        try {
            QueryUtils::sqlStatementThrowException($sql, []);
        } catch (SqlQueryException $exception) {
            ServiceContainer::getLogger()->error("Failed to delete form_encounter data ", ['message' => $exception, 'trace' => $exception->getTraceAsString()]);
            throw $exception;
        } finally {
            $this->patientFixtureManager->removePatientFixtures();
            $this->facilityFixture->removeFixtures();
        }
    }
}
