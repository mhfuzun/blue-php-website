<?php
    class common {
        public static function getUrl(): string {
            // Sitenin ana URL'ini otomatik bulur (Örn: http://localhost:8000/)
            $protocol = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http";
            $base_url = $protocol . "://" . $_SERVER['HTTP_HOST'] . "/";
            return $base_url;
        }

        /**
        * Input Temizleme (Sanitization)
        * SQL Injection veya XSS riskine karşı veriyi trimler ve zararlı etiketlerden arındırır.
        */
        public static function cleanInput(string $data): string {
            return htmlspecialchars(strip_tags(trim($data)), ENT_QUOTES, 'UTF-8');
        }

        /**
         * ex: <input class="form-check-input" type="checkbox" name="rememberMe" id="rememberMe" value="1">
         */
        public static function getInputCheckbox(string $name): bool{
            return isset($_POST[$name]) ? true : false;
        }

        /**
         * Güvenli random token üretir
         *
         * @param int $length byte cinsinden uzunluk (default: 32 = 256-bit)
         * @return string hex encoded token
         */
        public static function generateToken(int $length = 32): string
        {
            return bin2hex(random_bytes($length));
        }

        /**
         * URL-safe token üretir (base64)
         */
        public static function generateUrlSafeToken(int $length = 32): string
        {
            return rtrim(strtr(base64_encode(random_bytes($length)), '+/', '-_'), '=');
        }

        /**
         * Token hash (DB için saklama)
         */
        public static function hashToken(string $token): string
        {
            return hash('sha256', $token);
        }

        /**
         * Güvenli karşılaştırma (timing attack koruması)
         */
        public static function verifyToken(string $token, string $hash): bool
        {
            return hash_equals($hash, self::hashToken($token));
        }
    }
?>