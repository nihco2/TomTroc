<?php

require_once('config/config.php');
require_once('controllers/MainController.php');
require_once('services/Utils.php');
require_once('models/DBManager.php');
require_once('views/View.php');

// On récupère l'action demandée par l'utilisateur.
$action = isset($_GET['action']) ? $_GET['action'] : 'home';
// On instancie le contrôleur principal.
$controller = new MainController();
// Try catch global pour gérer les erreurs
try {
    // Pour chaque action, on appelle le bon contrôleur et la bonne méthode.
    switch ($action) {
        case 'home':
            $controller->showHome();
            break;
        case 'signin':
            $controller->showSignIn();
            break;
        case 'signup':
            $controller->showSignUp();
            break;
        case 'create':
            $controller->createUser();
            break;
        case 'login':
            $controller->loginUser();
            break;  
        case 'signout':
            $controller->signoutUser();
            break;

        default:
            throw new Exception("Action '$action' non reconnue.");
    }
} catch (Exception $e) {
    // En cas d'erreur, on affiche une page d'erreur.
    $errorMessage = $e->getMessage();
    $view = new View("Erreur");
    $view->render('error', ['errorMessage' => $errorMessage]);
}