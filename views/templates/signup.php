
<section class="login">
    <div>
        <h1 class="mainTitle">Inscription</h1>
        <form action="index.php?action=create" method="POST" class="connexionForm">
            <div>
                <label for="username">Pseudo</label>
                <input type="text" id="username" name="username" required>
            </div>
            <div>
                <label for="email">Adresse email</label>
                <input type="email" id="email" name="email" required>
            </div>
            <div>
                <label for="password">Mot de passe</label>
                <input type="password" id="password" name="password" required>
            </div>
            <div>
                <button type="submit" class="button">S'inscrire</button>
            </div>
        </form>
        <p>Déjà un compte ? <a href="index.php?action=signin">Connectez-vous</a>.</p>
    </div>
    <img src="img/connexion.png" alt="Illustration de connexion">
</section>