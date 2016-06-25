<?php

namespace Mysidia\Resource\Utility;

use Mysidia\Resource\Native\Object;
use Mysidia\Resource\Native\Objective;

/**
 * The ReverseComparator Class, it is part of the utility package and extends from the Object Class.
 * It specifies a unique comparator that returns the opposite result as a standard comparator.
 * @category  Resource
 * @package   Utility
 * @author    Ordland
 * @copyright Mysidia RPG, Inc
 * @link      http://www.mysidiarpg.com
 */
class ReverseComparator extends Object implements Comparative
{
    /**
     * serialID constant, it serves as identifier of the object being ReverseComparator.
     */
    const SERIALID = "4374092139857L";

    /**
     * The comparator property, it stores a reference to the standard comparator.
     * If unspecified, it will use the object's compareTo method instead.
     * @access private
     * @var String
     */
    private $comparator;

    /**
     * The constructor for ReverseComparator Class, it initializes basic properties for reverse comparator.
     *
     * @param Comparative $comparator
     *
     * @access public
     * @return Void
     */
    public function __construct(Comparative $comparator = null)
    {
        $this->comparator = $comparator;
    }

    /**
     * The compare method, compares two objects with each other with its internal algorithm.
     *
     * @param Objective $object
     * @param Objective $object2
     *
     * @access public
     * @return Int
     */
    public function compare(Objective $object1, Objective $object2)
    {
        if ($this->comparator == null) {
            return ($object2->compareTo($object1));
        } else {
            return $this->comparator->compare($object2, $object1);
        }
    }

    /**
     * The equals method, checks whether target comparator is equivalent to this one.
     *
     * @param Objective $object
     *
     * @access public
     * @return Boolean
     */
    public function equals(Objective $object)
    {
        return ($object == $this or ($object instanceof ReverseComparator and $this->comparator->equals($object->comparator())));
    }

    /**
     * The comparator method, returns the comparator object used to order the keys.
     * @access public
     * @return Comparative
     */
    public function comparator()
    {
        return $this->comparator;
    }

    /**
     * The hashCode method, returns the hash code for the reverse comparator.
     * Interestingly, the hashCode is exactly the opposite as the comparator property.
     * @access public
     * @return Int
     */
    public function hashCode()
    {
        return (-1 * $this->comparator->hashCode());
    }
}
