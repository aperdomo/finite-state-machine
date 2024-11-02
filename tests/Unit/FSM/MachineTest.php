<?php

namespace Tests\Unit\FSM;

use Exception;
use Src\FSM\Chars\Alphabet;
use Src\FSM\States\StateCollection;
use Src\FSM\States\StateFactory;
use Src\FSM\Transitions\Table;
use Src\FSM\Transitions\Transition;
use Tests\BaseTestCase;
use Src\FSM\Machine;

class MachineTest extends BaseTestCase
{
    public function test_it_can_construct(): void
    {
        $fsm = new Machine(
            StateFactory::createMany([
                ['S0', '0'],
                ['S1', '1'],
                ['S2', '2'],
            ]),
            new Alphabet('0', '1'),
            StateFactory::create('S0', '0'),
            StateFactory::createMany([
                ['S0', '0'],
                ['S1', '1'],
                ['S2', '2'],
            ]),
            new Table()
        );

        $this->assertInstanceOf(Machine::class, $fsm);
    }

    public function test_it_can_transition_110(): void
    {
        $s0 = StateFactory::create('S0', '0');
        $s1 = StateFactory::create('S1', '1');
        $s2 = StateFactory::create('S2', '2');
        $states = new StateCollection($s0, $s1, $s2);
        $finalStates = new StateCollection($s0);
        $alphabet =  new Alphabet('0', '1');

        $transitionTable = new Table();
        $transitionTable->add(
            new Transition($s0, '0', $s0),
            new Transition($s0, '1', $s1),
            new Transition($s1, '0', $s2),
            new Transition($s1, '1', $s0),
            new Transition($s2, '0', $s1),
            new Transition($s2, '1', $s2)
        );

        $machine = new Machine(
            $states,
            $alphabet,
            $s0,
            $finalStates,
            $transitionTable
        );

        $this->assertInstanceOf(Machine::class, $machine);
        $this->assertEquals($s0, $machine->getCurrentState());
        $machine->processInput('1');
        $this->assertEquals('S1', $machine->getCurrentState()->getName());
        $this->assertEquals('1', $machine->getCurrentState()->getOutput());

        $machine->processInput('1');
        $this->assertEquals('S0', $machine->getCurrentState()->getName());
        $this->assertEquals('0', $machine->getCurrentState()->getOutput());

        $machine->processInput('0');
        $this->assertEquals('S0', $machine->getCurrentState()->getName());
        $this->assertEquals('0', $machine->getCurrentState()->getOutput());
        $this->assertTrue($machine->isValidFinalState());
    }

    public function test_it_can_transition_1010(): void
    {
        $s0 = StateFactory::create('S0', '0');
        $s1 = StateFactory::create('S1', '1');
        $s2 = StateFactory::create('S2', '2');
        $states = new StateCollection($s0, $s1, $s2);
        $finalStates = new StateCollection($s1);
        $alphabet =  new Alphabet('0', '1');

        $transitionTable = new Table();
        $transitionTable->add(
            new Transition($s0, '0', $s0),
            new Transition($s0, '1', $s1),
            new Transition($s1, '0', $s2),
            new Transition($s1, '1', $s0),
            new Transition($s2, '0', $s1),
            new Transition($s2, '1', $s2)
        );

        $machine = new Machine(
            $states,
            $alphabet,
            $s0,
            $finalStates,
            $transitionTable
        );

        $this->assertInstanceOf(Machine::class, $machine);
        $this->assertEquals($s0, $machine->getCurrentState());
        $machine->processInput('1');
        $this->assertEquals('S1', $machine->getCurrentState()->getName());
        $this->assertEquals('1', $machine->getCurrentState()->getOutput());

        $machine->processInput('0');
        $this->assertEquals('S2', $machine->getCurrentState()->getName());
        $this->assertEquals('2', $machine->getCurrentState()->getOutput());

        $machine->processInput('1');
        $this->assertEquals('S2', $machine->getCurrentState()->getName());
        $this->assertEquals('2', $machine->getCurrentState()->getOutput());

        $machine->processInput('0');
        $this->assertEquals('S1', $machine->getCurrentState()->getName());
        $this->assertEquals('1', $machine->getCurrentState()->getOutput());
        $this->assertTrue($machine->isValidFinalState());
    }

    public function test_it_can_transition_1010_single_statement(): void
    {
        $s0 = StateFactory::create('S0', '0');
        $s1 = StateFactory::create('S1', '1');
        $s2 = StateFactory::create('S2', '2');
        $states = new StateCollection($s0, $s1, $s2);
        $finalStates = new StateCollection($s1);
        $alphabet =  new Alphabet('0', '1');

        $transitionTable = new Table();
        $transitionTable->add(
            new Transition($s0, '0', $s0),
            new Transition($s0, '1', $s1),
            new Transition($s1, '0', $s2),
            new Transition($s1, '1', $s0),
            new Transition($s2, '0', $s1),
            new Transition($s2, '1', $s2)
        );

        $machine = new Machine(
            $states,
            $alphabet,
            $s0,
            $finalStates,
            $transitionTable
        );

        $this->assertInstanceOf(Machine::class, $machine);
        $this->assertEquals($s0, $machine->getCurrentState());
        $machine->process('1', '0', '1', '0');
        $this->assertEquals('S1', $machine->getCurrentState()->getName());
        $this->assertEquals('1', $machine->getCurrentState()->getOutput());
        $this->assertTrue($machine->isValidFinalState());
    }

    public function test_it_can_transition_110_single_statement(): void
    {
        $s0 = StateFactory::create('S0', '0');
        $s1 = StateFactory::create('S1', '1');
        $s2 = StateFactory::create('S2', '2');
        $states = new StateCollection($s0, $s1, $s2);
        $finalStates = new StateCollection($s0);
        $alphabet =  new Alphabet('0', '1');

        $transitionTable = new Table();
        $transitionTable->add(
            new Transition($s0, '0', $s0),
            new Transition($s0, '1', $s1),
            new Transition($s1, '0', $s2),
            new Transition($s1, '1', $s0),
            new Transition($s2, '0', $s1),
            new Transition($s2, '1', $s2)
        );

        $machine = new Machine(
            $states,
            $alphabet,
            $s0,
            $finalStates,
            $transitionTable
        );

        $this->assertInstanceOf(Machine::class, $machine);
        $this->assertEquals($s0, $machine->getCurrentState());
        $machine->process('1', '1', '0');
        $this->assertEquals('S0', $machine->getCurrentState()->getName());
        $this->assertEquals('0', $machine->getCurrentState()->getOutput());
        $this->assertTrue($machine->isValidFinalState());
    }

    public function test_it_throws_if_invalid_input_provided(): void
    {
        $this->expectException(Exception::class);
        $s0 = StateFactory::create('S0', '0');
        $s1 = StateFactory::create('S1', '1');
        $s2 = StateFactory::create('S2', '2');
        $states = new StateCollection($s0, $s1, $s2);
        $finalStates = new StateCollection($s0, $s1, $s2);
        $alphabet =  new Alphabet('0', '1');

        $transitionTable = new Table();
        $transitionTable->add(
            new Transition($s0, '0', $s0),
            new Transition($s0, '1', $s1),
            new Transition($s1, '0', $s2),
            new Transition($s1, '1', $s0),
            new Transition($s2, '0', $s1),
            new Transition($s2, '1', $s2)
        );

        $machine = new Machine(
            $states,
            $alphabet,
            $s0,
            $finalStates,
            $transitionTable
        );

        $this->assertInstanceOf(Machine::class, $machine);
        $this->assertEquals($s0, $machine->getCurrentState());
        $machine->processInput(uniqid());
    }

    public function test_it_throws_if_invalid_initial_state_provided(): void
    {
        $this->expectException(Exception::class);
        $s0 = StateFactory::create('S0', '0');
        $s1 = StateFactory::create('S1', '1');
        $s2 = StateFactory::create('S2', '2');
        $states = new StateCollection($s0, $s1, $s2);
        $finalStates = new StateCollection($s0, $s1, $s2);
        $alphabet =  new Alphabet('0', '1');

        $transitionTable = new Table();
        $transitionTable->add(
            new Transition($s0, '0', $s0),
            new Transition($s0, '1', $s1),
            new Transition($s1, '0', $s2),
            new Transition($s1, '1', $s0),
            new Transition($s2, '0', $s1),
            new Transition($s2, '1', $s2)
        );

        new Machine(
            $states,
            $alphabet,
            StateFactory::create('S99', '99'),
            $finalStates,
            $transitionTable
        );
    }

    public function test_it_throws_if_invalid_final_states_provided(): void
    {
        $this->expectException(Exception::class);
        $s0 = StateFactory::create('S0', '0');
        $s1 = StateFactory::create('S1', '1');
        $s2 = StateFactory::create('S2', '2');
        $states = new StateCollection($s0, $s1, $s2);
        $finalStates = new StateCollection($s0, $s1, StateFactory::create('S99', '99'));
        $alphabet =  new Alphabet('0', '1');

        $transitionTable = new Table();
        $transitionTable->add(
            new Transition($s0, '0', $s0),
            new Transition($s0, '1', $s1),
            new Transition($s1, '0', $s2),
            new Transition($s1, '1', $s0),
            new Transition($s2, '0', $s1),
            new Transition($s2, '1', $s2)
        );

        new Machine(
            $states,
            $alphabet,
            $s0,
            $finalStates,
            $transitionTable
        );
    }
}
