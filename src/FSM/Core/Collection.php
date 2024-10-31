<?php

namespace Src\FSM\Core;

use ArrayIterator;
use ArrayAccess;

class Collection extends ArrayIterator implements ArrayAccess
{
    /**
     * @param $offset
     * @return bool
     */
    public function offsetExists($offset): bool
    {
        return parent::offsetExists($offset);
    }

    /**
     * @param $offset
     * @return mixed
     */
    public function offsetGet($offset): mixed
    {
        return parent::offsetGet($offset);
    }

    /**
     * @param $offset
     * @param $value
     * @return void
     */
    public function offsetSet($offset, $value): void
    {
        parent::offsetSet($offset, $value);
    }

    /**
     * @param $offset
     * @return void
     */
    public function offsetUnset($offset): void
    {
        parent::offsetUnset($offset);
    }

    public function toArray(): array
    {
        return iterator_to_array($this);
    }
}
