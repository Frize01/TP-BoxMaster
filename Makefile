.PHONY: deploy deploy-no-pull install pull restart-queue

deploy: pull deploy-no-pull

deploy-no-pull: down install up restart-queue

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
	composer install --no-interaction --optimize-autoloader --no-dev
	touch vendor/autoload.php

public/build/manifest.json: package.json
	npm install

reset-git:
	git reset --hard


restart-queue:
	@if ps aux | grep 'php artisan queue:work' | grep -v grep > /dev/null; then \
		echo "Queue est déjà en cours d'exécution, redémarrage..."; \
		pkill -f 'php artisan queue:work' || true; \
		sleep 2; \
	fi; \
	echo "Démarrage de la queue..."; \
	php artisan queue:work & || true 