## About This Project

This project proposes an approach to building a Finite-State Machine (FSM) in PHP as a library.

The FSM is a simple implementation that allows for the definition of states, transitions, and an alphabet to transition against.

Some general notes on the philosophy around the structure and approach to building this FSM:

- It is not exhaustively engineered aside from capturing core abstractions and concepts.
  - Those being `States`, `Transitions`, an `Alphabet`, and orchestrating the interactions between those in a `Machine`.
  - What is delivered here includes full test coverage for the approach, including assertions for the cases described in the assignment document.
### Prerequisites

- Docker.
  - This project is dockerized and optimally will be able to be built and run with Docker.
    - This will allow you to run things like test coverage generation, linting, etc. without needing to ensure stuff is installed on your local machine (aside from Docker, of course).

### Optional

- The ability to run `make` commands.
  - Otherwise, just pull the command stubs out of the Makefile and run them manually.

### Usage - Instantiating a Finite-State Machine for the Assignment Example

```php
$states = new \Src\FSM\States\StateCollection(
    new State('S0', '0'),
    new State('S1', '1'),
    new State('S2', '2')
);

$finalStates = new \Src\FSM\States\StateCollection(
    new State('S0', '0')
);

$initialState = $states->getByName('S0');
$s0 = $states->getByName('S0');
$s1 = $states->getByName('S1');
$s2 = $states->getByName('S2');
$transitionTable = new \Src\FSM\Transitions\Table();
$transitionTable->add(
    new \Src\FSM\Transitions\Transition($s0, '0', $s0),
    new \Src\FSM\Transitions\Transition($s0, '1', $s1),
    new \Src\FSM\Transitions\Transition($s1, '0', $s2),
    new \Src\FSM\Transitions\Transition($s1, '1', $s0),
    new \Src\FSM\Transitions\Transition($s2, '0', $s1),
    new \Src\FSM\Transitions\Transition($s2, '1', $s2)
);

$alphabet = new \Src\FSM\Alphabet('0', '1');

$machine = new \Src\FSM\Machine(
    $states,
    $alphabet,
    $initialState,
    $finalStates,
    $transitionTable
);

// Process the input string '110'.
$machine->process('1', '1', '0');

// Returns 'S0'.
$machine->getCurrentState()->getName();
// Returns '0'.
$machine->getCurrentState()->getOutput()
// Returns `true`.
$machine->isValidFinalState();
```

## Initially building the project

- `make init` - This will initially build + start the project.

## Continuously building the project

- `make build` - This will build the project.
- `make start` - This will start the project.
- `make stop` - This will stop the project.
- `make restart` - This will restart the project.
- `make test` - This will run tests.
- `make test-with-coverage` - This will run tests with coverage printed to standard out.
- `make test-with-coverage-html` - This will run tests with coverage and open the coverage report in a browser.
- `make phpcs` - This will lint the project.
- `make phpcs-fix` - This will apply linter fixes to the project.
