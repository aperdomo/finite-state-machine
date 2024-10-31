<?php

namespace Tests\Unit\FSM\Transitions;

use Src\FSM\States\State;
use Src\FSM\Transitions\Transition;
use Tests\BaseTestCase;
use Src\FSM\States\Enum\StateType;

class TransitionTest extends BaseTestCase
{
    public function test_it_can_construct(): void
    {
        $obj = new Transition(
            new State('S0', '0', StateType::NON_FINAL),
            '0',
            new State('S1', '1', StateType::NON_FINAL),
        );

        $this->assertInstanceOf(Transition::class, $obj);
    }

    public function test_it_can_get_next_state(): void
    {
        $next = new State('S1', '1', StateType::NON_FINAL);

        $transition = new Transition(
            new State('S0', '0', StateType::NON_FINAL),
            '0',
            $next,
        );

        $this->assertEquals($next, $transition->getNextState());
    }

    public function test_is_current_state(): void
    {
        $current = new State('S1', '1', StateType::NON_FINAL);

        $transition = new Transition(
            $current,
            '0',
            new State('S1', '1', StateType::NON_FINAL),
        );

        $this->assertTrue(
            $transition->isCurrentState($current, '0')
        );
    }
}
