## About This Project

This is a simple template for conveniently standing up basic PHP environments to noodle on code (and also comes with stuff to run tests against code, etc). It is dockerized and is composed of:

- An app service layer that is running against a PHP 8.3 install.

## Prerequisites

- Docker.

### Optional

- The ability to run `make` commands.
  - Otherwise, just pull the command stubs out of the Makefile and run them manually.

## Initially building the project

1. `make init` - This will initially build + start the project.

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
