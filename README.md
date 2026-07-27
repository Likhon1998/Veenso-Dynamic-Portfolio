# Veenso Dynamic Portfolio

Laravel dynamic portfolio / agency website for **Veenso**, with a full admin CMS.

## Stack

- Laravel 12 (PHP)
- PostgreSQL (Supabase-ready)
- Blade + Tailwind CSS v4 + Vite
- Admin panel with CRUD for all public content

## Setup

```bash
composer install
cp .env.example .env
php artisan key:generate
# Configure DB_* in .env
php artisan migrate
php artisan db:seed          # admin user only
php artisan veenso:install-demo   # demo content + images
php artisan storage:link
npm install && npm run build
php artisan serve
```

## Admin

- URL: `/admin/login`
- Email: `admin@veenso.com`
- Password: `password`

## Notes

- Seeder creates **admin only** — demo content is installed via `php artisan veenso:install-demo`
- Site copy, hero media, services, portfolio, blog, and more are editable in the admin panel
- Never commit `.env` (already gitignored)
