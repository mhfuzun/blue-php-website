<?php
// src/CookieManager.php

class CookieManager
{
    private static string $defaultPath = '/';
    // private static bool $secure = true;      // sadece HTTPS'de çalışır (production’da şart)
    private static bool $httpOnly = true; // JS erişimini kapatır (XSS koruması)
    private static string $sameSite = 'Strict'; // Strict | Lax | None (CSRF riskini azaltır)

    /**
     * Genel cookie oluşturucu
     */
    public static function set(
        string $name,
        string $value,
        int $expireSeconds = 3600,
        ?string $path = null
    ): bool {
        return setcookie(
            $name,
            $value,
            [
                'expires' => time() + $expireSeconds,
                'path' => $path ?? self::$defaultPath,
                'secure' => env('COOKIE_SECURE', true),
                'httponly' => self::$httpOnly,
                'samesite' => self::$sameSite
            ]
        );
    }

    /**
     * Cookie al
     */
    public static function get(string $name, $default = null)
    {
        return $_COOKIE[$name] ?? $default;
    }

    /**
     * Cookie sil
     */
    public static function delete(string $name): bool
    {
        return setcookie(
            $name,
            '',
            [
                'expires' => time() - 3600,
                'path' => self::$defaultPath
            ]
        );
    }

    /**
     * Cookie var mı?
     */
    public static function has(string $name): bool
    {
        return isset($_COOKIE[$name]);
    }

    // =========================
    // JWT Yönetimi
    // =========================

    public static function setJWT(string $jwt, int $expireSeconds = 3600): bool
    {
        return self::set('jwt', $jwt, $expireSeconds);
    }

    public static function getJWT(): ?string
    {
        return self::get('jwt');
    }

    public static function deleteJWT(): bool
    {
        return self::delete('jwt');
    }

    public static function hasJWT(): bool
    {
        return self::has('jwt');
    }

    // =========================
    // Remember Me Yönetimi
    // =========================

    public static function setRememberMe(string $token): bool
    {
        // 30 gün
        return self::set('remember_me', $token, 60 * 60 * 24 * 30);
    }

    public static function getRememberMe(): ?string
    {
        return self::get('remember_me');
    }

    public static function deleteRememberMe(): bool
    {
        return self::delete('remember_me');
    }

    public static function hasRememberMe(): bool
    {
        return self::has('remember_me');
    }

    // =========================
    // JSON Cookie (opsiyonel)
    // =========================

    public static function setJson(string $name, array $data, int $expireSeconds = 3600): bool
    {
        return self::set($name, json_encode($data), $expireSeconds);
    }

    public static function getJson(string $name): ?array
    {
        $data = self::get($name);
        return $data ? json_decode($data, true) : null;
    }
}
?>
