<?php

namespace Tests\Unit\FSM\States;

use Src\FSM\States\State;
use Src\FSM\States\StateCollection;
use Tests\BaseTestCase;
use Src\FSM\States\Enum\StateType;

class StateCollectionTest extends BaseTestCase
{
    public function test_it_can_construct(): void
    {
        $collection = new StateCollection(
            new State('S0', '0', StateType::DEFAULT),
            new State('S1', '1', StateType::DEFAULT)
        );

        $this->assertInstanceOf(StateCollection::class, $collection);
    }

    public function test_it_can_add(): void
    {
        $collection = new StateCollection(
            new State('S0', '0', StateType::DEFAULT),
        );

        $collection->add(new State('S1', '1', StateType::DEFAULT));
        $this->assertCount(2, $collection);
    }

    public function test_it_can_check_it_has_something(): void
    {
        $state = new State('S0', '0', StateType::DEFAULT);

        $collection = new StateCollection(
            $state,
        );

        $this->assertFalse(
            $collection->has(
                new State('S2', '2', StateType::DEFAULT)
            )
        );

        $this->assertTrue(
            $collection->has(
                $state
            )
        );
    }

    public function test_it_can_get_by_name(): void
    {
        $state = new State('S0', '0', StateType::DEFAULT);

        $collection = new StateCollection(
            $state,
        );

        $this->assertEquals(
            $state,
            $collection->getByName('S0')
        );
    }
}
