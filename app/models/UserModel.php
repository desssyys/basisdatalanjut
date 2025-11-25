<?php
require_once __DIR__ . '/../db.php';

class UserModel {
    private $conn;
    private $table = 'users';

    public function __construct() {
        $db = db::getInstance();
        $this->conn = $db->getConnection();
    }

    public function login($username, $password) {
        if ($username === 'admin' && $password === 'admin123') {
            return [
                'id' => 1,
                'username' => 'admin',
                'role' => 'admin'
            ];
        }
        return false;
    }
}
?>
