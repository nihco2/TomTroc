<section id="profile">
    <div class="accountInfos">    
        <div class="accountCard">
            <img src="img/user-profile-img.png" alt="Icône utilisateur" class="userIcon">
            <a href="index.php?action=profile" class="editAccountLink">Modifier</a>
            <hr>
            <p class="secondaryTitle username"><?= htmlspecialchars($user['username']) ?></p>
            <p class="register-date">Membre depuis le <?= $registrationDate ?></p>
            <p class="library-header">Bibliothèque</p>
            <div class="library-wrapper">
                <img src="./img/book-logo.svg" alt="Logo livres" class="library-logo">
                <p class="books-count"><?= count($bookByUser) ?> livres</p>
            </div>
            <p><a class="secondary-cta" href="index.php?action=messaging">Ecrire un message</a></p>
        </div>
        <div class="accountCard rightCard">
            <table class="booksTable">
            <thead>
                <tr>
                    <th>photo</th>
                    <th>titre</th>
                    <th>auteur</th>
                    <th>description</th>
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
                    </tr>
                <?php } ?>
            </tbody>
        </table>
            </div>
        </div>
    </div>
</section>