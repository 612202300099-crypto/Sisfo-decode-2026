#!/bin/bash

# Exit immediately if a command exits with a non-zero status.
set -e

echo "🚀 Starting Deployment Script..."

# 1. Run Migrations
echo "🐘 Running database migrations..."
php artisan migrate --force

# 2. Optimize Laravel
php artisan config:cache
php artisan route:cache
php artisan view:cache

# 3. Link Storage
php artisan storage:link --force || true

echo "✅ Deployment script finished successfully!"
