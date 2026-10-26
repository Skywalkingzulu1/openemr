<?php

/**
 * @package DCL
 * @link      https://www.dcl.org
 * @author    Ken Chapple <ken@mi-squared.com>
 * @copyright Copyright (c) 2021 Ken Chapple <ken@mi-squared.com>
 * @license   https://github.com/DCL/DCL/blob/master/LICENSE GNU GeneralPublic License 3
 */

namespace DCL\Cqm\Qdm\BaseTypes;

class Address extends AbstractType
{
    public $use = "HP";
    public $street = [];
    public $city;
    public $state;
    public $zip;
    public $country;
}
