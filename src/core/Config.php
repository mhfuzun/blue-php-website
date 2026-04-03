<?php
// src/Config.php

class Config {
    private static $settings = [];

    // Ayarları bir kez yüklemek için
    public static function load(array $settings) {
        self::$settings = $settings;
    }

    // İstediğimiz ayarı anahtar ile almak için (Nokta notasyonu destekli: db.host gibi)
    public static function get($key, $currentData = null) {
        // Eğer başlangıç aşamasındaysak ana ayar dizisini baz al
        $currentData = $currentData ?? self::$settings;

        // Anahtarı parçalara ayır (ilk parça ve geri kalanı)
        $parts = explode('.', $key, 2);
        $currentKey = $parts[0];
        $remainingKeys = $parts[1] ?? null;

        // Eğer anahtar mevcut değilse null dön
        if (!isset($currentData[$currentKey])) {
            return null;
        }

        // Eğer gidilecek başka anahtar (nokta) varsa, içeriye doğru tekrar çağır
        if ($remainingKeys !== null && is_array($currentData[$currentKey])) {
            return self::get($remainingKeys, $currentData[$currentKey]);
        }

        // Son noktaya ulaşıldıysa değeri döndür
        return $currentData[$currentKey];
    }
}

?>
