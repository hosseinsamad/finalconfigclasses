<?php

namespace Mysidia\Resource\Collection;

use Mysidia\Resource\Exception\IllegalArgumentException;
use Mysidia\Resource\Exception\UnsupportedOperationException;
use Mysidia\Resource\Native\NullWrapper;
use Mysidia\Resource\Native\Objective;

/**
 * The HashSet Class, extending from the abstract MapSet Class.
 * It defines a standard Set class for the simplest collection manipulation.
 * @category  Resource
 * @package   Collection
 * @author    Ordland
 * @copyright Mysidia RPG, Inc
 * @link      http://www.mysidiarpg.com
 *
 */
class HashSet extends MapSet
{
    /**
     * serialID constant, it serves as identifier of the object being HashSet.
     */
    const SERIALID = "-5024744406713321676L";

    /**
     * The dummy property, it defines a dummy Null Object to associate with objects in backup Map.
     * @access protected
     * @var Null
     */
    protected $dummy;

    /**
     * Constructor of HashSet Class, it initializes the HashSet given its capacity or another Collection Object.
     *
     * @param Int|Collective $param
     * @param Float          $loadFactor
     * @param Boolean        $linked
     *
     * @access public
     * @return Void
     */
    public function __construct($param = HashMap::DEFAULTCAPACITY, $loadFactor = HashMap::DEFAULTLOAD, $linked = false)
    {
        if ($linked) {
            $this->map = new LinkedHashMap($param, $loadFactor);
        } elseif (is_int($param)) {
            $this->map = new HashMap($param, $loadFactor);
        } elseif ($param instanceof Collective) {
            $capacity = (int) ($param->size() / self::DEFAULTLOAD + 1);
            $this->map = new HashMap($capacity);
            $this->addAll($param);
        } else {
            throw new IllegalArgumentException("Invalid Argument specified.");
        }
        $this->dummy = new NullWrapper();
    }

    /**
     * The add method, append a specific object to the HashSet if it is not already present.
     *
     * @param Objective $object
     *
     * @access public
     * @return Boolean
     */
    public function add(Objective $object)
    {
        return $this->map->put($object, $this->dummy);
    }

    /**
     * The contains method, checks if a given object is already on the HashSet.
     *
     * @param Objective $object
     *
     * @access public
     * @return Boolean
     */
    public function contains(Objective $object)
    {
        return $this->map->containsKey($object);
    }

    /**
     * The iterator method, acquires an instance of the iterator object of the HashSet.
     * @access public
     * @return KeyIterator
     */
    public function iterator()
    {
        return $this->map->keySet()->iterator();
    }

    /**
     * The remove method, removes a supplied Object from the HashSet if it is present.
     *
     * @param Objective $object
     *
     * @access public
     * @return Boolean
     */
    public function remove(Objective $object)
    {
        return ($this->map->remove($object) == $this->dummy);
    }

    /**
     * The subSet method, acquires a portion of the Set ranging from the supplied two elements.
     *
     * @param Objective $fromElement
     * @param Objective $toElement
     *
     * @access public
     * @return Settable
     */
    public function subSet(Objective $fromElement, Objective $toElement)
    {
        throw new UnsupportedOperationException();
    }
}
