<?php

namespace App\Core;

use App\Utils\EmailTemplate;
use App\Utils\MailService;
use DateTime;

class AdminSetup extends DBManager
{
    public function createAdminIfNotExists()
    {
        $expiryTime = (new DateTime())->modify('+24 hours')->format('Y-m-d H:i:s');
        $token = bin2hex(random_bytes(32));
        $conn = $this->connect();
        $query_admin = "SELECT * FROM users WHERE email=:email LIMIT 1";
        $stmt = $conn->prepare($query_admin);
        $stmt->bindValue(':email', 'pouyaniarmin@gmail.com');
        $stmt->execute();
        $adminExists = $stmt->fetch();
        if (!$adminExists) {
            $query = "INSERT INTO users(username, email, password, is_email_verified ,email_verification_token ,email_verification_token_expiry ,created_at, updated_at) 
            VALUES (:username, :email, :password, :is_email_verified ,:email_verification_token ,:email_verification_token_expiry,:created_at, :updated_at)";
            $stmt = $conn->prepare($query);
            $stmt->bindValue(':username', 'Admin User');
            $stmt->bindValue(':email', 'pouyaniarmin@gmail.com');
            $stmt->bindValue(':password', password_hash('adminpassword', PASSWORD_DEFAULT));
            $stmt->bindValue(':is_email_verified', 0);
            $stmt->bindValue(':email_verification_token', $token);
            $stmt->bindValue(':email_verification_token_expiry', $expiryTime);
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
            $params = ['email' => 'pouyaniarmin@gmail.com', 'token' => $token];
            $verificationUrl = "http://localhost:8000/verify-email?" . http_build_query($params);

            $subject = "Confirm your email address";
            $body = EmailTemplate::verificationEmail($verificationUrl,$subject);
            // $body = "<div style='font-family: Arial, sans-serif; line-height: 1.5;'>
            // <h2 style='color: #4CAF50;'>Verify Your Email Address</h2>
            // <p>Thank you for signing up! Please verify your email address by clicking the link below:</p>
            // <a href='$verificationUrl' style='display: inline-block; margin-top: 10px; padding: 10px 20px; background-color: #4CAF50; color: #ffffff; text-decoration: none; border-radius: 5px;'>Verify Email</a>
            // <p style='margin-top: 20px; color: #555;'>If you did not sign up for this account, you can safely ignore this email.</p>
            // <p style='margin-top: 10px;'>Regards,<br>Team BitByBit</p>
            // </div>";
            $mail = new MailService;

            $mail->sendVerificationEmail('pouyaniarmin@gmail.com', $subject, $body);
        }
    }
}
