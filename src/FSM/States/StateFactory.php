<?php

namespace Src\FSM\States;

use Src\FSM\States\Enum\StateType;

class StateFactory
{
    /**
     * @param string $name
     * @param string $value
     * @param StateType $stateType
     * @return State
     */
    public static function create(
        string $name,
        string $value,
        StateType $stateType = StateType::DEFAULT
    ): State {
        return new State($name, $value, $stateType);
    }

    /**
     * @param array $states
     * @return StateCollection
     */
    public static function createMany(array $states = []): StateCollection
    {
        $return = [];

        foreach ($states as $state) {
            $return[] = self::create(... $state);
        }

        return new StateCollection(... $return);
    }
}
