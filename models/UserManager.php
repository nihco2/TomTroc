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
        //select conversations by user id and receiver id, then get the user id of the other user in the conversation
        $stmt = $this->db->prepare("
        SELECT conversations.id, users.username FROM conversations
        JOIN users ON (users.id = conversations.user_id OR users.id = conversations.receiver_id)
        WHERE (conversations.user_id = ? OR conversations.receiver_id = ?)
        AND users.id != ?");
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