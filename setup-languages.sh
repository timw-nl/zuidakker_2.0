#!/bin/bash
# Setup Dutch and English language support for Zuidakker

echo "Setting up multilingual support..."

# Download and install Polylang plugin
docker exec zuidakker_wordpress_2.0 bash -c "cd /var/www/html/wp-content/plugins && \
    curl -O https://downloads.wordpress.org/plugin/polylang.3.6.4.zip && \
    unzip -q polylang.3.6.4.zip && \
    rm polylang.3.6.4.zip && \
    chown -R www-data:www-data polylang"

echo "Polylang plugin downloaded. Please activate it in wp-admin and configure:"
echo "1. Go to http://localhost:8080/wp-admin/admin.php?page=mlang"
echo "2. Add Dutch (nl_NL) as default language"
echo "3. Add English (en_US) as secondary language"
echo "4. Configure language switcher in Settings > Languages"
