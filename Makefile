# Constants
EXEC = "docker-compose exec -u$(user) workspace"
EXEC_NON_TTY = "docker-compose exec -u$(user) -T workspace"

# Default variables
user := "user"
db := "app"

##@ Build environment
start: up build ## Start and build environment

stop:
	docker-compose stop

up:
	docker-compose up -d

build: composer-install

composer-install: ## Installs composer dependencies
	"$(EXEC)" composer install

generate: ## Generates request classes based on API definition
	"$(EXEC)" php generate.php
	make rector
	make cs-fix

##@ Analyze
analyze: phpstan cs ## Run code analyzers

phpstan: ## Runs PHPStan static analyzer
	"$(EXEC)" composer phpstan

phpstan-dir: ## <target=src/Foo> Run static analysis of a specific target
	"$(EXEC_NON_TTY)" vendor/bin/phpstan analyse $(target) -c phpstan.neon --no-progress --memory-limit=2G --ansi

cs: ## Runs PHP-CS-Fixer analyzer
	"$(EXEC)" vendor/bin/php-cs-fixer fix --dry-run --stop-on-violation

cs-fix: ## Runs PHP-CS-Fixer and fixes all problems
	"$(EXEC_NON_TTY)" vendor/bin/php-cs-fixer fix --config=.php-cs-fixer.dist.php $(target)

rector: ## Runs PHP-CS-Fixer and fixes all problems
	"$(EXEC_NON_TTY)" vendor/bin/rector process --no-diffs --ansi --memory-limit=2G

##@ Test
test: ## Run test suite
	"$(EXEC)" vendor/bin/phpunit

test-all: ## Run composer test
	"$(EXEC)" composer test

##@ Workspace
cmd: ## [user=user] Open workspace shell
	clear && "$(EXEC)" bash || true && clear


