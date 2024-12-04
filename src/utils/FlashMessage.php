<?php

namespace App\Utils;

use App\Core\SessionManager;

class FlashMessage extends SessionManager
{
    /**
     * Sets a flash message of a specific type.
     * 
     * @param string $type The type/category of the flash message (e.g., success, error).
     * @param mixed $message The message content (can be a string or array).
     */
    public static function setMessage(string $type, $message)
    {
        $_SESSION['flash_message'][$type] = $message;
    }
    /**
     * Retrieves and removes the flash message of the specified type from the session.
     * 
     * @param string $type The type/category of the flash message to retrieve (e.g., success, error).
     * @return mixed The message content if it exists, or an empty array if no message is found.
     */
    public static function getMessage(string $type)
    {
        if (isset($_SESSION['flash_message'][$type])) {
            $message = $_SESSION['flash_message'][$type];
            unset($_SESSION['flash_message'][$type]);
            return $message;
        }
        return [];
    }
    /**
     * Checks if a flash message of the specified type exists in the session.
     * 
     * @param string $type The type/category of the flash message to check.
     * @return bool True if a message exists, false otherwise.
     */
    public static function hasMessage($type)
    {
        return isset($_SESSION['flash_message'][$type]) && count($_SESSION['flash_message'][$type]) > 0;
    }
}
