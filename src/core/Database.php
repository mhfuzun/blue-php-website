<?php
// src/Database.php

class Database {
    private static $instance = null;
    private $pdo;

    private function __construct() {
        // Config sınıfından ayarları alıyoruz
        $host = Config::get('db.host');
        $port = Config::get('db.port');
        $name = Config::get('db.dbname');
        $user = Config::get('db.user');
        $pass = Config::get('db.pass');

        $dsn = "pgsql:host=$host;port=$port;dbname=$name";

        try {
            $this->pdo = new PDO($dsn, $user, $pass, [
                PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::ATTR_EMULATE_PREPARES   => false,
            ]);
        } catch (PDOException $e) {
            error_log("Bağlantı Hatası: " . $e->getMessage());
            die("Veritabanına bağlanılamadı.");
        }
    }

    public static function getInstance() {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance->pdo;
    }
}

?>
