<?php

require_once('models/MessagingManager.php');

class MessagingController {

    public function showMessaging() {
        Utils::isUserConnected();
        $user = $_SESSION['user'];
        $userId = $user['id'];
        $conversations = (new UserManager())->getUsersByConversationUserId($userId);
        $conversationId = isset($_GET['conversation_id']) ? (int)$_GET['conversation_id'] : null;
        $users = (new UserManager())->getAllUsers($userId);
        $messages = (new MessagingManager())->getMessagesByConversationId($conversationId);

        $view = new View('messaging');
        $view->render('messaging', [
            'user' => $user,
            'userId' => $userId,
            'messages' => $messages,
            'conversations' => $conversations,
            'conversationId' => $conversationId,
            'users' => $users,
            'isSelected' => $isSelected ?? false
        ]);
    }

    public function sendMessage() {
        Utils::isUserConnected();
        $user = $_SESSION['user'];
        $userId = $user['id'];
        $senderId = $userId; // L'expéditeur est l'utilisateur connecté
        $conversationId = isset($_POST['conversation_id']) ? (int)$_POST['conversation_id'] : null;

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Récupérer le message du formulaire
            $messageContent = Utils::sanitizeInput($_POST['message']);

            // Validation basique
            if (empty($messageContent)) {
                throw new Exception("Le message ne peut pas être vide.");
            }

            // Enregistrer le message dans la base de données
            $messagingManager = new MessagingManager();
        
            $messagingManager->sendMessage($conversationId, $senderId, $messageContent);
            // Rediriger vers la page de messagerie après l'envoi
            header('Location: index.php?action=messaging&conversation_id=' . $conversationId);
            exit();
        } else {
            throw new Exception("Méthode de requête invalide.");
        }
    }

    public function addConversation() {
        Utils::isUserConnected();
        $user = $_SESSION['user'];
        $userId = $user['id'];
        $receiverId = isset($_POST['receiver_id']) ? (int)$_POST['receiver_id'] : null;

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Validation basique
            if (empty($receiverId)) {
                throw new Exception("Veuillez sélectionner un utilisateur pour démarrer une conversation.");
            }

            // Créer une nouvelle conversation dans la base de données
            $messagingManager = new MessagingManager();
            $conversationId = $messagingManager->addConversation($userId, $receiverId);

            // Rediriger vers la page de messagerie avec la nouvelle conversation sélectionnée
            header('Location: index.php?action=messaging&conversation_id=' . $conversationId);
            exit();
        } else {
            throw new Exception("Méthode de requête invalide.");
        }
    }
}