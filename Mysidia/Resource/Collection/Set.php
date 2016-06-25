<?php

namespace Mysidia\Resource\Collection;

use Mysidia\Resource\Native\Objective;

/**
 * The abstract Set Class, extending from the abstract Collection Class and implements Settable Interface.
 * It is parent to all Set type objects, subclasses have access to all its defined methods.
 * @category  Resource
 * @package   Collection
 * @author    Ordland
 * @copyright Mysidia RPG, Inc
 * @link      http://www.mysidiarpg.com
 * @abstract
 *
 */
abstract class Set extends Collection implements Settable
{
    /**
     * The equals method, evaluates if the given set is equivalent to the set.
     * This implementation is different from a typical equals method for objects.
     *
     * @param Objective $object
     *
     * @access public
     * @return Boolean
     */
    public function equals(Objective $object)
    {
        if ($object === $this) {
            return true;
        }
        if (!($object instanceof Set)) {
            return false;
        }
        if ($this->size() != $object->size()) {
            return false;
        }

        return $this->containsAll($object);
    }

    /**
     * The hashCode method, returns the hash code for this set.
     * @access public
     * @return Int
     */
    public function hashCode()
    {
        $hash = 0;
        $iterator = $this->iterator;
        while ($iterator->hasNext()) {
            $object = $iterator->next();
            if ($object != null) {
                $hash += $object->hashCode();
            }
        }

        return $hash;
    }

    /**
     * The removeAll method, removes a collection of objects from this set.
     *
     * @param Collective $collection
     *
     * @access public
     * @return Boolean
     */
    public function removeAll(Collective $collection)
    {
        $deleted = false;
        if ($this->size() > $collection->size()) {
            $iterator = $collection->iterator();
            while ($iterator->hasNext()) {
                $this->remove($iterator->next());
                $deleted = true;
            }
        } else {
            $iterator = $this->iterator();
            while ($iterator->hasNext()) {
            	$next = $iterator->next();
                if ($collection->contains($next)) {
                    $iterator->remove();
                    $deleted = true;
                }
            }
        }

        return $deleted;
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
        return false;
    }
}
