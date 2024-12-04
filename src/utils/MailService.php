<?php

namespace App\Utils;

use Exception;
use PHPMailer\PHPMailer\PHPMailer;

class MailService
{
    private $mail;
    /**
     * Constructor for initializing PHPMailer with SMTP settings.
     * Sets up the SMTP configuration and logger service for email-related activities.
     */
    public function __construct()
    {
        $this->mail = new PHPMailer();
        $this->mail->isSMTP();
        $this->mail->Host = 'smtp.gmail.com';
        $this->mail->SMTPAuth = true;
        $this->mail->Username = "armin.pouyani28@gmail.com";
        $this->mail->Password = "isviffxzjqmahrot";
        $this->mail->SMTPSecure = 'tls';
        $this->mail->Port = 587;

        new LoggerService('MailLogger', 'mail');
    }
    /**
     * Sends an email to a specified recipient.
     * 
     * @param string $recipientEmail The recipient's email address.
     * @param string $subject The subject of the email.
     * @param string $body The body/content of the email.
     * @return bool True if email was sent successfully, false otherwise.
     */
    public function sendEmail($recipientEmail, $subject, $body)
    {
        try {
            $this->mail->setFrom('armin.pouyani28@gmail.com', 'BitByBit');
            $this->mail->addAddress($recipientEmail);
            $this->mail->isHTML(true);
            $this->mail->Subject = $subject;
            $this->mail->Body = $body;
            $this->mail->send();
            return true;
        } catch (\Throwable $th) {
            echo "Email Error :" . $th->getMessage();
            return false;
        }
    }
    /**
     * Sends a verification email to the specified recipient.
     * This method reuses the `sendEmail` method for sending verification emails.
     * 
     * @param string $recipientEmail The recipient's email address.
     * @param string $subject The subject of the verification email.
     * @param string $body The body/content of the verification email.
     * @return bool True if the email was sent successfully, false otherwise.
     */
    public function sendVerificationEmail($recipientEmail, $subject, $body)
    {
        return $this->sendEmail($recipientEmail, $subject, $body);
    }
    /**
     * Sends a password reset email to the specified recipient.
     * This method reuses the `sendEmail` method for sending password reset emails.
     * 
     * @param string $recipientEmail The recipient's email address.
     * @param string $body The body/content of the password reset email.
     * @return bool True if the email was sent successfully, false otherwise.
     */
    public function sendRestPasswordEmail($recipientEmail, $body)
    {
        return $this->sendEmail($recipientEmail, "Reset Your Password", $body);
    }
}
