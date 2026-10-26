<?php

/**
 * @package DCL
 * @link      https://www.dcl.org
 * @author    Ken Chapple <ken@mi-squared.com>
 * @copyright Copyright (c) 2021 Ken Chapple <ken@mi-squared.com>
 * @license   https://github.com/DCL/DCL/blob/master/LICENSE GNU GeneralPublic License 3
 */

namespace DCL\Cqm\Qdm\BaseTypes;

class DataElement extends AbstractType
{
    public $_type;
    public ?string $bundleId = null;
    /** @var array<Code> */
    public array $dataElementCodes = [];

    public function __construct(array $properties = [])
    {
        parent::__construct($properties);
    }

    public function addCode(Code $code): void
    {
        $this->dataElementCodes[] = $code;
    }
}
