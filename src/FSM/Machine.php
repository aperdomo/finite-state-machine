<?php

namespace Src\FSM;

use Exception;
use Src\FSM\Chars\Alphabet;
use Src\FSM\States\State;
use Src\FSM\States\StateCollection;
use Src\FSM\Transitions\Table;

class Machine
{
    /**
     * @var State $currentState
     */
    private State $currentState;

    /**
     * Machine constructor.
     *
     * @param StateCollection $states
     * @param Alphabet $alphabet
     * @param State $initialState
     * @param StateCollection $finalStates
     * @param Table $transitionTable
     * @throws Exception
     */
    public function __construct(
        private readonly StateCollection $states,
        private readonly Alphabet $alphabet,
        private readonly State $initialState,
        private readonly StateCollection $finalStates,
        private readonly Table $transitionTable
    ) {
        $this->currentState = $this->initialState;
        $this->validateStateConfig();
    }

    /**
     * Ensure that the initial and final states are in the set of states.
     *
     * @return void
     * @throws Exception
     */
    private function validateStateConfig(): void
    {
        if (false === $this->states->has($this->initialState)) {
            throw new Exception("Initial state {$this->initialState->getName()} is not in the set of states.");
        }

        foreach ($this->finalStates as $finalState) {
            if (false === $this->states->has($finalState)) {
                throw new Exception("Final state {$finalState->getName()} is not set in original set of states.");
            }
        }
    }

    /**
     * Get the current state of the machine.
     *
     * @return State
     */
    public function getCurrentState(): State
    {
        return $this->currentState;
    }

    /**
     * Process the input and transition to the next state.
     *
     * @param string $letter
     * @return State
     * @throws Exception
     */
    public function processInput(string $letter): State
    {
        if (false === $this->alphabet->contains($letter)) {
            throw new Exception("Invalid input value - $letter");
        }

        $this->currentState = $this->transitionTable
            ->transition(
                $this->currentState,
                $letter
            );

        return $this->currentState;
    }

    /**
     * @param string ...$values
     * @return void
     * @throws Exception
     */
    public function process(string ...$values): void
    {
        foreach ($values as $letter) {
            $this->processInput($letter);
        }
    }

    /**
     * Check if the current state is a final state.
     *
     * @return bool
     */
    public function isValidFinalState(): bool
    {
        return $this->finalStates->has($this->currentState);
    }
}
