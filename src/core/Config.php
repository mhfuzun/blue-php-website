<?php
// src/Config.php

class Config {
    private static $settings = [];

    // Ayarları bir kez yüklemek için
    public static function load(array $settings) {
        self::$settings = $settings;
    }

    // İstediğimiz ayarı anahtar ile almak için (Nokta notasyonu destekli: db.host gibi)
    public static function get($key) {
        $keys = explode('.', $key);
        $value = self::$settings;

        foreach ($keys as $k) {
            if (isset($value[$k])) {
                $value = $value[$k];
            } else {
                return null;
            }
        }
        return $value;
    }
}

?>
