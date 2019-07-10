<?php

declare(strict_types = 1);

namespace Appwilio\RussianPostSDK\Dispatching\Http;

abstract class IterableResponse implements \IteratorAggregate, \ArrayAccess
{
    protected $items;

    abstract public function getItems();

    public function getIterator(): \Traversable
    {
        return new \ArrayIterator($this->getItems());
    }

    public function offsetExists($offset)
    {
        return isset($this->items[$offset]);
    }

    public function offsetGet($offset)
    {
        return $this->items[$offset];
    }

    public function offsetSet($offset, $value)
    {
        //
    }

    public function offsetUnset($offset)
    {
        //
    }
}
