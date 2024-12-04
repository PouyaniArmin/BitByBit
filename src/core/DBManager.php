<?php

namespace App\Core;

use App\Utils\LoggerService;
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

    /**
     * Constructor.
     * Initializes database connection parameters by loading environment variables.
     * Also sets up logging for database-related activities.
     *
     * @throws Exception if environment variables are not loaded properly.
     */
    public function __construct()
    {
        // Load environment variables from the .env file.
        $dotenv = Dotenv::createImmutable(Application::$rootPath);
        $dotenv->safeLoad();
        $this->dsn = "mysql:host={$_ENV['DB_HOST']};dbname={$_ENV['DB_NAME']}";
        // Set the Data Source Name (DSN) for the database connection.
        $this->user = $_ENV['DB_USER'];
        $this->password = $_ENV['DB_PASSWORD'];
        // Initialize logging for database operations.
        new LoggerService('DBLogger', 'db');
    }
 /**
     * Establish a connection to the database.
     *
     * @return PDO - The PDO instance for interacting with the database.
     * @throws Exception if the connection fails.
     */
    protected function connect(): PDO
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
