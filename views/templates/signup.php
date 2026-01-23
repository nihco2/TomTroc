<form action="index.php?action=create" method="POST">
<h1>Inscription</h1>
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
        <button type="submit">S'inscrire</button>
    </div>
</form>
<p>Déjà un compte ? <a href="index.php?action=signin">Connectez-vous</a>.</p>