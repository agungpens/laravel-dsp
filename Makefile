.PHONY: build-production
build-production: ## Build the production docker image.
	docker compose build

.PHONY: start-production
start-production: ## Start the production docker container.
	docker compose up -d

.PHONY: stop-production
stop-production: ## Stop the production docker container.
	docker compose down

.PHONY: copy-env
copy-env:
	docker-compose exec app php cp /var/www/.env.production.sample /var/www/.env

.PHONY: key-generate
key-generate:
	docker-compose exec app php artisan key:generate

.PHONY: config-cache
config-cache:
	docker-compose exec app php artisan config:cache

.PHONY: route-cache
route-cache:
	docker-compose exec app php artisan route:cache
