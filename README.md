# Laravel + Vue Starter Kit

[Laravel 12.x Inertia Vue](https://laravel.com/docs/12.x)

##### Libraries
- [Axios 1.10.0](https://axios-http.com/docs/intro)
- [Pinia 0.11.1](https://vuejs.org/guide/quick-start)

##### Requirements
- [PHP >= 8.2](https://laravel.com/docs/12.x/deployment)
- [Node >= 22.20](https://laravel.com/docs/12.x/deployment)

##### Installation
    composer install
    copy .env-example to .env
    php artisan key:generate
    php artisan migrate:fresh --seed
    composer run dev

##### Structure
- app
    - Http
    - Models
    - Providers
    - Traits
- bootstrap
- config
- database
    - factories
    - migrations
    - seeders
- public
- resources
    - css
    - js
    - views
- routes
- storage
    - app
    - framework
    - logs
- tests

#### Laravel Optimize Performance (optional)
1. When installing vendors in Laravel, use the --no-dev option so that development dependencies are not installed.
    composer install --optimize-autoloader --no-dev
2. Use artisan optimize
    php artisan optimize

#### Reminder
    app/Http/Middleware/HandleInertiaRequests.php => setting $page
    config/fortify => enable/disable two factor auth
    resouce/js/components/appSidebar.vue => menu sidebar
    resouce/js/layouts/AuthLayout.vue => view auth
    resouce/js/layouts/AppLayout.vue => view dashboard