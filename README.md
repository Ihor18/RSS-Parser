<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

```composer install```

```cp .env.example .env```

```php artisan key:generate```

```php artisan config:cache```

```php artisan migrate```

```php artisan migrate```

```php artisan parser:run```

 For cron \
```php artisan schedule:run```

```npm install```

```npm run dev```



##Run in Docker container

```docker run --rm -v $(pwd):/app composer install```

```cp .env.example .env```

```php artisan storage:link```

```docker-compose up -d```

```docker-compose exec app php artisan key:generate```

```docker-compose exec app php artisan config:cache```

```docker-compose exec app php artisan migrate```

```docker-compose exec app php artisan db:seed```

```docker-compose exec app php artisan parser:run```

For CRON \
```docker-compose exec app php artisan schedule:run```

Test user:\
admin@admin.com \
qwerty1234

