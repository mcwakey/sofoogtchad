# VPS Deployment Guide — Sofoodtchad (Laravel 11)

## Requirements

- Ubuntu 22.04+ (or Debian-based)
- PHP 8.2+
- Composer
- Node.js 18+ & npm
- MySQL 8+
- Nginx
- Git

---

## 1. Server Initial Setup

```bash
sudo apt update && sudo apt upgrade -y
sudo apt install -y git unzip curl nginx mysql-server
```

---

## 2. Install PHP 8.2

```bash
sudo apt install -y software-properties-common
sudo add-apt-repository ppa:ondrej/php -y
sudo apt update
sudo apt install -y php8.2 php8.2-fpm php8.2-mysql php8.2-mbstring \
  php8.2-xml php8.2-bcmath php8.2-curl php8.2-zip php8.2-gd php8.2-intl
```

Verify:
```bash
php -v
```

---

## 3. Install Composer

```bash
curl -sS https://getcomposer.org/installer | php
sudo mv composer.phar /usr/local/bin/composer
composer --version
```

---

## 4. Install Node.js & npm

```bash
curl -fsSL https://deb.nodesource.com/setup_20.x | sudo -E bash -
sudo apt install -y nodejs
node -v && npm -v
```

---

## 5. Configure MySQL

```bash
sudo mysql_secure_installation
sudo mysql -u root -p
```

Inside MySQL:
```sql
CREATE DATABASE sofoodtchad CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
CREATE USER 'sofood'@'localhost' IDENTIFIED BY 'your_strong_password';
GRANT ALL PRIVILEGES ON sofoodtchad.* TO 'sofood'@'localhost';
FLUSH PRIVILEGES;
EXIT;
```

---

## 6. Clone the Project

```bash
cd /var/www
sudo git clone https://github.com/mcwakey/sofoogtchad.git sofoodtchad
sudo chown -R www-data:www-data /var/www/sofoodtchad
sudo chmod -R 755 /var/www/sofoodtchad
```

---

## 7. Install PHP Dependencies

```bash
cd /var/www/sofoodtchad
sudo -u www-data composer install --no-dev --optimize-autoloader
```

---

## 8. Configure Environment

```bash
sudo cp .env.example .env
sudo nano .env
```

Update these values:

```env
APP_NAME=Sofoodtchad
APP_ENV=production
APP_KEY=                    # will be generated below
APP_DEBUG=false
APP_URL=https://yourdomain.com

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=sofoodtchad
DB_USERNAME=sofood
DB_PASSWORD=your_strong_password

SESSION_DRIVER=database
QUEUE_CONNECTION=database
FILESYSTEM_DISK=local
```

Generate the app key:
```bash
sudo -u www-data php artisan key:generate
```

---

## 9. Build Frontend Assets

```bash
npm install
npm run build
```

---

## 10. Run Migrations & Seeders

```bash
sudo -u www-data php artisan migrate --force
sudo -u www-data php artisan db:seed --force   # optional, only if seeders are needed
```

---

## 11. Set Storage Permissions & Link

```bash
sudo chown -R www-data:www-data storage bootstrap/cache
sudo chmod -R 775 storage bootstrap/cache
sudo -u www-data php artisan storage:link
```

---

## 12. Optimize Laravel for Production

```bash
sudo -u www-data php artisan config:cache
sudo -u www-data php artisan route:cache
sudo -u www-data php artisan view:cache
sudo -u www-data php artisan event:cache
```

---

## 13. Configure Nginx

Create the site config:
```bash
sudo nano /etc/nginx/sites-available/sofoodtchad
```

Paste:
```nginx
server {
    listen 80;
    server_name yourdomain.com www.yourdomain.com;
    root /var/www/sofoodtchad/public;

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
        fastcgi_pass unix:/var/run/php/php8.2-fpm.sock;
        fastcgi_param SCRIPT_FILENAME $realpath_root$fastcgi_script_name;
        include fastcgi_params;
    }

    location ~ /\.(?!well-known).* {
        deny all;
    }
}
```

Enable and reload:
```bash
sudo ln -s /etc/nginx/sites-available/sofoodtchad /etc/nginx/sites-enabled/
sudo nginx -t
sudo systemctl reload nginx
```

---

## 14. SSL with Let's Encrypt (HTTPS)

```bash
sudo apt install -y certbot python3-certbot-nginx
sudo certbot --nginx -d yourdomain.com -d www.yourdomain.com
```

Certbot will automatically update your Nginx config for HTTPS and set up auto-renewal.

---

## 15. Queue Worker (optional)

If using `QUEUE_CONNECTION=database`, set up a Supervisor worker:

```bash
sudo apt install -y supervisor
sudo nano /etc/supervisor/conf.d/sofoodtchad-worker.conf
```

```ini
[program:sofoodtchad-worker]
process_name=%(program_name)s_%(process_num)02d
command=php /var/www/sofoodtchad/artisan queue:work --sleep=3 --tries=3 --max-time=3600
autostart=true
autorestart=true
stopasgroup=true
killasgroup=true
user=www-data
numprocs=1
redirect_stderr=true
stdout_logfile=/var/www/sofoodtchad/storage/logs/worker.log
stopwaitsecs=3600
```

```bash
sudo supervisorctl reread
sudo supervisorctl update
sudo supervisorctl start sofoodtchad-worker:*
```

---

## 16. Scheduled Tasks (Cron)

```bash
sudo crontab -u www-data -e
```

Add:
```cron
* * * * * cd /var/www/sofoodtchad && php artisan schedule:run >> /dev/null 2>&1
```

---

## Redeployment Checklist

When pushing new code to the VPS:

```bash
cd /var/www/sofoodtchad
git pull origin main
sudo -u www-data composer install --no-dev --optimize-autoloader
npm install && npm run build
sudo -u www-data php artisan migrate --force
sudo -u www-data php artisan config:cache
sudo -u www-data php artisan route:cache
sudo -u www-data php artisan view:cache
sudo supervisorctl restart sofoodtchad-worker:*
```

---

## Troubleshooting

| Problem | Fix |
|---|---|
| 500 error | Check `storage/logs/laravel.log` |
| Permission denied | `sudo chown -R www-data:www-data storage bootstrap/cache` |
| Nginx 502 Bad Gateway | `sudo systemctl restart php8.2-fpm` |
| Assets not loading | Re-run `npm run build` and clear view cache |
| Migrations fail | Check DB credentials in `.env` |
