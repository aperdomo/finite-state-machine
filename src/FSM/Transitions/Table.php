<?php

namespace Src\FSM\Transitions;

use Exception;
use Src\FSM\States\State;

class Table
{
    /**
     * @var Transition[] $transitions
     */
    private array $transitions = [];

    /**
     * @param Transition[] $transitions
     * @return void
     */
    public function add(Transition ...$transitions): void
    {
        $this->transitions = $transitions;
    }

    /**
     * @return Transition[]
     */
    public function getTransitions(): array
    {
        return $this->transitions;
    }

    /**
     * @param State $currentState
     * @param string $letter
     * @return State
     * @throws Exception
     */
    public function transition(
        State $currentState,
        string $letter
    ): State {
        foreach ($this->transitions as $transition) {
            if ($transition->isCurrentState($currentState, $letter)) {
                return $transition->getNextState();
            }
        }

        throw new Exception("Transition not found for letter $letter from state {$currentState->getName()}.");
    }
}
