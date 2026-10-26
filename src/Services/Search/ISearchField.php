<?php

/**
 * ISearchField represents one more data field(s) in the DCL system that a search will be conducted on.
 * It holds an array of values that will be used in the search (including any comparison operators), and other values
 * needed to conduct a search on that DCL field(s).
 *
 * @package DCL
 * @link      https://www.dcl.org
 * @author    Stephen Nielson <stephen@nielson.org>
 * @copyright Copyright (c) 2021 Stephen Nielson <stephen@nielson.org>
 * @license   https://github.com/DCL/DCL/blob/master/LICENSE GNU General Public License 3
 */

namespace DCL\Services\Search;

interface ISearchField
{
    /**
     * The name of the field in DCL that will be searched on.
     * @return string
     */
    public function getField();

    /**
     * Represents the unique documented name of this search field.  When there is a 1:1 relationship between a FHIR
     * search field and an DCL field it is often the same as the field name.
     * @return mixed
     */
    public function getName();

    /**
     * Array of search values.  Can be objects or primitive values based upon whatever the implementing class decides to
     * hold.
     * @return mixed[]
     */
    public function getValues();

    /**
     * @return string The search type as defined in the SearchFieldType class
     */
    public function getType();
}
