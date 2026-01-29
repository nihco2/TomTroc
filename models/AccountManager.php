<?php

class AccountManager extends AbstractEntityManager {
    public function __construct() {
        parent::__construct();
    }

    public function getUserById($userId) {
        $stmt = $this->db->prepare("SELECT * FROM users WHERE id = ?");
        $stmt->bindValue(1, (int)$userId, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch();
    }

    public function getBooksByUserId($userId) {
        $stmt = $this->db->prepare("SELECT * FROM books WHERE id = ?");
        $stmt->bindValue(1, (int)$userId, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function updateUser($userId, $email, $password, $username) {
        if (!empty($password)) {
            $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
            $stmt = $this->db->prepare("UPDATE users SET email = ?, password = ?, username = ? WHERE id = ?");
            $stmt->bindValue(1, $email, PDO::PARAM_STR);
            $stmt->bindValue(2, $hashedPassword, PDO::PARAM_STR);
            $stmt->bindValue(3, $username, PDO::PARAM_STR);
            $stmt->bindValue(4, (int)$userId, PDO::PARAM_INT);
        } else {
            $stmt = $this->db->prepare("UPDATE users SET email = ?, username = ? WHERE id = ?");
            $stmt->bindValue(1, $email, PDO::PARAM_STR);
            $stmt->bindValue(2, $username, PDO::PARAM_STR);
            $stmt->bindValue(3, (int)$userId, PDO::PARAM_INT);
        }
        $stmt->execute();
    }
}