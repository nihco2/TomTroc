<?php

require_once('models/AccountManager.php');

class AccountController {
    public function showAccount() {
        Utils::isUserConnected();
        $user = $_SESSION['user'];
        $userId = $user['id'];
        $accountManager = new AccountManager();
        $user = $accountManager->getUserById($userId);
        $bookByUser = $accountManager->getBooksByUserId($userId);
        $registrationDate = date('d/m/Y', strtotime($user['created_at']));
        $password = str_repeat('*', 8); // Affiche des étoiles à la place du mot de passe

        if (!$user) {
            throw new Exception("Utilisateur non trouvé.");
        }

        $view = new View('account');
        $view->render('account', [
            'user' => $user,
            'registrationDate' => $registrationDate,
            'bookByUser' => $bookByUser,
            'password' => $password
        ]);
    }

    public function editAccount() {
        Utils::isUserConnected();
        $user = $_SESSION['user'];
        $userId = $user['id'];
        $accountManager = new AccountManager();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Récupérer les données du formulaire
            $email = Utils::sanitizeInput($_POST['email']);
            $password = Utils::sanitizeInput($_POST['password']);
            $username = Utils::sanitizeInput($_POST['username']);

            // Validation basique
            if (empty($email) || empty($username)) {
                throw new Exception("L'email et le pseudo ne peuvent pas être vides.");
            }

            // Mettre à jour les informations de l'utilisateur
            $accountManager->updateUser($userId, $email, $password, $username);

            // Mettre à jour les informations dans la session
            $_SESSION['user']['email'] = $email;
            $_SESSION['user']['username'] = $username;

            // Rediriger vers la page du compte après la mise à jour
            header('Location: index.php?action=account');
            exit();
        } else {
            // Afficher le formulaire de modification
            $user = $accountManager->getUserById($userId);
            if (!$user) {
                throw new Exception("Utilisateur non trouvé.");
            }

            $view = new View('editAccount');
            $view->render('editAccount', ['user' => $user]);
        }
    }

    public function showProfile() {
        Utils::isUserConnected();
        $user = $_SESSION['user'];
        $userId = $user['id'];
        $accountManager = new AccountManager();
        $user = $accountManager->getUserById($userId);

        if (!$user) {
            throw new Exception("Utilisateur non trouvé.");
        }

        $view = new View('profile');
        $view->render('profile', [
            'user' => $user,
            'bookByUser'=> $accountManager->getBooksByUserId($userId),
            'registrationDate' => date('d/m/Y', strtotime($user['created_at'])),
        ]);
    }
}