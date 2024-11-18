<?php

namespace App\Core;

use PDO;

class Model extends DBManager
{

    protected function create($table, $data)
    {
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


    protected function getAll(string $table)
    {
        $query = "SELECT * FROM {$table}";
        $conn = $this->connect();
        $stmt = $conn->prepare($query);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    protected function getById(string $table, $id)
    {

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
        $query = "SELECT * FROM {$table} WHERE $column=:value";
        $conn = $this->connect();
        $stmt = $conn->prepare($query);
        $stmt->bindValue(':value', $value);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result;
    }

    protected function updateById(string $table, $id, array $data)
    {
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
}
