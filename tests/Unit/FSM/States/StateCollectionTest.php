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
            new State('S0', '0', StateType::NON_FINAL),
            new State('S1', '1', StateType::NON_FINAL)
        );

        $this->assertInstanceOf(StateCollection::class, $collection);
    }

    public function test_it_can_add(): void
    {
        $collection = new StateCollection(
            new State('S0', '0', StateType::NON_FINAL),
        );

        $collection->add(new State('S1', '1', StateType::NON_FINAL));
        $this->assertCount(2, $collection);
    }

    public function test_it_can_check_it_has_something(): void
    {
        $state = new State('S0', '0', StateType::NON_FINAL);

        $collection = new StateCollection(
            $state,
        );

        $this->assertFalse(
            $collection->has(
                new State('S2', '2', StateType::NON_FINAL)
            )
        );

        $this->assertTrue(
            $collection->has(
                $state
            )
        );
    }
}
