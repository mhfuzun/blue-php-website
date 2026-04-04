<?php

define('BASE_PATH', dirname(__DIR__));
require_once BASE_PATH . '/config/phpsetttings.php';

$envFile = __DIR__ . '/../.env';

if (file_exists($envFile)) {
    $lines = file($envFile, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

    foreach ($lines as $line) {
        if (strpos(trim($line), '#') === 0) continue;

        list($key, $value) = explode('=', $line, 2);
        $_ENV[$key] = trim($value);
        putenv("$key=$value");
    }
} else {
    error_log("Environment file not found: " . $envFile);
    die("Environment error!");
}

$settings = require_once BASE_PATH . '/config/config.php';
require_once BASE_PATH . '/config/common.php';
require_once BASE_PATH . '/core/Config.php';
require_once BASE_PATH . '/core/Database.php';
require_once BASE_PATH . '/core/CookieManager.php';
require_once BASE_PATH . '/core/UserManager.php';
require_once BASE_PATH . '/core/SessionManager.php';
require_once BASE_PATH . '/core/Controller.php';

// 2. Config dosyasını Config sınıfına ver
Config::load($settings);

// 3. Nesneleri başlat
$db = Database::getInstance();
$session = new SessionManager();

?>
