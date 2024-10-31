<?php

namespace Src\FSM\States\Enum;

enum StateType: string
{
    case NON_FINAL = 'non-final';
    case FINAL = 'final';
}
