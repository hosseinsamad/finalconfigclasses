<?php

namespace Mysidia\Resource\Collection;

use Mysidia\Resource\Exception\UnsupportedOperationException;
use Mysidia\Resource\Native\Objective;

/**
 * The ImmutableEntry Class, extending from the abstract Entry Class.
 * It defines a standard immutable Entry Object, it is used in TreeMap extensively.
 * @category  Resource
 * @package   Collection
 * @author    Ordland
 * @copyright Mysidia RPG, Inc
 * @link      http://www.mysidiarpg.com
 *
 */
class ImmutableEntry extends Entry
{
    /**
     * serialID constant, it serves as identifier of the object being ImmutableEntry.
     */
    const SERIALID = "7138329143949025153L";

    /**
     * Constructor of ImmutableEntry Class, it initializes an Entry with a key and a value.
     *
     * @param Entry $entry
     *
     * @access public
     * @return Void
     */
    public function __construct(Entry $entry)
    {
        parent::__construct($entry->getKey(), $entry->getValue());
    }

    /**
     * The hashCode method, returns the hash code for this ImmutableEntry.
     * Note the hashCode for a ImmutableEntry is an integer.
     * @access public
     * @return Int
     */
    public function hashCode()
    {
        $keyHash = ($this->key == null) ? 0 : $this->key->hashCode();
        $valueHash = ($this->value == null) ? 0 : $this->value->hashCode();

        return ($keyHash ^ $valueHash);
    }

    /**
     * The  setValue method, replaces the value corresponding to this ImmutableEntry with the specified value.
     * This method is disabled for ImmutableEntry class, but child class can override with its own implementation.
     *
     * @param Objective $value
     *
     * @access public
     * @return Objective
     */
    public function setValue(Objective $value)
    {
        throw new UnsupportedOperationException();
    }
}
