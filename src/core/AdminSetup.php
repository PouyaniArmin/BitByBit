<?php

namespace App\Core;

use DateTime;

class AdminSetup extends DBManager
{
    public function createAdminIfNotExists()
    {
        $conn = $this->connect();
        $query_admin = "SELECT * FROM users WHERE email=:email LIMIT 1";
        $stmt = $conn->prepare($query_admin);
        $stmt->bindValue(':email', 'pouyaniarmin@gmail.com');
        $stmt->execute();
        $adminExists = $stmt->fetch();
        if (!$adminExists) {
            $query = "INSERT INTO users(name, email, password, created_at, updated_at) 
            VALUES (:name, :email, :password, :created_at, :updated_at)";
            $stmt=$conn->prepare($query);
            $stmt->bindValue(':name', 'Admin User');
            $stmt->bindValue(':email', 'pouyaniarmin@gmail.com');
            $stmt->bindValue(':password', password_hash('adminpassword', PASSWORD_DEFAULT));
            $stmt->bindValue(':created_at', (new DateTime())->format('Y-m-d H:i:s'));
            $stmt->bindValue(':updated_at', (new DateTime())->format('Y-m-d H:i:s'));
            $stmt->execute();

            $userId = $conn->lastInsertId();
            $roleId = 1;
            $role_query = "INSERT INTO role_user (user_id, role_id) VALUES (:user_id, :role_id)";
            $stmt = $conn->prepare($role_query);
            $stmt->bindValue(':user_id', $userId);
            $stmt->bindValue(':role_id', $roleId);
            $stmt->execute();
        }
    }
}
