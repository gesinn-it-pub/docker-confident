BACKSTOP := docker-compose run --rm backstop --config backstop.config.js

all:

.PHONY: ci
ci: build mysql-up backstop-test down

.PHONY: build
build:
	docker build \
	  --tag ghcr.io/gesinn-it-pub/confident:dev \
	  ./context

.PHONY: sqlite-up
sqlite-up:
	docker-compose up -d

.PHONY: mysql-up
mysql-up:
	MYSQL_HOST=mysql docker-compose --profile mysql up -d

.PHONY: show-status
show-status:
	docker-compose ps

.PHONY: show-logs
show-logs:
	docker-compose logs -f || exit 0

.PHONY: stop
stop:
	docker-compose stop

.PHONY: down
down:
	docker-compose down --volumes --remove-orphans

.PHONY: backstop-test
backstop-test:
	$(BACKSTOP) test

.PHONY: backstop-approve
backstop-approve:
	$(BACKSTOP) approve
