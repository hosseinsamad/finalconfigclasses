<?php

namespace Mysidia\Resource\Collection;

use Mysidia\Resource\Exception\UnsupportedOperationException;
use Mysidia\Resource\Native\Objective;
use Mysidia\Resource\Native\StringWrapper;

/**
 * The abstract Map Class, extending from the abstract Collection Class and implements Mappable Interface.
 * It is parent to all Map type objects, subclasses have access to all its defined methods.
 * @category  Resource
 * @package   Collection
 * @author    Ordland
 * @copyright Mysidia RPG, Inc
 * @link      http://www.mysidiarpg.com
 * @abstract
 *
 */
abstract class Map extends Collection implements Mappable
{
    /**
     * The keySet property, it stores a set of the keys inside this Map.
     * @access protected
     * @var Settable
     */
    protected $keySet;

    /**
     * The valueSet property, it stores a set of values inside this Map.
     * @access protected
     * @var Settable
     */
    protected $valueSet;

    /**
     * The clear method, drops all key-value pairs currently stored in this Map.
     * @access public
     * @return Void
     */
    public function clear()
    {
        $this->entrySet()->clear();
    }

    /**
     * The contains method, checks if the map contains a specific value among its key-value pairs.
     * It is alias to the containsValue method, and serves as a shortcut.
     *
     * @param Objective $object
     *
     * @access public
     * @return Boolean
     */
    public function contains(Objective $object)
    {
        return $this->containsValue($object);
    }

    /**
     * The containsKey method, checks if the map contains a specific key among its key-value pairs.
     *
     * @param Objective $object
     *
     * @access public
     * @return Boolean
     */
    public function containsKey(Objective $key = null)
    {
        $iterator = $this->entrySet()->iterator();
        if ($key == null) {
            while ($iterator->hasNext()) {
                $entry = $iterator->next();
                if ($entry->getKey() == null) {
                    return true;
                }
            }
        } else {
            while ($iterator->hasNext()) {
                $entry = $iterator->next();
                if ($key->equals($entry->getKey())) {
                    return true;
                }
            }
        }

        return false;
    }

    /**
     * The containsValue method, checks if the map contains a specific value among its key-value pairs.
     *
     * @param Objective $object
     *
     * @access public
     * @return Boolean
     */
    public function containsValue(Objective $value = null)
    {
        $iterator = $this->entrySet()->iterator();
        if ($value == null) {
            while ($iterator->hasNext()) {
                $entry = $iterator->next();
                if ($entry->getValue() == null) {
                    return true;
                }
            }
        } else {
            while ($iterator->hasNext()) {
                $entry = $iterator->next();
                if ($value->equals($entry->getValue())) {
                    return true;
                }
            }
        }

        return false;
    }

    /**
     * The equals method, checks whether target object is equivalent to this Map.
     *
     * @param Objective $object
     *
     * @access public
     * @return Boolean
     */
    public function equals(Objective $object)
    {
        if ($object == $this) {
            return true;
        }
        if (!($object instanceof Mappable)) {
            return false;
        }
        $map = $object;
        if ($map->size() != $this->size()) {
            return false;
        }

        $iterator = $this->entrySet()->iterator();
        while ($iterator->hasNext()) {
            $entry = $iterator->next();
            $key = $entry->getKey();
            $value = $entry->getValue();
            if ($value == null) {
                if (!($map->get($key) == null and $map->containsKey($key))) {
                    return false;
                }
            } else {
                if (!$value->equals($map->get($key))) {
                    return false;
                }
            }
        }

        return true;
    }

    /**
     * The get method, acquires the value stored in the Map given its key.
     *
     * @param Objective $key
     *
     * @access public
     * @return Objective
     */
    public function get(Objective $key)
    {
        $iterator = $this->entrySet()->iterator();
        if ($key == null) {
            while ($iterator->hasNext()) {
                $entry = $iterator->next();
                if ($entry->getKey() == null) {
                    return $entry->getValue();
                }
            }
        } else {
            while ($iterator->hasNext()) {
                $entry = $iterator->next();
                if ($key->equals($entry->getKey())) {
                    return $entry->getValue();
                }
            }
        }

        return false;
    }

    /**
     * The hashCode method, returns the hash code for this Map.
     * @access public
     * @return StringWrapper
     */
    public function hashCode()
    {
        $hashCode = 0;
        $iterator = $this->entrySet()->iterator();
        while ($iterator->hasNext()) {
            $hashCode .= $iterator->next()->hashCode();
        }

        return $hashCode;
    }

    /**
     * The iterator method, acquires an instance of the EntryIterator object for this Map.
     * @access public
     * @return EntryIterator
     */
    public function iterator()
    {
        return $this->entryIterator();
    }

    /**
     * The keySet method, returns a Set of keys contained in this Map.
     * @access public
     * @return KeyMapSet
     */
    public function keySet()
    {
        if (!$this->keySet) {
            $this->keySet = new KeyMapSet($this);
        }

        return $this->keySet;
    }

    /**
     * The put method, associates a specific value with the specific key in this Map.
     * The method is disabled in abstract map class, thus child class must implement its own version of put method.
     *
     * @param Objective $key
     * @param Objective $value
     *
     * @access public
     * @return Objective
     */
    public function put(Objective $key, Objective $value)
    {
        throw new UnsupportedOperationException();
    }

    /**
     * The putAll method, copies all mappings from a specific map to this Map.
     *
     * @param Mappable $map
     *
     * @access public
     * @return Void
     */
    public function putAll(Mappable $map)
    {
        $iterator = $map->entrySet()->iterator();
        while ($iterator->hasNext()) {
            $entry = $iterator->next();
            $this->put($entry->getKey(), $entry->getValue());
        }
    }

    /**
     * The remove method, removes a specific key-value pair from the Map.
     *
     * @param Objective $key
     *
     * @access public
     * @return Boolean
     */
    public function remove(Objective $key = null)
    {
        $iterator = $this->entrySet()->iterator();
        if ($key == null) {
            while ($iterator->hasNext()) {
                $entry = $iterator->getNext();
                if ($entry->getKey() == null) {
                    return $iterator->remove()->getValue();
                }
            }
        } else {
            while ($iterator->hasNext()) {
                $entry = $iterator->getNext();
                if ($key->equals($entry->getKey())) {
                    return $iterator->remove()->getValue();
                }
            }
        }

        return;
    }

    /**
     * The size method, returns the current size of this Map.
     * @access public
     * @return Int
     */
    public function size()
    {
        return $this->entrySet()->size();
    }

    /**
     * The valueSet method, returns a collection of values contained in this Map.
     * @access public
     * @return ValueMapSet
     */
    public function valueSet()
    {
        if (!$this->valueSet) {
            $this->valueSet = new ValueMapSet($this);
        }

        return $this->valueSet;
    }

    /**
     * The magic method __toString, defines the string expression of the Map.
     * @access public
     * @return StringWrapper
     */
    public function __toString()
    {
        $iterator = $this->entrySet()->iterator();
        if (!$iterator->hasNext()) {
            return "{}";
        }

        $stringBuilder = new StringWrapper("{");
        while ($iterator->hasNext()) {
            $entry = $iterator->next();
            $key = $entry->getKey();
            $value = $entry->getValue();
            $stringBuilder->add(($key == $this) ? "(this map)" : $key);
            $stringBuilder->add("=");
            $stringBuilder->add(($value == $this) ? "(this map)" : $value);
            if (!$iterator->hasNext()) {
                return $stringBuilder->add("}");
            }
            $stringBuilder->add(", ");
        }
    }

    /**
     * The abstract entrySet method, must be implemented by child class.
     * @access public
     * @return Settable
     * @abstract
     */
    abstract public function entrySet();
}
