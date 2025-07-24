## The Weltsparen Project

### BACKEND - Initial Setup

- Copy and customize your env config, see below. (ie. `.env.example` to `.env`)
- `php artisan key:generate`
- `php artisan migrate`
- `php artisan db:seed CountriesSeeder`

### BACKEND - Common .env file customizations

```
APP_URL=http://localhost
APP_TIMEZONE=UTC
SANCTUM_STATEFUL_DOMAINS=localhost:3000
SESSION_DOMAIN=localhost

// database config
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=weltsparen_dev
DB_USERNAME=weltsparen_user
DB_PASSWORD=weltsparen_pswd
```
