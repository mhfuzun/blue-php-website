<?php
// src/Database.php

class Database {
    private static $instance = null;
    private $pdo = null;

    public function __construct() {
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

    /** checkLogin:
     *  - check user existance
     *  - check password
     *  - return: [user existance, user info in an array]
     */
    public function checkLogin(string $identifier, string $password): array {
        // Sorguyu güvenli bir şekilde oluşturuyoruz
        $sql = "SELECT id, nick, email, passwordhash, status, userName, userSurname 
                FROM users 
                WHERE nick = :identifier or email = :identifier
                LIMIT 1";

        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(['identifier' => $identifier]);
        $userRecord = $stmt->fetch(PDO::FETCH_ASSOC);

        // 1. ADIM: Kullanıcı Kontrolü
        if ($userRecord) {
            // 2. ADIM: Şifre Doğrulama (verifyHash kullanımı)
            $isPasswordCorrect = UserManager::verifyHash($password, $userRecord['passwordhash']);

            if ($isPasswordCorrect) {
                // 3. ADIM: Ek kontroller (Hesap aktif mi?)
                if ($userRecord['status'] === 'active') {
                    return $userRecord;
                } else {
                    // echo "Hesabınız askıya alınmış veya pasif durumda.";
                }
            } else {
                // echo "Hatalı şifre girdiniz.";
            }
        } else {
            // echo "Kullanıcı bulunamadı.";
        }
        return [];
    }

    public function getUserSessionInfoByID(int $userid): array {
        // Sorguyu güvenli bir şekilde oluşturuyoruz
        $sql = "SELECT id, nick, email, passwordhash, status, userName, userSurname 
                FROM users 
                WHERE id = :userid
                LIMIT 1";

        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(['userid' => $userid]);
        $userRecord = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($userRecord) {
            return $userRecord;
        } else {
            return [];
        }
    }

    public function createRememberMeEntry(int $userid, string $token): bool {
        // TODO: token aynı olmamalı handle durumu çok zayıf geldi.
        $sql = "INSERT INTO remember_me (userid, token, created_at) 
                VALUES (:userid, :token, NOW())
                ON CONFLICT (token) 
                DO UPDATE SET 
                    userid = EXCLUDED.userid, 
                    created_at = EXCLUDED.created_at";
        
        try {
            $stmt = $this->pdo->prepare($sql);
            return $stmt->execute([
                'userid' => $userid,
                'token' => $token
            ]);
        } catch (\PDOException $e) {
            // Loglama yapılabilir
            common::_log("DATABASE: Remember Me Hatası: " . $e->getMessage(), true);
            return false;
        }
    }

    public function deleteRememberMeEntry(string $userid) {
        $sql = "DELETE FROM remember_me WHERE userid = :userid";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(['userid' => $userid]);
        return true;
    }

    public function checkRememberMe(string $token): array {
        $sql = "SELECT userid, created_at FROM remember_me WHERE token = :token";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(['token' => $token]);
        $userRecord = $stmt->fetch(PDO::FETCH_ASSOC);
        if (!$userRecord) {
            return [];
        }
        return [
            'id' => $userRecord['userid'],
            'created_at' => $userRecord['created_at']
        ];
    }

    public function getUserByRememberMeToken(string $token): array {
        // JOIN kullanarak iki tabloyu ilişkilendiriyoruz
        $sql = "SELECT 
                    u.id, 
                    u.nick, 
                    u.email, 
                    u.passwordhash, 
                    u.status, 
                    u.userName, 
                    u.userSurname,
                    rm.created_at AS token_created_at
                FROM remember_me rm
                INNER JOIN users u ON rm.userid = u.id
                WHERE rm.token = :token
                LIMIT 1";

        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(['token' => $token]);
        
        // FETCH_ASSOC ile sonucu alıyoruz
        $userRecord = $stmt->fetch(PDO::FETCH_ASSOC);

        // Eğer kayıt bulunursa diziyi dön, bulunmazsa boş dizi dön
        return $userRecord ?: [];
    }

    public function createUser(string $nick, string $username, string $email, string $passwordhash): array {
        $sql = "INSERT INTO users (nick, email, passwordhash, status, userName, userSurname) 
                VALUES (:nick, :email, :passwordhash, 'active', :userName, :userSurname)
                RETURNING id";

        $stmt = $this->pdo->prepare($sql);

        try {
            $stmt->execute([
                'nick' => $nick,
                'email' => $email,
                'passwordhash' => $passwordhash,
                'userName' => $username,
                'userSurname' => ""
            ]);

            return ['success' => true];

        } catch (\PDOException $e) {

            // PostgreSQL unique violation code: 23505
            if ($e->getCode() === '23505') {
                return [
                    'success' => false,
                    'error' => 'This Nickname or Email already exists.',
                ];
            }

            // diğer hatalar
            common::_log("DATABASE: createUser Error: " . $e->getMessage(), true);

            return [
                'success' => false,
                'error' => 'Internal Error',
            ];
        }
    }

    public static function getUserId($dbrow): int {
        return $dbrow['id'];
    }

    public static function getUserNick($dbrow): string {
        return $dbrow['nick'];
    }

    public static function getUserEmail($dbrow): string {
        return $dbrow['email'];
    }

    public static function getUserStatus($dbrow): string {
        return $dbrow['status'];
    }

    public static function getUserUserName($dbrow): string {
        return $dbrow['username'];
    }

    public static function getUserUserSurname($dbrow): string {
        return $dbrow['usersurname'];
    }
}

?>
