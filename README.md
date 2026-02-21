# PassionateTeachingJourney.com

This repository is a **self-contained WordPress snapshot** for PassionateTeachingJourney.com: WordPress core + `wp-content` + a database dump so the site can be reproduced locally with realistic content, theme configuration, and plugin settings.

It’s intentionally developer-friendly: you should be able to clone, import the DB, and boot the site without running the WordPress installer.

## Quickstart (Windows, XAMPP)

### Prerequisites

- Apache + PHP + MySQL/MariaDB (e.g., XAMPP)
- A local virtual host **or** a path-based Apache setup

### 1) Start services

Start **Apache** and **MySQL** in XAMPP.

### 2) Create the database + import the dump

This repo ships with a DB dump: `u942215055_mnvxE.sql`.

The active config in `wp-config.php` expects:

- `DB_NAME`: `u942215055_mnvxe`
- `DB_USER`: `root`
- `DB_PASSWORD`: empty
- `DB_HOST`: `127.0.0.1`

CLI import example:

```bat
cd /d D:\Websites\033-2024-PassionateTeachingJourney.com

"C:\xampp\mysql\bin\mysql.exe" -u root -e "CREATE DATABASE IF NOT EXISTS u942215055_mnvxe DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;"

"C:\xampp\mysql\bin\mysql.exe" -u root --max_allowed_packet=256M u942215055_mnvxe < u942215055_mnvxE.sql
```

If you prefer phpMyAdmin: create the DB named `u942215055_mnvxe`, then import the SQL file.

### 3) Point Apache at the repo

Two common approaches:

- **VirtualHost** (recommended): set the document root to this repo folder.
- **Path-based**: place the repo under your Apache web root and access via a path URL.

This workspace includes a VS Code task that opens:

- `http://2024passionateteachingjourney.localhost/`

If you use that exact URL, ensure your hosts/vhost setup resolves it to your local Apache.

### 4) Fix the site URL (only if your local domain differs)

WordPress stores absolute URLs in the database (and sometimes serialized data).

Minimal fix (often enough) is updating `home` + `siteurl`:

```sql
UPDATE wp_options SET option_value = 'http://YOUR-LOCAL-URL' WHERE option_name IN ('home','siteurl');
```

If content/widgets/builders contain serialized URLs, use a **serialized-safe** search/replace (WP-CLI is the cleanest):

```bash
wp search-replace "https://OLD-DOMAIN" "http://YOUR-LOCAL-URL" --all-tables --precise
```

## Repo layout

This repository contains **two WordPress installs**:

- `/` (root): primary copy
- `staging/`: a separate WordPress copy used as a staging snapshot for safe iteration

The main developer touchpoints:

- `wp-content/themes/` — theme(s) and presentation
- `wp-content/plugins/` — site capabilities
- `wp-content/uploads/` — media (tracked so the portfolio renders correctly)
- `wp-config.php` — runtime configuration
- `.htaccess` — rewrite rules and LiteSpeed Cache directives

WordPress core is included on purpose to keep the repo runnable without external downloads.

## Themes

Themes included:

- `wp-content/themes/yuki/` — primary theme
- `wp-content/themes/yuki-blogger/` — Yuki-based variant with blogger-oriented defaults
- `staging/wp-content/themes/creativ-education/` — alternate staging direction

Most “development work” for this site is configuration-driven:

- WordPress Customizer / theme options
- Block editor templates and reusable blocks
- Menus/widgets/navigation composition

## Plugins (capabilities)

Representative plugin stack:

- `wp-content/plugins/all-in-one-seo-pack/` — SEO
- `wp-content/plugins/google-analytics-for-wordpress/` — analytics (MonsterInsights)
- `wp-content/plugins/wpforms-lite/` — forms
- `wp-content/plugins/wpconsent-cookies-banner-privacy-suite/` — cookie consent
- `wp-content/plugins/litespeed-cache/` — caching/performance
- `wp-content/plugins/optinmonster/` — marketing/lead capture
- `wp-content/plugins/userfeedback-lite/` — feedback/surveys

Host-managed plugins are kept disabled for local stability:

- `wp-content/plugins/hostinger.disabled/`
- `wp-content/plugins/hostinger-ai-assistant.disabled/`

Note: `wp-content/mu-plugins/hostinger-auto-updates.php` reflects a Hostinger-managed environment.

## Caching & performance notes

- `.htaccess` contains LiteSpeed Cache markers + WordPress rewrite rules.
- `wp-content/object-cache.php` exists for object-cache integration.

For development, if you see “stale” pages:

- Disable LiteSpeed Cache temporarily, or clear all caches in the plugin UI.
- Consider disabling object cache while actively changing themes/templates.

## Troubleshooting

### Large SQL import fails

If import fails due to size/packet limits, increase MySQL/MariaDB `max_allowed_packet` (or use the CLI import example above which sets a higher packet limit for the session).

### Site white-screens / fatal errors

- Check `wp-content/debug.log` (if enabled) and your web server error log.
- Quick isolation tactic: temporarily disable a plugin by renaming its folder under `wp-content/plugins/`.

Known issue (historical): `userfeedback-lite` has produced a fatal error when expecting a missing file. If you hit that locally, disable the plugin by renaming `wp-content/plugins/userfeedback-lite/`.

### Can’t log into wp-admin

Credentials are not documented in this repo.

Options:

- Use WP-CLI to reset a password (preferred):
  - `wp user list`
  - `wp user update <id> --user_pass="new-password"`
- Or reset via the database (WordPress will re-hash on next login for legacy MD5 resets):

```sql
UPDATE wp_users SET user_pass = MD5('new-password') WHERE user_login = 'your-username';
```

## Staging workflow

`staging/` is a second WordPress install used for experimentation.

- It currently points at the **same database configuration** as root.
- If you want it fully isolated, give staging its own DB name and import a separate copy of the dump.

## What’s version-controlled (and why)

- Database dump: `u942215055_mnvxE.sql` (to review the site in-context)
- Uploads: tracked so the site renders visually complete

Note: `.gitignore` ignores `*.sql` to prevent accidental new exports, but already-tracked dumps remain in the repo.

## Security & privacy

- Treat this as a **portfolio snapshot**, not a hardened production configuration.
- The DB dump can contain URLs, emails, and other content data. Avoid making the repository public unless you sanitize/remove the dump and move any sensitive runtime configuration out of version control.

## Production / deployment notes

This repo is optimized for **reproducibility**, not for long-lived operations.

If you were to run this as a maintained engineering project, a more standard approach is:

- Version-control `wp-content/` only
- Manage core/plugins via tooling (Composer/Bedrock/WP-CLI) and environment-specific config
- Keep secrets out of git (environment variables / host secret manager)
