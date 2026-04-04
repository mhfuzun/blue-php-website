<?php

// 1. Tüm hataları raporla (E_ALL her şeyi yakalar)
error_reporting(E_ALL);

// 2. Hataların ekrana (HTTP Response) basılmasını KAPAT
ini_set('display_errors', 0);
ini_set('display_startup_errors', 0);

// 3. Hataların bir dosyaya kaydedilmesini AÇ
ini_set('log_errors', 1);

// 4. Log dosyasının yolunu belirt
// TODO: congif ile dosya yolu al, 
// ya da alma, çünkü ilk bu kod çalışmalı config çekmek öncesinde mümkün değil.
ini_set('error_log', __DIR__ . '/php_errors.log');

// Test edelim:
// undefined_variable_test(); // Bu hata ekrana gelmez ama log dosyasına yazılır.

?>
