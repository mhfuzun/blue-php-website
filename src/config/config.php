<?php
// config.php

if (!function_exists('env')) {
    function env($key, $default = null) {
        return $_ENV[$key] ?? getenv($key) ?? $default;
    }
}

return [
    'app_name' => 'MyProject'.((env('APP_ENV') === 'production') ? '' : (' - ' . env('APP_ENV'))),
    'app_version' => '1.0.0',
    'app_author' => 'Muhammet Furkan UZUN',
    'app_author_url' => 'https://github.com/mhfuzun/blue-php-website',

    'db' => [
        'host' => env('DB_HOST'),
        'port' => env('DB_PORT'),
        'dbname' => env('DB_NAME'),
        'user' => env('DB_USER'),
        'pass' => env('DB_PASS'),
        'charset' => 'utf8',
    ],

    'bootstrap_assets' => [
        'css' => 'assets/css/bootstrap.min.css',
        'js' => 'assets/js/bootstrap.bundle.min.js',
    ],
];

?>