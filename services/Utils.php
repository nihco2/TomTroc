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

    /**
     * Sanitize user input to prevent XSS attacks.
     * @param string $input
     * @return string
     */
    public static function sanitizeInput(string $input) : string
    {
        return htmlspecialchars(trim($input), ENT_QUOTES, 'UTF-8');
    }
}