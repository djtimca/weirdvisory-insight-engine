#!/bin/bash

# Tim's Weirdvisory Strategic Insight Engine Update Script
# This script updates the application from the GitHub repository

echo "Starting update process for Tim's Weirdvisory Strategic Insight Engine..."

# Check if we're in the right directory (should have artisan file)
if [ ! -f "artisan" ]; then
    echo "Error: artisan file not found. Please run this script from the root of the Laravel application."
    exit 1
fi

# Store current directory
APP_DIR=$(pwd)

# Pull latest changes from GitHub
echo "Pulling latest changes from GitHub repository..."
git pull

# Install/update dependencies
echo "Updating Composer dependencies..."
composer install --no-dev --optimize-autoloader

# Clear caches
echo "Clearing application cache..."
php artisan cache:clear
php artisan config:clear
php artisan route:clear
php artisan view:clear

# Run migrations if any
echo "Running database migrations (if any)..."
php artisan migrate --force

# Optimize the application
echo "Optimizing application..."
php artisan optimize

echo "Update completed successfully!"
echo "Tim's Weirdvisory Strategic Insight Engine is now up to date."
