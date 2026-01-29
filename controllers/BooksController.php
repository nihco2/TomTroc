<?php

class BooksController {
    public function showBooks() {
        Utils::isUserConnected();
        // On crée la vue pour la liste des livres.
        $view = new View("Liste des livres");
        // On récupère tous les livres.
        $booksManager = new BooksManager();
        $books = $booksManager->getAllBooks();
        // On rend la vue avec les livres.
        $view->render('books', ['allBooks' => $books]);
    }

    public  function searchBooks() {
        Utils::isUserConnected();
        // On crée la vue pour la liste des livres.
        $view = new View("Résultats de la recherche");
        // On récupère le terme de recherche.
        $searchTerm = isset($_POST['search']) ? trim($_POST['search']) : '';
        // On récupère les livres correspondant au terme de recherche.
        $booksManager = new BooksManager();
        $books = $booksManager->searchBooksByTitleAndAuthor($searchTerm);
        // On rend la vue avec les livres.
        $view->render('books', ['allBooks' => $books]);
    }

    public function showBookDetail() {
        Utils::isUserConnected();
        // On crée la vue pour le détail du livre.
        $view = new View("Détail du livre");
        // Pour l'instant, on n'affiche pas de détails spécifiques.
        // On rend la vue.
        $booksManager = new BooksManager();
        $bookId = isset($_GET['id']) ? (int)$_GET['id'] : 1; // Récupérer l'ID du livre depuis l'URL, par défaut 1
        $book = $booksManager->getBookById($bookId); // Exemple avec l'ID 1
        $view->render('bookDetail', ['book' => $book]);
    }

    public function editBook() {
        Utils::isUserConnected();
        // On crée la vue pour l'édition du livre.
        $view = new View("Édition du livre");
        // Pour l'instant, on n'affiche pas de formulaire d'édition spécifique.
        // On rend la vue.
        $booksManager = new BooksManager();
        $bookId = isset($_GET['id']) ? (int)$_GET['id'] : 1; // Récupérer l'ID du livre depuis l'URL, par défaut 1
        $book = $booksManager->getBookById($bookId); // Exemple avec l'ID 1
        $view->render('editBook', ['book' => $book]);
    }

    public function updateBook(){
        Utils::isUserConnected();
        // On traite la mise à jour du livre.
        $booksManager = new BooksManager();
        // Récupérer les données du formulaire
        $id = isset($_POST['id']) ? (int)$_POST['id'] : 0;
        $title = isset($_POST['title']) ? trim($_POST['title']) : '';
        $author = isset($_POST['author']) ? trim($_POST['author']) : '';
        $description = isset($_POST['description']) ? trim($_POST['description']) : '';
        $condition = isset($_POST['condition']) ? ($_POST['condition'] === '1' ? 1 : 0) : 1;
        // Mettre à jour le livre dans la base de données
        $booksManager->updateBook($id, $title, $author, $description, $condition);

        // Rediriger vers la page de détail du livre après la mise à jour
        header("Location: index.php?action=editBook&id=" . $id);
        exit();
    }
}