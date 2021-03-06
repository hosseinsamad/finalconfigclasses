<?php

namespace Mysidia\Resource\Collection;

use Mysidia\Resource\Native\Objective;

/**
 * The ValueTreeSet Class, extending from the ValueMapSet Class.
 * It defines a standard set to hold values in a TreeMap, it is important for TreeMap type objects.
 * @category  Resource
 * @package   Collection
 * @author    Ordland
 * @copyright Mysidia RPG, Inc
 * @link      http://www.mysidiarpg.com
 *
 */
class ValueTreeSet extends ValueMapSet
{
    /**
     * Constructor of ValueTreeSet Class, it simply calls parent constructor.
     *
     * @param TreeMap $map
     *
     * @access public
     * @return Void
     */
    public function __construct(TreeMap $map)
    {
        parent::__construct($map);
    }

    /**
     * The iterator method, acquires an instance of the value iterator object of the ValueTreeSet.
     * @access public
     * @return ValueTreeIterator
     */
    public function iterator()
    {
        return new ValueTreeIterator($this->map, $this->map->getFirstEntry());
    }

    /**
     * The remove method, removes the underlying value in Iterator given its current key.
     *
     * @param Objective $object
     *
     * @access public
     * @return Boolean
     */
    public function remove(Objective $object)
    {
        for ($entry = $this->map->getFirstEntry(); $entry != null; $entry = $this->map->successor($entry)) {
            if ($this->map->valueEquals($entry->getValue(), $object)) {
                $this->map->deleteEntry($entry);

                return true;
            }
        }

        return false;
    }
}
