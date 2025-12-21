# Passionate Teaching Journey (2024)

Portfolio project: a WordPress site for **Passionate Teaching Journey**.

This repo contains a full WordPress install plus a database dump used to run the site locally.

## Tech stack

- WordPress (PHP)
- MariaDB / MySQL
- Local dev: XAMPP (Apache + MariaDB)

## Local setup (XAMPP)

### 1) Start services

1. Open **XAMPP Control Panel**
2. Start:
   - **Apache**
   - **MySQL**

### 2) Create/import the database

This repo includes a database dump:

- `u942215055_mnvxE.sql`

Recommended import method (avoids phpMyAdmin timeouts):

```bat
cd /d D:\Websites\2024-PassionateTeachingJourney

"C:\xampp\mysql\bin\mysql.exe" -u root -e "CREATE DATABASE IF NOT EXISTS u942215055_mnvxe DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;"

"C:\xampp\mysql\bin\mysql.exe" -u root --max_allowed_packet=256M u942215055_mnvxe < u942215055_mnvxE.sql
```

Notes:
- If your local `root` user has a password, add `-p` to both commands.
- If you previously imported and got a partial DB, either drop it and re-import or import into a new DB name.

### 3) Configure WordPress to use the local DB

Database settings live in:

- `wp-config.php`

Typical XAMPP local values:

- `DB_NAME`: `u942215055_mnvxe`
- `DB_USER`: `root`
- `DB_PASSWORD`: *(empty by default in many XAMPP installs)*
- `DB_HOST`: `127.0.0.1`

### 4) Browse the site

Open the local site URL you’ve configured for Apache/hosts.

If you use a custom local domain (example):

- `http://2024passionateteachingjourney.localhost/`

## Troubleshooting

### “Got a packet bigger than 'max_allowed_packet' bytes”

Increase `max_allowed_packet` in XAMPP’s MariaDB config:

- `C:\xampp\mysql\bin\my.ini`

Example under `[mysqld]`:

```ini
max_allowed_packet=256M
```

Restart **MySQL** in XAMPP after changing `my.ini`.

### phpMyAdmin error: `#2006 - MySQL server has gone away`

Use the CLI import commands above, or increase PHP/MySQL limits.

### Hostinger plugin fatal error on local

Some Hostinger-specific plugins can expect hosting-only configuration and may crash locally.
If you hit a fatal error mentioning `hostinger` plugins, disable them by renaming folders in:

- `wp-content/plugins/`

For example:

- `hostinger` → `hostinger.disabled`
- `hostinger-ai-assistant` → `hostinger-ai-assistant.disabled`

## Portfolio highlights

- WordPress site build and configuration
- Local development setup with XAMPP
- Database migration/import workflow

## Disclaimer

This repository is intended for local development and portfolio demonstration. Configure credentials and secrets appropriately before deploying to any public environment.
