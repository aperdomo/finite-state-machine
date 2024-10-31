<?php

namespace Src\FSM\States;

use Src\FSM\Core\Collection;

class StateCollection extends Collection
{
    /**
     * @param State ...$states
     */
    public function __construct(State ...$states)
    {
        parent::__construct(
            array_combine(
                array_map(fn (State $state) => $state->getName(), $states),
                $states
            )
        );
    }

    /**
     * @param State ...$state
     * @return void
     */
    public function add(State ...$state): void
    {
        foreach ($state as $s) {
            $this->offsetSet($s->getName(), $s);
        }
    }

    /**
     * @param State $state
     * @return bool
     */
    public function has(State $state): bool
    {
        return $this->offsetExists($state->getName());
    }

    /**
     * @param string $name
     * @return State
     */
    public function getByName(string $name): State
    {
        return $this->offsetGet($name);
    }
}
