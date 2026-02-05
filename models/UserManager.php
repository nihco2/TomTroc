<?php
require_once('AbstractEntityManager.php');

class UserManager extends AbstractEntityManager {

    public function __construct() {
        parent::__construct();
    }

    public function createUser($username, $email, $password) {
        $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
        $stmt = $this->db->prepare("INSERT INTO users (username, email, password, created_at) VALUES (?, ?, ?, NOW())");
        return $stmt->execute([$username, $email, $hashedPassword]);
    }

    public function getUserByEmail($email) {
        $stmt = $this->db->prepare("SELECT * FROM users WHERE email = ?");
        $stmt->execute([$email]);
        return $stmt->fetch();
    }

    public function verifyUser($email, $password) {
        $user = $this->getUserByEmail($email);
        if ($user && password_verify($password, $user['password'])) {
            return $user;
        }
        return false;
    }

    public function getUsersByConversationUserId($userId) {
        // avoid duplicates by checking if a conversation already exists between the two users
        $stmt = $this->db->prepare("SELECT DISTINCT u.* FROM users u JOIN conversations c ON (u.id = c.user_id OR u.id = c.receiver_id) WHERE (c.user_id = ? OR c.receiver_id = ?) AND u.id != ?");
        $stmt->bindValue(1, (int)$userId, PDO::PARAM_INT);
        $stmt->bindValue(2, (int)$userId, PDO::PARAM_INT);
        $stmt->bindValue(3, (int)$userId, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function getAllUsers($excludeUserId) {
        $stmt = $this->db->prepare("SELECT * FROM users WHERE id != ?");
        $stmt->bindValue(1, (int)$excludeUserId, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll();
    }
}