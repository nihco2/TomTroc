<section id="account">
    <h2 class="secondaryTitle">Mon compte</h2>
    <div class="accountInfos">    
        <div class="accountCard">
            <img src="img/user-profile-img.png" alt="Icône utilisateur" class="userIcon">
            <a href="index.php?action=editAccount" class="editAccountLink">Modifier</a>
            <hr>
            <p class="secondaryTitle username"><?= htmlspecialchars($user['username']) ?></p>
            <p class="register-date">Membre depuis le <?= $registrationDate ?></p>
            <p class="library-header">Bibliothèque</p>
            <div class="library-wrapper">
                <img src="./img/book-logo.svg" alt="Logo livres" class="library-logo">
                <p class="books-count"><?= count($bookByUser) ?> livres</p>
            </div>
        </div>
        <div class="accountCard myAccount">
            <h6>Vos informations personnelles</h6>
            <form action="index.php?action=editAccount" method="POST">
                <div class="userInfoField">
                    <label for="email">Adresse Email</label>
                    <input type="email" id="email" name="email" value="<?= htmlspecialchars($user['email']) ?>">
                </div>
                <div class="userInfoField">
                        <label for="username">Mot de passe</label>
                        <input type="password" id="password" name="password" value="<?= $password ?>">
                    </div>
                    <div class="userInfoField">
                        <label for="username">Pseudo</label>
                        <input type="text" id="username" name="username" value="<?= htmlspecialchars($user['username']) ?>">
                    </div>
                    <button class="secondary-cta">Enregistrer</button>
                </form>
            </div>
        </div>
    </div>
    <div>
        <table class="booksTable" cellpadding="30">
            <thead>
                <tr>
                    <th>photo</th>
                    <th>titre</th>
                    <th>auteur</th>
                    <th>description</th>
                    <th>disponibilité</th>
                    <th>action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $rowCount = 0;
                foreach ($bookByUser as $book) {
                    $rowCount++;
                ?>
                    <tr>
                        <td><img src="img/<?= htmlspecialchars($book['img']) ?>.png" alt="Couverture du livre" class="book-cover-small" width="100"></td>
                        <td><?= htmlspecialchars($book['title']) ?></td>
                        <td><?= htmlspecialchars($book['author']) ?></td>
                        <!-- limit 50 characters in description -->
                        <td><?= htmlspecialchars(substr($book['description'], 0, 50)) ?>...</td>
                        <td><span class="tag <?= $book['is_available'] ? 'available' : 'unavailable' ?>"><?= $book['is_available'] ? 'Disponible' : 'Indisponible' ?></span></td>
                        <td>
                            <a href="index.php?action=editBook&id=<?= $book['id'] ?>" class="editLink">Editer</a>
                            <a href="index.php?action=bookDetail&id=<?= $book['id'] ?>" class="deleteLink">Supprimer</a>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</section>