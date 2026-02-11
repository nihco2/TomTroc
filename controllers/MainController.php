<?php

require_once 'models/UserManager.php';

class MainController {
    public function showSignIn() {
        $view = new View("Connexion");
        $view->render('signin');
    }
    public function showSignUp() {
        $view = new View("Inscription");
        $view->render('signup');
    }
    public function showHome() {
        Utils::isUserConnected();
        $view = new View("Accueil");
        $view->render('home');
    }
    public function createUser() {
        // Récupération des données du formulaire
        $username = $_POST['username'];
        $email = $_POST['email'];
        $password = $_POST['password'];

        // Validation des données (exemple simplifié)
        if (empty($username) || empty($password) || empty($email)) {
            throw new Exception("Veuillez remplir tous les champs.");
        }

        $userManager = new UserManager();
        $existingUser = $userManager->getUserByEmail($email);
        if ($existingUser) {
            throw new Exception("Un utilisateur avec cet email existe déjà.");
        }

        // Création de l'utilisateur
        $user = $userManager->createUser($username, $email, $password);

        // Stockage des informations de l'utilisateur dans la session
        $_SESSION['user'] = $user;

        // Redirection vers la page d'accueil après inscription réussie
        header('Location: index.php?action=home');
    }
    public function signoutUser() {
        // Destruction de la session utilisateur
        session_destroy();
        // Redirection vers la page de connexion
        header('Location: index.php?action=signin');
    }

    public function loginUser() {
        // Récupération des données du formulaire
        $email = $_POST['email'];
        $password = $_POST['password'];

        // Validation des données (exemple simplifié)
        if (empty($email) || empty($password)) {
            throw new Exception("Veuillez remplir tous les champs.");
        }

        $userManager = new UserManager();
        $user = $userManager->getUserByEmail($email);
        $unread_messages_count = $userManager->getUnreadMessagesCount($user['id']);

        if (!$user || !password_verify($password, $user['password'])) {
            throw new Exception("Email ou mot de passe incorrect.");
        }

        // Stockage des informations de l'utilisateur dans la session
        $_SESSION['user'] = $user;
        $_SESSION['unread_messages_count'] = $unread_messages_count;

        // Redirection vers la page d'accueil après connexion réussie
        header('Location: index.php?action=home');
    }
}