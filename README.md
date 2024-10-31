## About This Project

This project 

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
