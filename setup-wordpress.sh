#!/bin/bash

# Zuidakker WordPress Setup Script
# This script automates the installation of plugins, themes, and initial configuration

set -e

echo "🌱 Starting Zuidakker WordPress Setup..."

# Wait for WordPress to be ready
echo "⏳ Waiting for WordPress to be ready..."
sleep 10

# Install WP-CLI in wordpress container if not present
docker compose exec wordpress bash -c "[ -f /usr/local/bin/wp ] || (curl -O https://raw.githubusercontent.com/wp-cli/builds/gh-pages/phar/wp-cli.phar && chmod +x wp-cli.phar && mv wp-cli.phar /usr/local/bin/wp)" > /dev/null 2>&1

# WP-CLI command prefix
WP="docker compose exec wordpress wp --allow-root"

# Check if WordPress is installed
if ! $WP core is-installed 2>/dev/null; then
    echo "❌ WordPress is not installed yet. Please complete the initial WordPress setup first."
    echo "   Visit http://localhost:8080 to complete the installation wizard."
    exit 1
fi

echo "✅ WordPress is installed"

# Install and activate theme
echo "📦 Installing Kadence Theme..."
$WP theme install kadence || echo "⚠️  Theme installation failed or already exists"

echo "📦 Activating Zuidakker Child Theme..."
$WP theme activate zuidakker-child || echo "⚠️  Child theme activation failed - ensure it exists in wp-content/themes/"

# Install essential plugins
echo "📦 Installing WooCommerce..."
$WP plugin install woocommerce --activate || echo "⚠️  WooCommerce installation failed or already exists"

echo "📦 Installing WooCommerce Bookings..."
# Note: WooCommerce Bookings is a premium plugin, manual installation required
echo "⚠️  WooCommerce Bookings is a premium plugin - requires manual installation"

echo "📦 Installing WooCommerce Subscriptions..."
# Note: WooCommerce Subscriptions is a premium plugin, manual installation required
echo "⚠️  WooCommerce Subscriptions is a premium plugin - requires manual installation"

echo "📦 Installing Kadence Blocks..."
$WP plugin install kadence-blocks --activate || echo "⚠️  Plugin installation failed or already exists"

echo "📦 Installing Yoast SEO..."
$WP plugin install wordpress-seo --activate || echo "⚠️  Plugin installation failed or already exists"

echo "📦 Installing WPForms Lite..."
$WP plugin install wpforms-lite --activate || echo "⚠️  Plugin installation failed or already exists"

echo "📦 Installing UpdraftPlus..."
$WP plugin install updraftplus --activate || echo "⚠️  Plugin installation failed or already exists"

echo "📦 Installing GDPR Cookie Consent..."
$WP plugin install cookie-law-info --activate || echo "⚠️  Plugin installation failed or already exists"

echo "📦 Installing FullCalendar (Simple Calendar)..."
$WP plugin install google-calendar-events --activate || echo "⚠️  Plugin installation failed or already exists"

# Create required pages
echo "📄 Creating required pages..."

# Check and create pages
create_page() {
    local title="$1"
    local slug="$2"
    local content="$3"
    
    if ! $WP post list --post_type=page --name="$slug" --format=count | grep -q "1"; then
        $WP post create --post_type=page --post_title="$title" --post_name="$slug" --post_status=publish --post_content="$content"
        echo "✅ Created page: $title"
    else
        echo "⚠️  Page already exists: $title"
    fi
}

create_page "Tuinen bij de Zuidakker" "tuinen" "<!-- wp:paragraph --><p>Informatie over de tuinen van de RKBS Kaskade en de Zuidakker.</p><!-- /wp:paragraph -->"
create_page "Geschiedenis van Zuidakker" "geschiedenis" "<!-- wp:paragraph --><p>De geschiedenis van de activiteiten op Zuideinde 112 van de familie Warmerdam en de geschiedenis van de Zuidakker.</p><!-- /wp:paragraph -->"
create_page "Ontmoeting aan de oever" "ontmoeting" "<!-- wp:paragraph --><p>Informatie over vergaderruimtes, volkstuinen en andere ontmoetingsmogelijkheden.</p><!-- /wp:paragraph -->"
create_page "Voedseleducatie" "educatie" "<!-- wp:paragraph --><p>Het educatieve voedselprogramma van de Zuidakker.</p><!-- /wp:paragraph -->"
create_page "Verblijf bij de Zuidakker" "verblijf" "<!-- wp:paragraph --><p>Informatie over verblijf, camping en accommodatie.</p><!-- /wp:paragraph -->"
create_page "Sitemap" "sitemap" "<!-- wp:paragraph --><p>Overzicht van alle pagina's op de site.</p><!-- /wp:paragraph -->"
create_page "Agenda" "agenda" "<!-- wp:paragraph --><p>Overzicht van beschikbaarheid en evenementen.</p><!-- /wp:paragraph -->"

# Configure WooCommerce pages
echo "🛒 Setting up WooCommerce pages..."
$WP wc --user=admin tool run install_pages || echo "⚠️  WooCommerce pages setup requires WooCommerce to be configured first"

# Set permalink structure
echo "🔗 Setting permalink structure..."
$WP rewrite structure '/%postname%/' --hard

# Flush rewrite rules
echo "🔄 Flushing rewrite rules..."
$WP rewrite flush --hard

# Update site settings
echo "⚙️  Configuring basic settings..."
$WP option update timezone_string 'Europe/Amsterdam'
$WP option update date_format 'd-m-Y'
$WP option update time_format 'H:i'
$WP option update WPLANG 'nl_NL'

echo ""
echo "✅ WordPress setup completed!"
echo ""
echo "📝 Next steps:"
echo "   1. Configure WooCommerce via the setup wizard"
echo "   2. Install premium plugins manually:"
echo "      - WooCommerce Bookings"
echo "      - WooCommerce Subscriptions"
echo "   3. Configure payment gateways"
echo "   4. Customize the Kadence theme with the 5-pillar color scheme"
echo "   5. Set up booking products and resources"
echo ""
echo "🌐 Access your site:"
echo "   - Frontend: http://localhost:8080"
echo "   - Admin: http://localhost:8080/wp-admin"
echo "   - phpMyAdmin: http://localhost:8081"
echo ""
