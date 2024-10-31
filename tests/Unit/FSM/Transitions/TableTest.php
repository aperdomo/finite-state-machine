<?php

namespace Tests\Unit\FSM\Transitions;

use Exception;
use Src\FSM\States\State;
use Src\FSM\Transitions\Table;
use Src\FSM\Transitions\Transition;
use Tests\BaseTestCase;
use Src\FSM\States\Enum\StateType;

class TableTest extends BaseTestCase
{
    public function test_it_can_construct(): void
    {
        $this->assertInstanceOf(Table::class, new Table());
    }

    public function test_it_can_add(): void
    {
        $state = new State('S1', '1', StateType::DEFAULT);
        $nextState = new State('S2', '2', StateType::DEFAULT);
        $transition = new Transition($state, '1', $nextState);
        $table = new Table();
        $table->add(new Transition($state, '1', $nextState));
        $transitions = $table->getTransitions();
        $this->assertCount(1, $transitions);
        $this->assertEquals($transition, $transitions[0]);
    }

    public function test_it_throws_for_invalid_input(): void
    {
        $this->expectException(Exception::class);
        $state = new State('S1', '1', StateType::DEFAULT);
        $nextState = new State('S2', '2', StateType::DEFAULT);
        $table = new Table();
        $table->add(new Transition($state, '1', $nextState));
        $table->transition($state, '9999');
    }
}
