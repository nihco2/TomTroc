<section>
    <div class="books-header">
        <h3 class="secondaryTitle">Nos livres à l’échange</h3>
        <form action="index.php?action=search" method="POST">
            <img src="img/search-icon.svg" alt="Search Icon" class="searchIcon">
            <input type="text" placeholder="Rechercher un livre..." name="search" class="searchInput">
        </form>
    </div>
    <div class="booksContainer">
        <?php foreach ($allBooks as $book): ?>
            <div class="bookCard" onClick="location.href='index.php?action=bookDetail&id=<?= htmlspecialchars($book['id']) ?>'">
                <img src="img/<?= htmlspecialchars($book['img']) ?>.png" alt="<?= htmlspecialchars($book['title']) ?>" class="bookImage">
                <h3 class="bookTitle"><?= htmlspecialchars($book['title']) ?></h3>
                <p class="bookAuthor"><?= htmlspecialchars($book['author']) ?></p>
                <p class="bookDescription">vendu par: <?= htmlspecialchars($book['username']) ?></p>
            </div>
        <?php endforeach; ?>
    </div>
</section>