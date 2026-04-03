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
        $sql = "INSERT INTO remember_me (userid, token, created_at) VALUES (:userid, :token, NOW())";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([
            'userid' => $userid,
            'token' => $token
        ]);
        return true;
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
        return $dbrow['userName'];
    }

    public static function getUserUserSurname($dbrow): string {
        return $dbrow['userSurname'];
    }
}

?>
