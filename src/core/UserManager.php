<?php

/**
 * USE CASES / KULLANIM SENARYOLARI:
 * 1. Yeni Kayıt: Kullanıcıdan gelen verilerin (username, email, password) standartlara uygunluğunu denetler.
 * 2. Şifre Güvenliği: Şifrenin karmaşıklık düzeyini (büyük/küçük harf, rakam, sembol) ölçer.
 * 3. Login İşlemi: Veritabanındaki hash ile girilen şifrenin eşleşmesini kontrol eder.
 * 4. Veri Tutarlılığı: Şifre tekrarı ve e-posta formatı doğruluğunu sağlar.
 * 5. Güvenli Depolama: Şifreleri Argon2id veya BCRYPT algoritmalarıyla güvenli şekilde hash'ler.
 */

class UserManager {

    // Şifre hashleme algoritması (PHP 7.3+ için Argon2id önerilir)
    private static $hashAlgo = PASSWORD_ARGON2ID;

    /**
     * Kullanıcı adı kontrolü
     * Standart: Min 5 karakter, sadece İngilizce karakterler, rakamlar ve alt çizgi.
     * @param string $username
     * @param bool $isUnique Veritabanından gelen "bu isim alınmış mı?" bilgisi
     */
    public static function checkUsername(string $username, bool $isUnique = true): bool {
        if (!$isUnique) return false;
        if (strlen($username) < 5) return false;
        
        // Sadece a-z, A-Z, 0-9 ve _ (Türkçe karakter içermez)
        return (bool) preg_match('/^[a-zA-Z][a-zA-Z0-9_]+$/', $username);
    }

    /**
     * Ad ve Soyad kontrolü
     * Standart: Sadece harfler ve boşluk içermeli.
     */
    public static function checkNameSurname(string $text): bool {
        $text = trim($text);
        if (empty($text) || strlen($text) < 2) return false;
        
        // Unicode desteği ile sadece harfler ve boşluk
        return (bool) preg_match('/^[\p{L} ]+$/u', $text);
    }

    /**
     * Şifre güvenliği kontrolü
     * Standart: En az 5 karakter (Güvenlik için 8 önerilir), 
     * 1 Büyük, 1 Küçük, 1 Sayı, 1 Özel Karakter.
     */
    public static function checkPassword(string $password): bool {
        if (strlen($password) < 5) return false;

        $hasUppercase = preg_match('/[A-Z]/', $password);
        $hasLowercase = preg_match('/[a-z]/', $password);
        $hasNumber    = preg_match('/[0-9]/', $password);
        $hasSpecial   = preg_match('/[^a-zA-Z0-9]/', $password);

        return $hasUppercase && $hasLowercase && $hasNumber && $hasSpecial;
    }

    /**
     * Şifre tekrarı kontrolü
     */
    public static function checkPasswordConfirmation(string $password, string $confirm): bool {
        return $password === $confirm;
    }

    /**
     * E-posta kontrolü
     */
    public static function checkEmail(string $email): bool {
        return (bool) filter_var($email, FILTER_VALIDATE_EMAIL);
    }

    /**
     * Güvenli Hash üretme
     */
    public static function generateHash(string $password): string {
        return password_hash($password, self::$hashAlgo, [
            'memory_cost' => 65536,
            'time_cost'   => 4,
            'threads'     => 2
        ]);
    }

    /**
     * Hash doğrulama
     */
    public static function verifyHash(string $password, string $hash): bool {
        return password_verify($password, $hash);
    }
}