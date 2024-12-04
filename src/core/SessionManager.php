<?php

namespace App\Core;

class SessionManager
{
     /**
     * SessionManager constructor starts the session if not already started 
     * and sets the session security configurations.
     */
    public function __construct()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        $this->setSecurity();
    }
     /**
     * Configures session security settings to protect against common security risks.
     */
    private function setSecurity()
    {

        ini_set('session.cookie_httponly', true);
        ini_set('session.cookie_secure', true);
        session_set_cookie_params([
            'httponly' => true,
            'secure' => true,
            'samesite' => 'Strict'
        ]);
        ini_set('session.cookie_samesite', 'Strict');
    }
    /**
     * Regenerates the session ID to prevent session fixation attacks.
     */
    public function regenerateId()
    {
        session_regenerate_id(true);
    }

    /**
     * Stores a value in the session associated with a specific key.
     *
     * @param string $key The session key
     * @param mixed $value The value to store
     */
    public function set($key, $value)
    {
        $_SESSION[$key] = $value;
    }
    /**
     * Retrieves a value from the session by its key.
     *
     * @param string $key The session key
     * @return mixed|null The session value, or null if the key doesn't exist
     */
    public function get($key)
    {
        return isset($_SESSION[$key]) ? $_SESSION[$key] : null;
    }
     /**
     * Destroys the current session and clears all session data.
     */
    public function remvoe()
    {
        session_destroy();
        $_SESSION = [];
    }
}
