<?php

namespace App\Core;

use DateTime;
use Dotenv\Dotenv;
use Exception;
use PDO;
use PDOException;

class DBManager
{
    private string $user;
    private string $password;
    private string $dsn;
    public function __construct()
    {
        $dotenv = Dotenv::createImmutable(Application::$rootPath);
        $dotenv->safeLoad();
        $this->dsn = "mysql:host={$_ENV['DB_HOST']};dbname={$_ENV['DB_NAME']}";
        $this->user = $_ENV['DB_USER'];
        $this->password = $_ENV['DB_PASSWORD'];
    }

    protected function connect():PDO
    {
        try {
            $conn = new PDO($this->dsn, $this->user, $this->password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $conn;
        } catch (PDOException $pe) {
            throw new Exception("Datatbase connection failed: " . $pe->getMessage(), 1);
        }
    }
    
}
