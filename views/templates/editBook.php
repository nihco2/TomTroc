<section id="editBook">
    <h2 class="secondaryTitle">Modifier les informations</h2>
    <div class="editBookContainer">
        <div class="imgBook">
            <p class="bookDesc">Photo</p>
            <img src="img/book-cover.jpg" alt="Couverture du livre" class="bookDetailImage">
            <a class="editPhoto">Modifier la photo</a>
        </div>
        <div class="editForm">
            <form action="index.php?action=updateBook"  method="post" class="formEditBook">
                <input type="hidden" name="id" value="<?= $book['id'] ?>">
                <div class="formGroup">
                    <label for="title">Titre</label>
                    <input type="text" id="title" name="title" value="<?= $book['title'] ?>">
                </div>
                <div class="formGroup">
                    <label for="author">Auteur</label>
                    <input type="text" id="author" name="author" value="<?= $book['author'] ?>">
                </div>
                <div class="formGroup">
                    <label for="description">Commentaire</label>
                    <textarea id="description" name="description"><?= $book['description'] ?></textarea>
                </div>
                <div class="formGroup">
                    <label for="condition">Disponibilité</label>
                    <select id="condition" name="condition">
                        <option value="1" <?= $book['is_available'] ? 'selected' : '' ?>>Disponible</option>
                        <option value="0" <?= !$book['is_available'] ? 'selected' : '' ?>>Indisponible</option>
                    </select>
                <button type="submit" class="primaryButton">Valider</button>
            </form>
        </div>
    </div>
</section>