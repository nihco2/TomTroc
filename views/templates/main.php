<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tom Troc</title>
    <link rel="stylesheet" href="./css/style.css">
    <link rel="icon" type="image/png" href="./images/favicon.png" />
</head>
<body>
    <header>
        <nav>
            <a href="index.php">Accueil</a>
            <?php 
                // Si on est connecté, on affiche le bouton de déconnexion, sinon, on affiche le bouton de connexion : 
                if (isset($_SESSION['user'])) {
                    echo '<a href="index.php?action=signout">Déconnexion</a>';
                } else {
                    echo '<a href="index.php?action=signin">Connexion</a>';
                }
                ?>
        </nav>
        <h1>Tom Troc</h1>
    </header>

    <main>    
        <?= $content /* Ici est affiché le contenu réel de la page. */ ?>
    </main>
    
    <footer>
        <p>Copyright © Tom Troc 2024</p>
    </footer>