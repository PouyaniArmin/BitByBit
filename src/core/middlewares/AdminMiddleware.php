<?php 

namespace App\Core\Middlewares;

class AdminMiddleware extends BaseMiddleware{
    public function handle()
    {
        if (!isset($_SESSION['user_role'])|| $_SESSION['user_role'] !== 'Admin') {
            return $this->redirect('/login');
        }
    }
}