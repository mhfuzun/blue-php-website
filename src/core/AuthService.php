<?php

class AuthService extends Service {
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

        $dbresponse = $this->database->getUserByRememberMeToken($token);

        if (empty($dbresponse)) {
            // TODO: bir silme isteğine rağmen sürekli rememberme cookie yollarak 
            // token brute force denenebilir. Redis bağlantısı burada yapılabilir.
            CookieManager::deleteRememberMe();
            return false;
        }

        common::_log("user is remembered, userid: " . Database::getUserId($dbresponse));

        SessionManager::createSession($dbresponse);
        return true;
    }

    public function login(string $identity, string $password, bool $rememberMe = false): bool {
        $dbresponse = $this->database->checkLogin($identity, $password);
        if (empty($dbresponse)) return false;

        if ($rememberMe) {
            if (!$this->createRememberMe(Database::getUserId($dbresponse)))
                error_log("createRememberMe error.");
        }

        SessionManager::createSession($dbresponse);
        return true;
    }

    public function logout(): void {
        if (!SessionManager::isUserLoggedIn()) return;

        $this->database->deleteRememberMeEntry(SessionManager::UserId());

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
        $this->database->createRememberMeEntry($userid, $token);
        CookieManager::setRememberMe($token);
        common::_log("user token: " . $token);
        return true;
    }

    private function deleteRememberMe(): bool {
        CookieManager::deleteRememberMe();
        return true;
    }

    public function createUser(string $nick, string $username, string $email, string $password): array {
        if (!UserManager::checkEmail($email)) {
            return [false, "Invalid E-Mail"];
        } else if (!UserManager::checkNickName($nick)) {
            return [false, "Invalid Nickname"];
        } else if (!UserManager::checkNameSurname($username)) {
            return [false, "Invalid Username"];
        } else if (!UserManager::checkPassword($password)) {
            return [false, "Invalid Password"];
        } else {
            $passwordhash = UserManager::generateHash($password);
            $dbresp=$this->database->createUser($nick, $username, $email, $passwordhash);
            return [$dbresp['success'], $dbresp['error']];
        }
    }
}

?>
