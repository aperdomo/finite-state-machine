<?php

namespace Src\FSM\States;

use Src\FSM\States\Enum\StateType;

class State
{
    /**
     * @param string $name
     * @param string $output_value
     * @param StateType $type
     */
    public function __construct(
        protected string $name,
        protected string $output_value,
        protected StateType $type = StateType::DEFAULT
    ) {
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getOutput(): string
    {
        return $this->output_value;
    }
}
