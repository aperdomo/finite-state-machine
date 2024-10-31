<?php

namespace Src\FSM\Transitions;

use Src\FSM\States\State;

class Transition
{
    private State $currentState;
    private string $letter;
    private State $nextState;

    /**
     * @param State $startState
     * @param string $letter
     * @param State $nextState
     */
    public function __construct(State $startState, string $letter, State $nextState)
    {
        $this->currentState = $startState;
        $this->letter = $letter;
        $this->nextState = $nextState;
    }

    /**
     * @param State $state
     * @param string $letter
     * @return bool
     */
    public function isCurrentState(State $state, string $letter): bool
    {
        return $this->currentState->getName() === $state->getName() && $this->letter === $letter;
    }

    /**
     * @return State
     */
    public function getNextState(): State
    {
        return $this->nextState;
    }
}
