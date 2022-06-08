.PHONY: all
all:

compose := docker-compose
compose-run := $(compose) run --rm

# ======== Build ========

.PHONY: build
build:
	$(compose) build

# ======== Run ========

.PHONY: sqlite-up
sqlite-up:
	$(compose) up -d

.PHONY: mysql-up
mysql-up:
	MYSQL_HOST=mysql $(compose) --profile mysql up -d

.PHONY: wait-for-wiki
wait-for-wiki:
	$(compose-run) wait-for-wiki

.PHONY: show-status
show-status:
	$(compose) ps

.PHONY: show-logs
show-logs:
	$(compose) logs -f || exit 0

.PHONY: stop
stop:
	$(compose) stop

.PHONY: down
down:
	$(compose) down

.PHONY: destroy
destroy:
	$(compose) down --volumes --remove-orphans

# ======== Backstop ========

backstop := $(compose-run) backstop --config backstop.config.js

.PHONY: backstop-test
backstop-test: wait-for-wiki
	$(backstop) test

.PHONY: backstop-approve
backstop-approve:
	$(backstop) approve

# ======== Backup ========

backup := $(compose) pull backup && $(compose-run) backup

.PHONY: create-backup
create-backup: wait-for-wiki
	$(backup) create

.PHONY: restore-backup
restore-backup: wait-for-wiki
	$(backup) restore

# ======== CI ========

.PHONY: ci
ci: build mysql-up restore-backup backstop-test destroy

# ======== Release ========

VERSION = `sed -n -e 's/^ARG CONFIDENT_VERSION=//p' ./context/Dockerfile`

.PHONY: release
release: ci git-push gh-login
	gh release create $(VERSION)

.PHONY: git-push
git-push:
	git diff --quiet || (echo 'git directory has changes'; exit 1)
	git fetch # make sure we have access to the repository
	git push

.PHONY: gh-login
gh-login: require-GH_API_TOKEN
	gh config set prompt disabled
	@echo $(GH_API_TOKEN) | gh auth login --with-token

.PHONY: require-GH_API_TOKEN
require-GH_API_TOKEN:
ifndef GH_API_TOKEN
	$(error GH_API_TOKEN is not set)
endif
