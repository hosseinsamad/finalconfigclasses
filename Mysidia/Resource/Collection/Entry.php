<?php

namespace Mysidia\Resource\Collection;

use Mysidia\Resource\Exception\UnsupportedOperationException;
use Mysidia\Resource\Native\Object;
use Mysidia\Resource\Native\Objective;
use Mysidia\Resource\Native\StringWrapper;

/**
 * The abstract Entry Class, extending from the root Object Class.
 * It defines a standard mutable Entry Object, but must be extended by child class.
 * @category  Resource
 * @package   Collection
 * @author    Ordland
 * @copyright Mysidia RPG, Inc
 * @link      http://www.mysidiarpg.com
 * @abstract
 *
 */
abstract class Entry extends Object
{
    /**
     * The key property, it defines the key of this entry.
     * @access protected
     * @var Objective
     */
    protected $key;

    /**
     * The value property, it defines the value of this entry.
     * @access protected
     * @var Objective
     */
    protected $value;

    /**
     * Constructor of Entry Class, it initializes an Entry with a key and a value.
     *
     * @param Objective $key
     * @param Objective $value
     *
     * @access public
     * @return Void
     */
    public function __construct(Objective $key = null, Objective $value = null)
    {
        $this->key = $key;
        $this->value = $value;
    }

    /**
     * The equals method, checks whether target Entry is equivalent to this one.
     *
     * @param Objective $object
     *
     * @access public
     * @return Boolean
     */
    public function equals(Objective $object)
    {
        if (!($object instanceof Entry)) {
            return false;
        } elseif ($this == $object) {
            return true;
        } else {
            return ($this->key->equals($object->getKey()) and $this->value->equals($object->getValue()));
        }
    }

    /**
     * The getKey method, acquires the key corresponding to this Entry.
     * @access public
     * @return Objective
     */
    public function getKey()
    {
        return $this->key;
    }

    /**
     * The getValue method, acquires the value corresponding to this Entry.
     * @access public
     * @return Objective
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * The initialize method, initializes properties of this Entry from another Entry.
     * Since the abstract Entry class is immutable, this method can only be called for uninitialized Entry.
     *
     * @param Entry $entry
     *
     * @access public
     * @return Boolean
     */
    public function initialize(Entry $entry)
    {
        if (!$this->key and !$this->value) {
            $this->key = $entry->getKey();
            $this->value = $entry->getValue();

            return true;
        }
        throw new UnsupportedOperationException();
    }

    /**
     * The setValue method, replaces the value corresponding to this Entry with the specified value.
     *
     * @param Objective $value
     *
     * @access public
     * @return Objective
     */
    public function setValue(Objective $value)
    {
        $oldValue = $this->value;
        $this->value = $value;

        return $oldValue;
    }

    /**
     * The magic method __toString, defines the string expression of the Entry.
     * @access public
     * @return StringWrapper
     */
    public function __toString()
    {
        return new StringWrapper("{$this->key} => {$this->value}");
    }
}
