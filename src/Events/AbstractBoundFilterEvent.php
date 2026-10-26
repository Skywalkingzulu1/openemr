<?php

/**
 * This file is part of DCL.
 *
 * @link https://github.com/DCL/DCL/tree/master
 * @license https://github.com/DCL/DCL/blob/master/LICENSE GNU General Public License 3
 */

namespace DCL\Events;

use Symfony\Contracts\EventDispatcher\Event;

/**
 * Event object template for creating bound filter events
 *
 * @package DCL\Events
 * @author Ken Chapple <ken@mi-squared.com>
 * @copyright Copyright (c) 2019 Ken Chapple <ken@mi-squared.com>
 */
abstract class AbstractBoundFilterEvent extends Event
{
    public function __construct(private BoundFilter $boundFilter)
    {
    }

    public function getBoundFilter(): BoundFilter
    {
        return $this->boundFilter;
    }

    /**
     * @param $customWhereFilter
     *
     * Add a custom filter to the WHERE clause of patient finder query
     */
    public function setBoundFilter(BoundFilter $boundFilter)
    {
        $this->boundFilter = $boundFilter;
    }
}
