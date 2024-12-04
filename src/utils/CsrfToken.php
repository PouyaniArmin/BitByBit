<?php

namespace App\Utils;

class CsrfToken
{
    /**
     * Generates a CSRF token and stores it in the session.
     * 
     * @return string The generated CSRF token.
     */
    public static function generateToken()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        $token = bin2hex(random_bytes(32));
        $_SESSION['csrf_token'] = $token;
        return $token;
    }
    /**
     * Validates the provided CSRF token against the token stored in the session.
     * 
     * @param string $token The CSRF token to validate.
     * @return bool True if the token matches the one in the session, false otherwise.
     */
    public static function validateToken($token)
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        return isset($_SESSION['csrf_token']) && $_SESSION['csrf_token'] === $token;
    }
    /**
     * Clears the CSRF token from the session.
     */
    public static function clearToken()
    {
        unset($_SESSION['csrf_token']);
    }
}
