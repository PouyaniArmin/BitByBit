<?php 

namespace App\Utils;

class CsrfToken {
    public static function generateToken(){
        if (session_start()===PHP_SESSION_NONE) {
            session_start();
        }
        $token=bin2hex(random_bytes(32));
        $_SESSION['csrf_token']=$token;
        return $token;
    }
    public static function validateToken($token){
        if (session_start()===PHP_SESSION_NONE) {
            session_start();
        }

        return isset($_SESSION['csrf_token']) && $_SESSION['csrf_token']===$token;
    }
    public static function clearToken(){
        unset($_SESSION['csrf_token']);
    }
                           
}