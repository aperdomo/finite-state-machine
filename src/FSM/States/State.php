<?php

namespace Src\FSM\States;

use Src\FSM\States\Enum\StateType;

class State
{
    /**
     * @var string
     */
    public string $name;

    /**
     * @var string
     */
    public string $output_value;

    /**
     * @var StateType
     */
    public StateType $type;

    /**
     * @param string $name
     * @param string $output_value
     * @param StateType $type
     */
    public function __construct(
        string $name,
        string $output_value,
        StateType $type = StateType::NON_FINAL
    ) {
        $this->name = $name;
        $this->output_value = $output_value;
        $this->type = $type;
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
