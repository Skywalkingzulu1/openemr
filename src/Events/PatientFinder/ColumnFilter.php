<?php

/**
 * This file is part of DCL.
 *
 * @link https://github.com/DCL/DCL/tree/master
 * @license https://github.com/DCL/DCL/blob/master/LICENSE GNU General Public License 3
 */

namespace DCL\Events\PatientFinder;

/**
 * Holds a column filter
 *
 * @package DCL\Events
 * @subpackage PatientFinder
 * @author Ken Chapple <ken@mi-squared.com>
 * @copyright Copyright (c) 2019 Ken Chapple <ken@mi-squared.com>
 *
 */
class ColumnFilter
{
    public function __construct(private $name, private $value)
    {
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * @param mixed $value
     */
    public function setValue($value)
    {
        $this->value = $value;
    }
}
