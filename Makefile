install:
	composer install

lint:
	php vendor/bin/phpcs src bin

test:
	php vendor/bin/phpunit tests