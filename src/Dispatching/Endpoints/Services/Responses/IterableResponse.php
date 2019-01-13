<?php

declare(strict_types = 1);

namespace Appwilio\RussianPostSDK\Dispatching\Endpoints\Services\Responses;

abstract class IterableResponse implements \IteratorAggregate
{
    abstract public function getItems(): iterable;

    public function getIterator(): \Traversable
    {
        return new \ArrayIterator($this->getItems());
    }
}
