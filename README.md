## About This Project

This project proposes an approach to building a Finite-State Machine (FSM) in PHP. The FSM is a simple implementation that allows for the definition of states, transitions, and actions.
The FSM is built to be extensible and flexible, allowing for the addition of new states, transitions, and actions.

Some general notes on the philosophy around the structure and approach to building this FSM:

- 

### Usage - Instantiating a Finite-State Machine for the Assignment Example

```php
$states = new StateCollection(
    new State('S0', '0'),
    new State('S1', '1'),
    new State('S2', '2')
);

$finalStates = new StateCollection(
    new State('S0', '0')
);

$initialState = $states->getByName('S0');
$s0 = $states->getByName('S0');
$s1 = $states->getByName('S1');
$s2 = $states->getByName('S2');
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
    $initialState,
    $finalStates,
    $transitionTable
);

$machine->process('1', '1', '0');
$machine->getCurrentState()->getName();
// Returns 'S0'.
$machine->getCurrentState()->getOutput()
// Returns '0'.
$machine->isValidFinalState();
// Returns `true`.
```



## Prerequisites

- Docker.
  - This project is dockerized and optimally will be able to be built and run with Docker.
    - This will allow you to run things like test coverage generation, linting, and other tasks without needing to install PHP, Composer, etc. on your local machine.
    - If you don't have Docker, you can still run the project locally, but you will need to install PHP, Composer, etc. on your local machine.

### Optional

- The ability to run `make` commands.
  - Otherwise, just pull the command stubs out of the Makefile and run them manually.

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

## About the project

## Using the library

