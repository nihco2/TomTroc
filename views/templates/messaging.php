<section id="messaging">
    <div class="leftBlock">
        <h4 class="secondaryTitle">
            Messagerie
            <a onClick="showPopup()" class="primaryButton">
                +
            </a>
        </h4>
        <div class="conversationsList">
            <?php
            foreach ($conversations as $conversation) {
                echo '<div class="conversationItem">';
                echo '<a href="index.php?action=messaging&conversation_id=' . $conversation['id']. '">';
                echo '<img src="img/user-profile-img.png" alt="Image de profil de ' . htmlspecialchars($conversation['username']) . '">';
                echo htmlspecialchars($conversation['username']);
                echo '</a>';
                echo '</div>';
            }
            ?>
        </div>
    </div>
    <div class="rightBlock">
        <div class="user">
            <img src="img/user-profile-img.png" alt="Image de profil du propriétaire du livre">
            <p><?= htmlspecialchars($user['username']) ?></p>
        </div>
        <div class="messagesContainer">
            <?php
            foreach ($messages as $message) {
                if ($message['sender_id'] === $_SESSION['user']['id']) {
                    echo '<p class="messageDate">' . date('d/m/Y H:i', strtotime($message['sent_at'])) . '</p>';
                    // Message envoyé par l'utilisateur connecté
                    echo '<div class="messageBubble sentMessage">';
                    echo  htmlspecialchars($message['content']);
                    echo '</div>';
                    // date d'envoi du message au format jj/mm/aaaa hh:mm
                    
                    
                } else {
                    echo '<p class="messageDate right">' . date('d/m/Y H:i', strtotime($message['sent_at'])) . '</p>';
                    // Message reçu par l'utilisateur connecté
                    echo '<div class="messageBubble receivedMessage">';
                    echo htmlspecialchars($message['content']);
                    echo '</div>';
                    
                   
                }
            }
            ?>
        </div>
        <form action="index.php?action=sendMessage" method="POST" class="messageForm">
            <div class="formGroup">
                <input type="hidden" name="conversation_id" value="<?= isset($conversationId) ? (int)$conversationId : '' ?>">
                <input type="text" id="message" name="message" placeholder="Tapez votre message ici">
            </div>
            <button type="submit" class="primaryButton">Envoyer</button>
        </form>
    </div>
</section>
<dialog class="popup">
    <div class="popupOverlay" onClick="closePopup()"></div>
    <form method="POST" class="popupContent" action="index.php?action=addConversation">
        <h3>Nouvelle conversation</h3>
        <div class="formGroup">
            <label for="receiver_id">Choisissez un utilisateur :</label>
            <select id="receiver_id" name="receiver_id">
                <?php
                foreach ($users as $user) {
                    if ($user['id'] !== $_SESSION['user']['id']) {
                        echo '<option value="' . (int)$user['id'] . '">' . htmlspecialchars($user['username']) . '</option>';
                    }
                }
                ?>
            </select>
        </div>
        <button type="submit" class="primaryButton">Démarrer la conversation</button>
    </form>