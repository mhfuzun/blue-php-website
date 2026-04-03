<?php
// SessionManager.php

use PSpell\Config;

class SessionManager extends Database {
    public function __construct() {
        parent::__construct(); // db construct

        if (session_status() === PHP_SESSION_NONE) {
            session_start([
                'cookie_httponly' => true,
                'cookie_secure'   => isset($_SERVER['HTTPS']),
                'cookie_samesite' => 'Lax'
            ]);
        }
    }

    public function tryRememberMe(): bool {
        if (!CookieManager::hasRememberMe()) return false;

        $token = CookieManager::getRememberMe();
        // TODO: https://gemini.google.com/app/352e1be12c47e76d
        /**
         * burada geçen şekilde join ile bağlantılı erişim altyapısı ekle.
         */
        $dbresponse = parent::checkRememberMe($token);
        $dbresponse = parent::getUserSessionInfoByID($dbresponse['id']);

        if (empty($dbresponse)) return false;

        $this->createSession($dbresponse);
        return true;
    }

    public static function isUserLoggedIn(): bool {
        return isset($_SESSION['is_logged_in']) && ($_SESSION['is_logged_in'] === true);
    }

    public static function UserId(): int {
        return Database::getUserId($_SESSION['user']);
    }

    public static function getUserName(): string {
        return Database::getUserUserName($_SESSION['user']);
    }

    public function set(string $key, $value): void {
        $_SESSION[$key] = $value;
    }

    public function get(string $key, $default = null) {
        return $_SESSION[$key] ?? $default;
    }

    public function has(string $key): bool {
        return isset($_SESSION[$key]);
    }

    public function login(string $identity, string $password, bool $rememberMe = false): bool {
        $dbresponse = parent::checkLogin($identity, $password);
        if (empty($dbresponse)) return false;

        if ($rememberMe) $this->createRememberMe(Database::getUserId($dbresponse));
        $this->createSession($dbresponse);
        return true;
    }

    private function createSession(array $userData): void {
        $_SESSION = [];
        session_regenerate_id(true); // Güvenlik için ID yenileme
        $this->set('is_logged_in', true);
        $this->set('user', $userData);
    }

    public function logout(): void {
        if (!SessionManager::isUserLoggedIn()) return;

        parent::deleteRememberMeEntry(SessionManager::UserId());

        $_SESSION = [];
        if (ini_get("session.use_cookies")) {
            $params = session_get_cookie_params();
            setcookie(session_name(), '', time() - 42000, 
                $params["path"], $params["domain"], $params["secure"], $params["httponly"]
            );
        }
        $this->deleteRememberMe();
        session_destroy();
    }

    private function createRememberMe(int $userid): bool {
        $token = common::generateToken(Config::get('remember_me_token_length'));
        parent::createRememberMeEntry($userid, $token);
        CookieManager::setRememberMe($token);
        return true;
    }

    private function deleteRememberMe(): bool {
        CookieManager::deleteRememberMe();
        return true;
    }
}
?>
