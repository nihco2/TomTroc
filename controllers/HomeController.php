<?php
require_once('models/BooksManager.php');

class HomeController {
    public function showHome() {
        Utils::isUserConnected();
        // On crée la vue pour la page d'accueil.
        $view = new View("Accueil");
        // On récupère les derniers livres ajoutés.
        $latestBooks = (new BooksManager())->getLatestBooks(4);
        // On rend la vue avec les derniers livres.
        $view->render('home', ['latestBooks' => $latestBooks]);
    }
}