<section class="homepage">
    <div class="infoSection">
        <h1 class="mainTitle">Rejoignez nos lecteurs passionnés </h1>
        <p>Donnez une nouvelle vie à vos livres en les échangeant avec d'autres amoureux de la lecture. Nous croyons en la magie du partage de connaissances et d'histoires à travers les livres. </p>
        <a href="index.php?action=books">Découvrir</a>
    </div>
    <div class="imageSection">
        <em>Hamza</em>
    </div>
</section>
<section class="books-section">
    <h3 class="secondaryTitle">Les derniers livres ajoutés</h3>
    <div class="booksContainer">
        <?php foreach ($latestBooks as $book): ?>
            <div class="bookCard">
                <img src="img/<?= htmlspecialchars($book['img']) ?>.png" alt="<?= htmlspecialchars($book['title']) ?>" class="bookImage">
                <h3 class="bookTitle"><?= htmlspecialchars($book['title']) ?></h3>
                <p class="bookAuthor"><?= htmlspecialchars($book['author']) ?></p>
                <p class="bookDescription">vendu par: <?= htmlspecialchars($book['username']) ?></p>
            </div>
        <?php endforeach; ?>
</section>
<section>
    <div class="benefitSection">
        <h3 class="secondaryTitle">Comment ça marche ?</h3>
        <p>Échanger des livres avec TomTroc c’est simple et amusant ! Suivez ces étapes pour commencer :</p>
        <ul class="benefitsList">
            <li>Inscrivez-vous gratuitement sur notre plateforme.</li>
            <li>Ajoutez les livres que vous souhaitez échanger à votre profil.</li>
            <li>Parcourez les livres disponibles chez d'autres membres.</li>
            <li>Proposez un échange et discutez avec d'autres passionnés de lecture.</li>
        </ul>
        <p><a class="secondary-cta" href="index.php?action=books">Voir tous les livres</a></p>
    </div>
    <div class="imageSection">
    </div>
    <h3 class="secondaryTitle valueTitle">Nos valeurs</h3>
    <p class="valueDescription">Chez Tom Troc, nous mettons l'accent sur le partage, la découverte et la communauté. Nos valeurs sont ancrées dans notre passion pour les livres et notre désir de créer des liens entre les lecteurs. Nous croyons en la puissance des histoires pour rassembler les gens et inspirer des conversations enrichissantes.

Notre association a été fondée avec une conviction profonde : chaque livre mérite d'être lu et partagé. 

Nous sommes passionnés par la création d'une plateforme conviviale qui permet aux lecteurs de se connecter, de partager leurs découvertes littéraires et d'échanger des livres qui attendent patiemment sur les étagères.
</p>
<div class="our-values">
    <p>L'équipe Tom Troc</p>
    <img src="img/logo-our-values.svg" alt="Illustration de valeurs">
</div>
</section>