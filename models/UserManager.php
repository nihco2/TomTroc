<?php
require_once('AbstractEntityManager.php');

class UserManager extends AbstractEntityManager {

    public function __construct() {
        parent::__construct();
    }

    public function createUser($username, $email, $password) {
        $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
        $stmt = $this->db->prepare("INSERT INTO users (username, email, password, created_at) VALUES (?, ?, ?, NOW())");
        // return user with id
        if ($stmt->execute([$username, $email, $hashedPassword])) {
            $userId = $this->db->lastInsertId();
            return $this->getUserById($userId);
        }
        return false;
    }

    public function getUserById($id) {
        $stmt = $this->db->prepare("SELECT * FROM users WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch();
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
        //select conversations by user id and receiver id, then get the user id of the other user in the conversation
        // get last message from messages table and order by sent_at desc and content
         $stmt = $this->db->prepare("
            SELECT c.id, u.username, m.content, m.sent_at
            FROM conversations c
            JOIN users u ON (c.user_id = u.id OR c.receiver_id = u.id) AND u.id != ?
            LEFT JOIN messages m ON m.conversation_id = c.id
            WHERE (c.user_id = ? OR c.receiver_id = ?)
            GROUP BY c.id, u.username
            ORDER BY m.sent_at DESC
        ");
        $stmt->bindValue(1, (int)$userId, PDO::PARAM_INT);
        $stmt->bindValue(2, (int)$userId, PDO::PARAM_INT);
        $stmt->bindValue(3, (int)$userId, PDO::PARAM_INT);
        $stmt->execute();
        // return conversation id
        return $stmt->fetchAll();
    }

    public function getAllUsers($excludeUserId) {
        $stmt = $this->db->prepare("SELECT * FROM users WHERE id != ?");
        $stmt->bindValue(1, (int)$excludeUserId, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll();
    }
}