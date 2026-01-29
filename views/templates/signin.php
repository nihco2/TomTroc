<section class="login">
    <div>
        <h1 class="mainTitle">Connexion</h1>
        <form action="index.php?action=login" method="post" class="connexionForm">
            <div>
                <label for="email">Adresse email</label>
                <input type="email" id="email" name="email" required>
            </div>     
            <div>
                <label for="password">Mot de passe</label>
                <input type="password" id="password" name="password" required>
            </div>
            <div>
                <button type="submit" class="primaryButton">Se connecter</button>
            </div>
        </form>
        <p>Pas de compte ? <a href="index.php?action=signup">Inscrivez-vous</a>.</p>
    </div>
    <img src="img/connexion.png" alt="Illustration de connexion">
</section>