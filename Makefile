up:
	docker-compose up -d

down:
	docker-compose down

build:
	docker-compose build

down-clear:
	docker-compose down -v --remove-orphans

console-in:
	docker-compose exec php bash

env:
	docker-compose exec php rm -f .env.local
	docker-compose exec php ln -sr .env .env.local
	docker-compose exec php rm -f .env.test.local
	docker-compose exec php ln -sr .env.test .env.test.local

composer-install:
	docker-compose exec php composer install

genrsa:
	docker-compose exec php sh genrsa.sh

migration:
	docker-compose exec php php bin/console d:m:m --no-interaction

first-init: build up env composer-install genrsa migration
