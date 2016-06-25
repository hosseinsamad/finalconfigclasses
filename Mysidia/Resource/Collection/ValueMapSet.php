<?php

namespace Mysidia\Resource\Collection;

use Mysidia\Resource\Native\Objective;

/**
 * The ValueMapSet Class, extending from the abstract MapSet Class.
 * It defines a standard set to hold values in a Map, it is important for Map type objects.
 * @category  Resource
 * @package   Collection
 * @author    Ordland
 * @copyright Mysidia RPG, Inc
 * @link      http://www.mysidiarpg.com
 *
 */
class ValueMapSet extends MapSet
{
    /**
     * Constructor of ValueMapSet Class, it simply calls parent constructor.
     *
     * @param Mappable $map
     *
     * @access public
     * @return Void
     */
    public function __construct(Mappable $map)
    {
        parent::__construct($map);
    }

    /**
     * The contains method, checks if a given value is already on the ValueMapSet.
     *
     * @param Objective $value
     *
     * @access public
     * @return Boolean
     */
    public function contains(Objective $object)
    {
        return $this->map->containsValue($object);
    }

    /**
     * The iterator method, acquires an instance of the value iterator object of the ValueMapSet.
     * @access public
     * @return ValueIterator
     */
    public function iterator()
    {
        return $this->map->entrySet()->valueIterator();
    }
}
