#!/bin/sh
set -eu

# The Apache container creates wp-config.php on the shared volume.
attempt=0
until [ -f wp-config.php ]; do
  attempt=$((attempt + 1))
  if [ "$attempt" -ge 60 ]; then
    echo 'WordPress configuration was not created. Check docker compose logs wordpress.' >&2
    exit 1
  fi
  sleep 2
done

if ! wp core is-installed >/dev/null 2>&1; then
  # WP-CLI prompts echo their input. Suppress stdout and redact any failure.
  if ! printf '%s\n' "$LOCAL_ADMIN_PASSWORD" | wp core install \
    --url="$SLICO_SITE_URL" --title='SLICO3D' \
    --admin_user="$LOCAL_ADMIN_USER" --admin_email="$LOCAL_ADMIN_EMAIL" \
    --prompt=admin_password --skip-email >/dev/null 2>/tmp/slico-install-errors.log; then
    php -r 'fwrite(STDERR, str_replace(getenv("LOCAL_ADMIN_PASSWORD"), "[redacted]", file_get_contents("/tmp/slico-install-errors.log")));'
    exit 1
  fi
  rm -f /tmp/slico-install-errors.log
  echo 'WordPress installed.'
fi

wp language core install de_DE
wp site switch-language de_DE

# Install once; a restart must not silently update dependencies.
for plugin in woocommerce woocommerce-germanized; do
  if ! wp plugin is-installed "$plugin"; then
    wp plugin install "$plugin"
  fi
  wp plugin activate "$plugin"
done
if ! wp theme is-installed storefront; then
  wp theme install storefront
fi
wp theme activate slico3d
wp language plugin install --all de_DE || echo 'Plugin translations can be installed later.'
wp language theme install storefront de_DE || echo 'Theme translations can be installed later.'

wp eval-file /workspace/scripts/configure.php
wp rewrite structure '/%postname%/' --hard
wp plugin list --fields=name,status,version
wp theme list --fields=name,status,version
echo 'SLICO3D local shop ready. No sample products or live payment provider added.'
