<?php

class MessagingManager extends AbstractEntityManager {

    public function __construct() {
        parent::__construct();
    }

    public function sendMessage($conversationId, $senderId, $messageContent) {
        $stmt = $this->db->prepare("INSERT INTO messages (conversation_id, sender_id, content, sent_at, is_read) VALUES (?, ?, ?, NOW(), 0)");
        $stmt->bindValue(1, (int)$conversationId, PDO::PARAM_INT);
        $stmt->bindValue(2, (int)$senderId, PDO::PARAM_INT);
        $stmt->bindValue(3, $messageContent, PDO::PARAM_STR);
        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    public function getMessagesByConversationId($conversationId) {
        $stmt = $this->db->prepare("UPDATE messages SET is_read = 1 WHERE conversation_id = ? AND sender_id != ?"); 
        $stmt->bindValue(1, (int)$conversationId, PDO::PARAM_INT); 
        $stmt->bindValue(2, (int)$_SESSION['user']['id'], PDO::PARAM_INT); $stmt->execute();
        $this->getUnreadMessagesCount(); // Met à jour le nombre de messages non lus dans la session
        $stmt = $this->db->prepare("SELECT * FROM messages WHERE conversation_id = ? ORDER BY sent_at ASC");
        $stmt->bindValue(1, (int)$conversationId, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function getConversationIdByUserId($userId) {
        // éviter les doublons en vérifiant si une conversation existe déjà entre les deux utilisateurs
        $stmt = $this->db->prepare("
        SELECT id FROM conversations 
        WHERE (user_id = ? OR receiver_id = ?) 
        AND (user_id = ? OR receiver_id = ?)");
        $stmt->bindValue(1, (int)$userId, PDO::PARAM_INT);
        $stmt->execute();
    }

    public function addConversation($userId, $receiverId) {
        $stmt = $this->db->prepare("INSERT INTO conversations (user_id, receiver_id, unread_messages_count) VALUES (?, ?, 0)");
        $stmt->bindValue(1, (int)$userId, PDO::PARAM_INT);
        $stmt->bindValue(2, (int)$receiverId, PDO::PARAM_INT);
        // Récupérer l'ID de la conversation nouvellement créée
        if ($stmt->execute()) {
            return $this->db->lastInsertId();
        }
        return false;
    }

    public function getUnreadMessagesCount() { 
        Utils::isUserConnected(); 
        $user = $_SESSION['user']; $userId = $user['id']; 
        $userManager = new UserManager(); 
        $unreadMessagesCount = $userManager->getUnreadMessagesCount($userId);
        $_SESSION['unread_messages_count'] = $unreadMessagesCount;
    }
}