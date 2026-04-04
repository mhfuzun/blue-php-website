<?php
// SessionManager.php

class SessionManager {
    public static function set(string $key, $value): void {
        $_SESSION[$key] = $value;
    }

    public static function get(string $key, $default = null) {
        return $_SESSION[$key] ?? $default;
    }

    public static function has(string $key): bool {
        return isset($_SESSION[$key]);
    }

    public static function isUserLoggedIn(): bool {
        return isset($_SESSION['is_logged_in']) && ($_SESSION['is_logged_in'] === true);
    }

    public static function UserId(): int {
        return Database::getUserId($_SESSION['user']);
    }

    public static function UserName(): string {
        return Database::getUserUserName($_SESSION['user']);
    }

    public static function getCSRFToken(): string {
        $token = SessionManager::get('csrf_token', false);
        if ($token === false) {
            $token = common::generateToken();
            SessionManager::set('csrf_token', $token);
        }

        return $token;
    }

    public static function resetCSRFToken(): void {
        $token = common::generateToken();
        SessionManager::set('csrf_token', $token);
    }

    public static function createSession(array $userData): void {
        $_SESSION = [];
        session_regenerate_id(true); // Güvenlik için ID yenileme
        SessionManager::set('is_logged_in', true);
        SessionManager::set('user', $userData);
    }
}
?>
