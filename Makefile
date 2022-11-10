bush:
	docker exec -it parser-fpm bash

test:
	docker exec parser-fpm php ./vendor/phpunit/phpunit/phpunit