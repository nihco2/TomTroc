<?php
require_once('models/BooksManager.php');

class HomeController {
    public function showHome() {
        // On crée la vue pour la page d'accueil.
        $view = new View("Accueil");
        // On récupère les derniers livres ajoutés.
        $latestBooks = (new BooksManager())->getLatestBooks(5);
        // On rend la vue avec les derniers livres.
        $view->render('home', ['latestBooks' => $latestBooks]);
    }
}