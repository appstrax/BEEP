#!/bin/sh

set -x
set -e

pwd

# Setup Storage Directory structure
mkdir -p ${PERSISTENT_STORAGE_DIR}/storage
mkdir -p ${PERSISTENT_STORAGE_DIR}/storage/app/public
mkdir -p ${PERSISTENT_STORAGE_DIR}/storage/framework/cache/data
mkdir -p ${PERSISTENT_STORAGE_DIR}/storage/framework/sessions
mkdir -p ${PERSISTENT_STORAGE_DIR}/storage/framework/views
mkdir -p ${PERSISTENT_STORAGE_DIR}/storage/logs
cp storage.bak/app/new_taxonomy_tables.sql ${PERSISTENT_STORAGE_DIR}/storage/app
chmod 777 -R ${PERSISTENT_STORAGE_DIR}/storage


# Migrate DB
#php artisan migrate

# Link storage
# php artisan storage:link
php artisan optimize:clear && php artisan config:cache && php artisan migrate --force && php artisan storage:link 

# Set API_URL
sed -i '/^var API_URL/d' public/app/js/constants.js
echo "" >> public/app/js/constants.js
echo "var API_URL = '${API_URL}';" >> public/app/js/constants.js

cat public/app/js/constants.js

# Start Service
apache2-foreground