<?php

namespace Tests\Unit\FSM\Core;

use Tests\BaseTestCase;
use Src\FSM\Core\Collection;

class CollectionTest extends BaseTestCase
{
    public function test_it_can_construct(): void
    {
        $collection = new Collection(
            ['key' => 'value'],
        );

        $this->assertInstanceOf(Collection::class, $collection);
    }

    public function test_it_can_get_offset()
    {
        $collection = new Collection(
            ['key' => 'value'],
        );

        $this->assertEquals('value', $collection['key']);
    }

    public function test_it_can_unset_offset()
    {
        $collection = new Collection(
            ['key' => 'value', 'key2' => 'value2'],
        );
        $this->assertCount(2, $collection);
        $collection->offsetUnset('key');
        $this->assertCount(1, $collection);
    }

    public function test_it_can_to_array()
    {
        $collection = new Collection(
            ['key' => 'value'],
        );

        $this->assertIsArray($collection->toArray());
    }
}
