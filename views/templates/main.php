<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tom Troc</title>
    <link rel="stylesheet" href="./css/style.css">
    <link rel="icon" type="image/png" href="img/favicon.png" />
    <script defer>
        function showPopup() {
            const popup = document.querySelector('dialog');
            popup.showModal();
            popup.style = "display: flex;";
        }

        function closePopup() {
            const popup = document.querySelector('dialog');
            popup.close();
            popup.style = "display: none;";
        }

    </script>
</head>
<body>
    <header class="header">
        <img src="img/logo.svg" alt="Logo Tom Troc" class="logo">
        <nav class="nav">
            <div>
                <a href="index.php">Accueil</a>
                <a href="index.php?action=books">Nos livres à l'échange</a>
            </div>
            <div>
                <span class="divider">|</span>
                <a href="index.php?action=messaging">
                    <img src="img/message-icon.svg" alt="Messagerie">
                    Messagerie
                    <!-- Si l'utilisateur a des messages non lus, on affiche un badge avec le nombre de messages non lus -->
                    <?php if (isset($_SESSION['user']) && isset($_SESSION['unread_messages_count']) && $_SESSION['unread_messages_count'] > 0): ?>
                        <span class="unreadBadge"><?= $_SESSION['unread_messages_count'] ?></span>
                    <?php endif; ?>
                </a>
                <a href="index.php?action=account">
                    <img src="img/account-icon.svg" alt="Mon compte">
                    Mon compte
                </a>
                <?php 
                // Si on est connecté, on affiche le bouton de déconnexion, sinon, on affiche le bouton de connexion : 
                if (isset($_SESSION['user'])) {
                    echo '<a href="index.php?action=signout">Déconnexion</a>';
                } else {
                    echo '<a href="index.php?action=signin">Connexion</a>';
                }
                ?>
            </div>
        </nav>
    </header>

    <main class="mainContainer">    
        <?= $content /* Ici est affiché le contenu réel de la page. */ ?>
    </main>
    
    <footer class="footer">
        <p>Politique de confidentialité</p>
        <p>Mentions légales</p>
        <p>Tom Troc©</p>
        <img src="img/logo-footer.svg" alt="Logo Tom Troc" class="footerLogo">
    </footer>