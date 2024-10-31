<?php

namespace Tests\Unit\FSM\States;

use Src\FSM\States\State;
use Src\FSM\States\StateCollection;
use Src\FSM\States\StateFactory;
use Tests\BaseTestCase;
use Src\FSM\States\Enum\StateType;

class StateTest extends BaseTestCase
{
    public function test_it_can_construct(): void
    {
        $obj = new State('S0', '0', StateType::NON_FINAL);
        $this->assertInstanceOf(State::class, $obj);
    }

    public function test_it_can_construct_from_factory(): void
    {
        $obj = StateFactory::create('S0', '0', StateType::NON_FINAL);
        $this->assertInstanceOf(State::class, $obj);

        $objs = StateFactory::createMany([
            ['S0', '0', StateType::NON_FINAL],
            ['S1', '1', StateType::FINAL],
        ]);
        $this->assertCount(2, $objs);
        $this->assertContainsOnlyInstancesOf(State::class, $objs);
        $this->assertInstanceOf(StateCollection::class, $objs);
    }

    public function test_it_can_get_name(): void
    {
        $obj = new State('S0', '0', StateType::NON_FINAL);
        $this->assertEquals('S0', $obj->getName());
    }

    public function test_it_can_get_value(): void
    {
        $obj = new State('S0', '0', StateType::NON_FINAL);
        $this->assertEquals('0', $obj->getOutput());
    }
}
