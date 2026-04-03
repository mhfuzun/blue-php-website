<?php
// config.php

return [
    'app_name' => 'MyProject',
    'app_version' => '1.0.0',
    'app_author' => 'Muhammet Furkan UZUN',
    'app_author_url' => 'https://github.com/mhfuzun/blue-php-website',

    'db' => [
        'host' => 'localhost',
        'port' => '5432',
        'dbname' => 'userdb',
        'user' => 'muhammetfurkanuzun',
        'pass' => '',
        'charset' => 'utf8'
    ],

    'bootstrap_assets' => [
        'css' => 'assets/css/bootstrap.min.css',
        'js' => 'assets/js/bootstrap.bundle.min.js'
    ]
];

?>