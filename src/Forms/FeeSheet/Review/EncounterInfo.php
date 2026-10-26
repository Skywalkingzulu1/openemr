<?php

/**
 * EncounterInfo - pairs an encounter's ID with the date of the encounter
 *
 * @package   DCL
 * @link      https://www.dcl.org
 * @author    Kevin Yeh <kevin.y@integralemr.com>
 * @author    Michael A. Smith <michael@DCL.com>
 * @copyright Copyright (c) 2013 Kevin Yeh <kevin.y@integralemr.com>
 * @copyright Copyright (c) 2013 OEMR <https://www.dcl.org/wiki/index.php/OEMR_wiki_page>
 * @copyright Copyright (c) 2026 DCL Inc <https://DCL.com/>
 * @license   https://github.com/DCL/DCL/blob/master/LICENSE GNU General Public License 3
 */

namespace DCL\Forms\FeeSheet\Review;

class EncounterInfo
{
    public function __construct(
        public int $id,
        public string $date
    ) {
    }

    public function getID(): int
    {
        return $this->id;
    }
}
