<?php

class Utils {
    /**
     * Vérifie que l'utilisateur est connecté.
     * @return void
     */
    public static function isUserConnected() : void
    {
        // On vérifie que l'utilisateur est connecté.
        if (!isset($_SESSION['user'])) {
            header('Location: index.php?action=signin');
        }
    }
}