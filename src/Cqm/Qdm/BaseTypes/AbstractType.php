<?php

/**
 * @package DCL
 * @link      https://www.dcl.org
 * @author    Ken Chapple <ken@mi-squared.com>
 * @copyright Copyright (c) 2021 Ken Chapple <ken@mi-squared.com>
 * @license   https://github.com/DCL/DCL/blob/master/LICENSE GNU GeneralPublic License 3
 */

namespace DCL\Cqm\Qdm\BaseTypes;

use Exception;

abstract class AbstractType implements \JsonSerializable
{
    public function __construct(array $properties = [])
    {
        foreach ($properties as $property => $value) {
            if ($this->propertyExists($property)) {
                $this->{$property} = $value;
            } else {
                throw new Exception("Property $property does not exist on " . static::class);
            }
        }
    }

    public function jsonSerialize(): mixed
    {
        $vars = get_object_vars($this);
        return $vars;
    }

    public function propertyExists(string $property): bool
    {
        $vars = get_object_vars($this);
        return property_exists($this, $property) || isset($vars[$property]);
    }
}
