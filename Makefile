.PHONY: help up down restart logs shell wp setup clean backup restore status

# Colors for terminal output
BLUE := \033[0;34m
GREEN := \033[0;32m
YELLOW := \033[0;33m
NC := \033[0m # No Color

help: ## Show this help message
	@echo "$(BLUE)Zuidakker WordPress - Available Commands$(NC)"
	@echo ""
	@grep -E '^[a-zA-Z_-]+:.*?## .*$$' $(MAKEFILE_LIST) | sort | awk 'BEGIN {FS = ":.*?## "}; {printf "  $(GREEN)%-15s$(NC) %s\n", $$1, $$2}'
	@echo ""

up: ## Start all containers
	@echo "$(BLUE)Starting Zuidakker WordPress...$(NC)"
	docker-compose up -d
	@echo "$(GREEN)✓ Services started$(NC)"
	@echo "  WordPress: http://localhost:8080"
	@echo "  Admin: http://localhost:8080/wp-admin"
	@echo "  phpMyAdmin: http://localhost:8081"

down: ## Stop all containers
	@echo "$(BLUE)Stopping containers...$(NC)"
	docker-compose down
	@echo "$(GREEN)✓ Services stopped$(NC)"

restart: ## Restart all containers
	@echo "$(BLUE)Restarting containers...$(NC)"
	docker-compose restart
	@echo "$(GREEN)✓ Services restarted$(NC)"

logs: ## Show logs (follow mode)
	docker-compose logs -f

logs-wordpress: ## Show WordPress logs only
	docker-compose logs -f wordpress

logs-db: ## Show database logs only
	docker-compose logs -f db

shell: ## Open bash shell in WordPress container
	docker exec -it zuidakker_wordpress_2.0 bash

shell-db: ## Open MySQL shell
	docker exec -it zuidakker_mysql_2.0 mysql -uzuidakker -pzuidakker zuidakker

wp: ## Run WP-CLI command (use: make wp cmd="plugin list")
	docker compose exec wpcli wp $(cmd)

wp-shell: ## Open WP-CLI interactive shell
	docker compose exec wpcli wp shell

setup: ## Run automated WordPress setup
	@echo "$(BLUE)Running WordPress setup...$(NC)"
	@chmod +x setup-wordpress.sh
	./setup-wordpress.sh
	@echo "$(GREEN)✓ Setup completed$(NC)"

setup-sitemap: ## Create or update sitemap page automatically
	@echo "$(BLUE)Setting up sitemap page...$(NC)"
	@chmod +x setup-sitemap.sh
	./setup-sitemap.sh
	@echo "$(GREEN)✓ Sitemap setup completed$(NC)"


status: ## Show status of all containers
	@echo "$(BLUE)Container Status:$(NC)"
	@docker-compose ps

clean: down ## Stop containers and remove volumes (WARNING: deletes database!)
	@echo "$(YELLOW)WARNING: This will delete the database!$(NC)"
	@read -p "Are you sure? [y/N] " -n 1 -r; \
	echo; \
	if [[ $$REPLY =~ ^[Yy]$$ ]]; then \
		docker-compose down -v; \
		echo "$(GREEN)✓ Cleaned up$(NC)"; \
	else \
		echo "Cancelled."; \
	fi

backup: ## Create database backup
	@echo "$(BLUE)Creating database backup...$(NC)"
	@mkdir -p setup/backups
	docker compose exec -T wpcli wp db export - > setup/backups/backup-$$(date +%Y%m%d-%H%M%S).sql
	@echo "$(GREEN)✓ Backup created in setup/backups/$(NC)"

backup-files: ## Backup uploads folder
	@echo "$(BLUE)Backing up uploads...$(NC)"
	@mkdir -p setup/backups
	tar -czf setup/backups/uploads-$$(date +%Y%m%d-%H%M%S).tar.gz wp-content/uploads/
	@echo "$(GREEN)✓ Files backed up$(NC)"

restore: ## Restore database from latest backup
	@echo "$(BLUE)Available backups:$(NC)"
	@ls -1t setup/backups/*.sql 2>/dev/null || echo "No backups found"
	@read -p "Enter backup filename: " backup; \
	if [ -f "setup/backups/$$backup" ]; then \
		docker compose exec -T wpcli wp db import - < setup/backups/$$backup; \
		echo "$(GREEN)✓ Database restored$(NC)"; \
	else \
		echo "$(YELLOW)Backup file not found$(NC)"; \
	fi

plugin-list: ## List installed plugins
	@docker compose exec wpcli wp plugin list

theme-list: ## List installed themes
	@docker compose exec wpcli wp theme list

user-list: ## List WordPress users
	@docker compose exec wpcli wp user list

cache-flush: ## Flush WordPress cache
	@echo "$(BLUE)Flushing cache...$(NC)"
	docker compose exec wpcli wp cache flush
	docker compose exec wpcli wp rewrite flush
	@echo "$(GREEN)✓ Cache flushed$(NC)"

install-plugin: ## Install plugin (use: make install-plugin name=plugin-name)
	@echo "$(BLUE)Installing plugin: $(name)$(NC)"
	docker compose exec wpcli wp plugin install $(name) --activate
	@echo "$(GREEN)✓ Plugin installed$(NC)"

update-plugins: ## Update all plugins
	@echo "$(BLUE)Updating plugins...$(NC)"
	docker compose exec wpcli wp plugin update --all
	@echo "$(GREEN)✓ Plugins updated$(NC)"

update-core: ## Update WordPress core
	@echo "$(BLUE)Updating WordPress core...$(NC)"
	docker compose exec wpcli wp core update
	@echo "$(GREEN)✓ WordPress updated$(NC)"

permissions-fix: ## Fix file permissions
	@echo "$(BLUE)Fixing permissions...$(NC)"
	docker exec zuidakker_wordpress_2.0 chown -R www-data:www-data /var/www/html/wp-content
	@echo "$(GREEN)✓ Permissions fixed$(NC)"

dev: up logs ## Start in development mode with logs

production-ready: ## Check if ready for production
	@echo "$(BLUE)Production Readiness Check:$(NC)"
	@docker compose exec wpcli wp core verify-checksums || echo "$(YELLOW)⚠ Core files modified$(NC)"
	@docker compose exec wpcli wp plugin verify-checksums --all || echo "$(YELLOW)⚠ Plugin files modified$(NC)"
	@echo "$(GREEN)✓ Checks completed$(NC)"

search-replace: ## Search and replace URLs (use: make search-replace old=http://old.com new=https://new.com)
	@echo "$(BLUE)Performing search-replace (DRY RUN)...$(NC)"
	docker compose exec wpcli wp search-replace '$(old)' '$(new)' --dry-run
	@read -p "Proceed with actual replacement? [y/N] " -n 1 -r; \
	echo; \
	if [[ $$REPLY =~ ^[Yy]$$ ]]; then \
		docker compose exec wpcli wp search-replace '$(old)' '$(new)'; \
		echo "$(GREEN)✓ URLs replaced$(NC)"; \
	else \
		echo "Cancelled."; \
	fi

init: ## Initialize new WordPress installation
	@echo "$(BLUE)Initializing Zuidakker WordPress...$(NC)"
	@make up
	@sleep 10
	@echo "$(YELLOW)Please complete WordPress installation at http://localhost:8080$(NC)"
	@echo "$(YELLOW)Then run: make setup$(NC)"

apply-homepage: ## Apply homepage design from home_look_and_feel.png
	@echo "$(BLUE)Applying homepage template...$(NC)"
	@echo "$(YELLOW)Note: Make sure you have a page set as homepage first$(NC)"
	@echo "See setup/HOMEPAGE_SETUP.md for manual instructions"
	@echo "The design is now active via the [pillars_grid] shortcode"
