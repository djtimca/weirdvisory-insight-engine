# Deployment Instructions for Tim's Weirdvisory Strategic Insight Engine

This document provides instructions for deploying and updating Tim's Weirdvisory Strategic Insight Engine on a PHP/Laravel hosting environment.

## Prerequisites

- PHP 8.1 or higher
- Composer
- Git
- Web server (Apache/Nginx) with PHP support
- SSL certificate (recommended for production)

## Initial Deployment

### 1. Clone the Repository

```bash
# Create the directory for your application (if it doesn't exist)
mkdir -p /path/to/your/hosting/directory
cd /path/to/your/hosting/directory

# Clone the repository
git clone https://github.com/djtimca/weirdvisory-insight-engine.git .
```

### 2. Install Dependencies

```bash
# Install PHP dependencies
composer install --no-dev --optimize-autoloader
```

### 3. Configure Environment

```bash
# Copy the example environment file
cp .env.example .env

# Generate application key
php artisan key:generate

# Create the SQLite database file
touch database/database.sqlite

# Run migrations to set up the session table
php artisan migrate --force
```

Edit the `.env` file to set your environment-specific configurations:

```
APP_NAME="Tim's Weirdvisory Strategic Insight Engine"
APP_ENV=production
APP_DEBUG=false
APP_URL=https://your-domain.com

# Database Configuration
DB_CONNECTION=sqlite
# No need for other DB_ settings when using SQLite

# Gemini API Configuration
GEMINI_API_URL="https://generativelanguage.googleapis.com/v1beta/models/gemini-2.0-flash:generateContent"
GEMINI_API_KEY="YOUR_GEMINI_API_KEY"
```

### 4. Set Directory Permissions

```bash
# Set proper permissions
chmod -R 755 .
chmod -R 775 storage bootstrap/cache
chown -R www-data:www-data .  # Use the appropriate web server user
```

### 5. Configure Web Server

#### For Apache

Create or modify your virtual host configuration:

```apache
<VirtualHost *:80>
    ServerName your-domain.com
    DocumentRoot /path/to/your/hosting/directory/public
    
    <Directory /path/to/your/hosting/directory/public>
        AllowOverride All
        Require all granted
    </Directory>
    
    ErrorLog ${APACHE_LOG_DIR}/error.log
    CustomLog ${APACHE_LOG_DIR}/access.log combined
</VirtualHost>
```

Enable the site and restart Apache:

```bash
a2ensite your-site-config
systemctl restart apache2
```

#### For Nginx

Create a new server block:

```nginx
server {
    listen 80;
    server_name your-domain.com;
    root /path/to/your/hosting/directory/public;

    add_header X-Frame-Options "SAMEORIGIN";
    add_header X-Content-Type-Options "nosniff";

    index index.php;

    charset utf-8;

    location / {
        try_files $uri $uri/ /index.php?$query_string;
    }

    location = /favicon.ico { access_log off; log_not_found off; }
    location = /robots.txt  { access_log off; log_not_found off; }

    error_page 404 /index.php;

    location ~ \.php$ {
        fastcgi_pass unix:/var/run/php/php8.1-fpm.sock;
        fastcgi_param SCRIPT_FILENAME $realpath_root$fastcgi_script_name;
        include fastcgi_params;
    }

    location ~ /\.(?!well-known).* {
        deny all;
    }
}
```

Enable the site and restart Nginx:

```bash
ln -s /etc/nginx/sites-available/your-site-config /etc/nginx/sites-enabled/
systemctl restart nginx
```

### 6. Optimize the Application

```bash
# Clear and cache routes, config, etc.
php artisan optimize
```

## Updating the Application

We've included a convenient update script that handles the update process. To update your application:

```bash
# Navigate to your application directory
cd /path/to/your/hosting/directory

# Run the update script
./update.sh
```

The update script will:
1. Pull the latest changes from the GitHub repository
2. Update Composer dependencies
3. Clear application caches
4. Run any pending database migrations
5. Optimize the application

## Troubleshooting

### Common Issues

1. **Permission Errors**:
   - Ensure proper permissions on storage and bootstrap/cache directories
   - Command: `chmod -R 775 storage bootstrap/cache`

2. **API Key Issues**:
   - Verify your Gemini API key is correctly set in the .env file
   - Test the API connection using the application's error handling

3. **Web Server Configuration**:
   - Ensure the web server is pointing to the /public directory
   - Verify that mod_rewrite (Apache) or equivalent (Nginx) is enabled

### Logs

Check the Laravel logs for detailed error information:

```bash
tail -f storage/logs/laravel.log
```

## Security Considerations

1. **Environment File**: 
   - Keep your `.env` file secure and never commit it to version control
   - Restrict file permissions on the `.env` file: `chmod 600 .env`

2. **API Key Protection**:
   - Store your Gemini API key securely in the `.env` file
   - Consider using environment variables at the server level for added security

3. **SSL/HTTPS**:
   - Always use HTTPS in production
   - Configure your web server with a valid SSL certificate

## Contact

For assistance with deployment issues, please contact:
- Email: hiring@wierdadvisory.com
