install:
	composer install

lint:
	php vendor/bin/phpcs src bin

test:
	php vendor/bin/phpunit tests

test-coverage:
	XDEBUG_MODE=coverage composer exec --verbose phpunit tests -- --coverage-clover=build/logs/clover.xml