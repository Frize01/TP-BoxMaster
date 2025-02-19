.PHONY: deploy deploy-no-pull install pull restart-queue

deploy: pull deploy-no-pull

deploy-no-pull: down install up

pull:
	git pull

install: vendor/autoload.php public/storage public/build/manifest.json
	php artisan cache:clear
	php artisan migrate --force --no-interaction
	npm run build

down:
	php artisan down

up:
	php artisan up

public/storage:
	php artisan storage:link

vendor/autoload.php: composer.lock
	composer install --no-interaction --optimize-autoloader --no-dev --ignore-platform-req=ext-gd
	touch vendor/autoload.php

public/build/manifest.json: package.json
	npm install

reset-git:
	git reset --hard
