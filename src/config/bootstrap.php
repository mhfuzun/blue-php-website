<?php
// bootstrap.php

// Bu dosyanın bulunduğu klasörden bağımsız olarak projenin ana dizinini bulur
define('BASE_PATH', dirname(__DIR__) . DIRECTORY_SEPARATOR);

// Sitenin ana URL'ini otomatik bulur (Örn: http://localhost:8000/)
$protocol = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http";
$base_url = $protocol . "://" . $_SERVER['HTTP_HOST'] . "/";

define('URL', $base_url);

// 1. Dosyaları dahil et (Normalde bunları 'composer' ile autoload yapardık)
require_once BASE_PATH . '/config/config.php';
require_once BASE_PATH . '/core/Config.php';
require_once BASE_PATH . '/core/Database.php';
require_once BASE_PATH . '/core/SessionManager.php';

// 2. Config dosyasını yükle ve Config sınıfına ver
$settings = require BASE_PATH . 'config/config.php';
Config::load($settings);

// 3. Nesneleri başlat
$db = Database::getInstance(); // Artık parametre göndermene gerek yok!
$session = new SessionManager();

// Artık her sayfanın başında sadece `require 'bootstrap.php'` demek yeterli.
?>
