#!/bin/bash

# Zuidakker Sitemap Page Setup Script
# This script automatically creates or updates the sitemap page with the sitemap_tree shortcode

set -e

echo "🗺️  Starting Sitemap Page Setup..."

# Check if WordPress is running
if ! docker compose ps wordpress | grep -q "Up"; then
    echo "❌ WordPress container is not running."
    echo "   Please start it with: docker compose up -d"
    exit 1
fi

# Install WP-CLI in wordpress container if not present
echo "⏳ Checking WP-CLI installation..."
docker compose exec wordpress bash -c "[ -f /usr/local/bin/wp ] || (curl -sO https://raw.githubusercontent.com/wp-cli/builds/gh-pages/phar/wp-cli.phar && chmod +x wp-cli.phar && mv wp-cli.phar /usr/local/bin/wp)" > /dev/null 2>&1

# WP-CLI command prefix
WP="docker compose exec wordpress wp --allow-root"

# Check if WordPress is installed
if ! $WP core is-installed 2>/dev/null; then
    echo "❌ WordPress is not installed yet."
    echo "   Please complete the initial WordPress setup first."
    echo "   Visit http://localhost:8080 to complete the installation wizard."
    exit 1
fi

echo "✅ WordPress is running"

# Function to create or update sitemap page
create_or_update_sitemap() {
    local title="Sitemap"
    local slug="sitemap"
    local content="<!-- wp:paragraph --><p>Overzicht van alle pagina's op de site.</p><!-- /wp:paragraph --><!-- wp:shortcode -->[sitemap_tree]<!-- /wp:shortcode -->"
    
    # Check if page exists
    local page_id=$($WP post list --post_type=page --name="$slug" --field=ID --format=csv 2>/dev/null || echo "")
    
    if [ -z "$page_id" ]; then
        # Create new page
        echo "📄 Creating sitemap page..."
        $WP post create \
            --post_type=page \
            --post_title="$title" \
            --post_name="$slug" \
            --post_status=publish \
            --post_content="$content"
        echo "✅ Sitemap page created successfully!"
    else
        # Update existing page
        echo "📝 Sitemap page already exists (ID: $page_id)"
        read -p "Do you want to update it with the sitemap_tree shortcode? (y/n) " -n 1 -r
        echo
        if [[ $REPLY =~ ^[Yy]$ ]]; then
            $WP post update "$page_id" \
                --post_content="$content"
            echo "✅ Sitemap page updated successfully!"
        else
            echo "⏭️  Skipped updating sitemap page"
        fi
    fi
}

# Create or update the sitemap page
create_or_update_sitemap

# Flush rewrite rules to ensure the page is accessible
echo "🔄 Flushing rewrite rules..."
$WP rewrite flush --hard

echo ""
echo "✅ Sitemap setup completed!"
echo ""
echo "🌐 View your sitemap at:"
echo "   http://localhost:8080/sitemap"
echo ""
echo "📝 The sitemap page includes:"
echo "   - Hierarchical folder tree structure"
echo "   - Color-coded pillar pages"
echo "   - Icons (📁 folders, 📄 pages)"
echo "   - Page excerpts (if added)"
echo ""
