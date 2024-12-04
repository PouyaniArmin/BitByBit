<?php 

namespace App\Utils;

class EmailTemplate{

    public static function verificationEmail($verificationUrl,$subject){
        return "<div style='font-family: Arial, sans-serif; line-height: 1.5;'>
            <h2 style='color: #4CAF50;'>$subject</h2>
            <p>Thank you for signing up! Please verify your email address by clicking the link below:</p>
            <a href='$verificationUrl' style='display: inline-block; margin-top: 10px; padding: 10px 20px; background-color: #4CAF50; color: #ffffff; text-decoration: none; border-radius: 5px;'>Verify Email</a>
            <p style='margin-top: 20px; color: #555;'>If you did not sign up for this account, you can safely ignore this email.</p>
            <p style='margin-top: 10px;'>Regards,<br>Team BitByBit</p>
            </div>";
    }
} 