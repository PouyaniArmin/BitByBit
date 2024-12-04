<?php

namespace App\Core;

use App\Utils\LoggerService;
use PDO;
use RuntimeException;

class Model extends DBManager
{
    /**
     * Insert a new record into the specified table
     *
     * @param string $table Table name
     * @param array $data Data to insert
     * @return bool Operation result
     */
    protected function create($table, $data)
    {
        $table = $this->tableExists($table);
        $query = $this->buildInsertQuery($table);
        $fields = $this->getTableColumns($table);
        if (($key = array_search('id', $fields)) !== false) {
            unset($fields[$key]);
        }
        $conn = $this->connect();
        $stmt = $conn->prepare($query);
        foreach ($fields as $filed) {
            if (array_key_exists($filed, $data)) {
                $stmt->bindValue(':' . $filed, $data[$filed]);
                if ($filed === 'password') {
                    $stmt->bindValue(':' . $filed, password_hash($data[$filed], PASSWORD_DEFAULT));
                }
            }
        }
        $result = $stmt->execute();
        return $result;
    }
    /**
     * Retrieve all records from the specified table
     *
     * @param string $table Table name
     * @return array Resulting records
     */
    protected function getAll(string $table)
    {

        $table = $this->tableExists($table);
        $query = "SELECT * FROM {$table}";
        $conn = $this->connect();
        $stmt = $conn->prepare($query);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }
    /**
     * Retrieve a record by ID from the specified table
     *
     * @param string $table Table name
     * @param int|string $id Record ID
     * @return array Resulting record
     */
    protected function getById(string $table, $id)
    {

        $table = $this->tableExists($table);
        $query = "SELECT * FROM {$table} WHERE id=:id";
        $conn = $this->connect();
        $stmt = $conn->prepare($query);
        $stmt->bindValue(':id', $id);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    protected function getBy(string $table, string $column, string $value)
    {

        $table = $this->tableExists($table);
        $query = "SELECT * FROM {$table} WHERE $column=:value";
        $conn = $this->connect();
        $stmt = $conn->prepare($query);
        $stmt->bindValue(':value', $value);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result;
    }
    protected function getCountByMonth($table, $count)
    {
        $table = $this->tableExists($table);
        $query = "SELECT
                 YEAR(created_at) AS year,
                 MONTH(created_at) AS month,
                 COUNT(*) AS $count
                 FROM $table
                 GROUP BY YEAR(created_at), MONTH(created_at)
                 ORDER BY YEAR(created_at) DESC, MONTH(created_at) DESC;";
        $stmt = $this->connect()->prepare($query);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }
    protected function getByStatus($table)
    {

        $table = $this->tableExists($table);
        $query = "SELECT 
              COUNT(*) AS total, 
              is_email_verified 
          FROM users 
          GROUP BY is_email_verified";
        $stmt = $this->connect()->prepare($query);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }
    protected function getLastInsertedId($table)
    {

        $table = $this->tableExists($table);
        $query = "SELECT LAST_INSERT_ID() AS last_id FROM {$table}";
        $stmt = $this->connect()->prepare($query);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result['last_id'];
    }
    protected function getUsersWithRoles()
    {
        $query = "SELECT users.id,users.username,users.email,roles.name 
            FROM users LEFT JOIN role_user ON users.id = role_user.user_id
            LEFT JOIN roles ON role_user.role_id = roles.id;";
        $stmt = $this->connect()->prepare($query);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    protected function updateById(string $table, $id, array $data)
    {

        $table = $this->tableExists($table);
        $columns = $this->getTableColumns($table);
        $setValues = [];
        foreach ($data as $key => $value) {
            if (in_array($key, $columns)) {
                $setValues[] = "`$key`=:$key";
            }
        }
        $setString = implode(', ', $setValues);
        $query = "UPDATE {$table} SET $setString WHERE id=:id";
        $conn = $this->connect();
        $stmt = $conn->prepare($query);
        foreach ($data as $key => $value) {
            if (in_array($key, $columns)) {
                $stmt->bindValue(":$key", $value);
            }
        }
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        return $stmt->execute();
    }
    protected function deleteById(string $table, int $id)
    {

        $table = $this->tableExists(trim($table));
        $query = "DELETE FROM $table WHERE id=:id";
        $stmt = $this->connect()->prepare($query);
        $stmt->bindValue(':id', $id);
        return $stmt->execute();
    }

    protected function getUserRoleByEmail(string $email)
    {

        $query = "SELECT r.name FROM roles r 
              INNER JOIN role_user ru ON r.id = ru.role_id
              INNER JOIN users u ON u.id = ru.user_id
              WHERE u.email = :email LIMIT 1";
        $conn = $this->connect();
        $stmt = $conn->prepare($query);
        $stmt->bindValue(':email', $email);
        $stmt->execute();
        $role = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($role && $role['name'] === 'Admin') {
            return $role;
        }
        return null;
    }

    protected function getDailyViews($table)
    {

        $table = $this->tableExists(trim($table));
        $query = "SELECT 
        DATE(created_at) AS date,
        views
    FROM 
        page_views p1
    WHERE 
        created_at = (
            SELECT MAX(created_at)
            FROM page_views p2
            WHERE DATE(p2.created_at) = DATE(p1.created_at)
        )
        AND created_at >= CURDATE() - INTERVAL 7 DAY
    ORDER BY 
        date DESC
";
        $stmt = $this->connect()->prepare($query);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    protected function getUserRole($email)
    {
        $user = $this->getBy('users', 'email', $email);
        if ($user) {
            return $this->getUserRoleByEmail($email);
        }
        return null;
    }

    private function buildInsertQuery(string $table): string
    {

        $fields = $this->getTableColumns($table);
        if (($key = array_search('id', $fields)) !== false) {
            unset($fields[$key]);
        }
        $columns = '`' . implode('`, `', $fields) . '`';
        $placeholder = ':' . implode(', :', $fields) . '';
        $query = "INSERT INTO {$table} ($columns) VALUES ($placeholder)";
        return $query;
    }

    private function getTableColumns(string $tableName)
    {
        $query = "SHOW COLUMNS FROM `$tableName`";
        $stmt = $this->connect()->prepare($query);
        $stmt->execute();
        return array_column($stmt->fetchAll(PDO::FETCH_ASSOC), 'Field');
    }
    protected function searchInTable($table, $needle)
    {
        $table = $this->tableExists($table);
        $columns = $this->getTableColumnsString($table);
        $conditions = array_map(function ($column) {
            return "$column LIKE :search ";
        }, $columns);
        $whereClause = implode(' OR ', $conditions);
        $query = "SELECT * FROM $table WHERE $whereClause";
        $stmt = $this->connect()->prepare($query);
        $stmt->bindValue(':search', "%$needle%");
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }
    private function getTableColumnsString(string $tableName)
    {

        $query = "SHOW COLUMNS FROM `$tableName`";
        $stmt = $this->connect()->prepare($query);
        $stmt->execute();
        $columns = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $textColumns = [];
        foreach ($columns as $column) {
            $type = $column['Type'];

            if (
                strpos($type, 'char') !== false || strpos($type, 'text') !== false
                || strpos($type, 'varchar') !== false
            ) {
                $textColumns[] = $column['Field'];
            }
        }
        foreach ($textColumns as $key => $value) {
            if ($value === 'image') {
                unset($textColumns[$key]);
            }
        }
        return $textColumns;
    }

    /**
     * Check if the table exists in the database
     *
     * @param string $table Table name
     * @return string|null Validated table name or null if not exists
     */
    private function tableExists($table)
    {

        if (!preg_match('/^[a-zA-Z0-9_]+$/', $table)) {
            throw new RuntimeException("Table name Error", 1);
        }
        $tables = $this->getTables();
        $tableName = array_column($tables, 'table_name');
        return in_array($table, $tableName, true) ? $table : null;
    }
    private function getTables(): array
    {
        $query = "SELECT table_name FROM information_schema.tables WHERE table_schema = :database";
        $stmt = $this->connect()->prepare($query);
        $stmt->execute([':database' => 'BitByBit']);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
