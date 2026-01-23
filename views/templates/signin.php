<h1>Inscription</h1>
<form action="index.php?action=login" method="post">
    <div>
        <label for="email">Adresse email</label>
        <input type="email" id="email" name="email" required>
    </div>     
    <div>
        <label for="password">Mot de passe</label>
        <input type="password" id="password" name="password" required>
    </div>
    <div>
        <button type="submit">Se connecter</button>
    </div>
</form>
<p>Pas de compte ?<a href="index.php?action=signup">Inscrivez-vous</a>.</p>