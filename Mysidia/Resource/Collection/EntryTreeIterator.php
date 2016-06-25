<?php

namespace Mysidia\Resource\Collection;

/**
 * The EntryTreeIterator Class, extending from the abstract TreeMapIterator Class.
 * It defines a standard entry iterator for TreeMap, which will come in handy.
 * This is a final class, and thus no child class shall inherit from it.
 * @category  Resource
 * @package   Collection
 * @author    Ordland
 * @copyright Mysidia RPG, Inc
 * @link      http://www.mysidiarpg.com
 * @final
 *
 */
final class EntryTreeIterator extends TreeMapIterator
{
    /**
     * The next method, returns the next entry in iteration.
     * @access public
     * @return Entry
     */
    public function next()
    {
        return $this->nextEntry();
    }

    /**
     * The nextKey method, returns the next key in iteration.
     * @access public
     * @return Objective
     */
    public function nextKey()
    {
        return $this->nextEntry()->getKey();
    }

    /**
     * The nextValue method, returns the next value in iteration.
     * @access public
     * @return Objective
     */
    public function nextValue()
    {
        return $this->nextEntry()->getValue();
    }
}
