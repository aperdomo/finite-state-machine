# Makefile
.PHONY: init build stop start restart test test-with-coverage test-with-coverage-html dump-autoload phpcs phpcs-fix

# Load .env file
ifneq (,$(wildcard ./.env))
    include .env
    export
endif

DOCKER_EXEC = docker exec -t $(CONTAINER_NAME_SERVICE)

init:
	cp .env.example .env && make build && make start && make composer-install
build:
	docker compose build --no-cache
stop:
	docker compose down
start:
	docker compose up -d
restart:
	make stop && make start
test:
	$(DOCKER_EXEC) php ./vendor/bin/phpunit --testdox
test-with-coverage:
	$(DOCKER_EXEC) docker-php-ext-enable pcov && $(DOCKER_EXEC) ./vendor/bin/phpunit --coverage-text
test-with-coverage-html:
	$(DOCKER_EXEC) docker-php-ext-enable pcov && $(DOCKER_EXEC) ./vendor/bin/phpunit --coverage-html=coverage && open coverage/index.html
dump-autoload:
	$(DOCKER_EXEC) composer dump-autoload
composer-install:
	$(DOCKER_EXEC) composer install
phpcs:
	$(DOCKER_EXEC) ./vendor/bin/phpcs -p
phpcs-fix:
	$(DOCKER_EXEC) ./vendor/bin/php-cs-fixer fix
