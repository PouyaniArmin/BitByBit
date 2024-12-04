<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Core\Request;
use App\Core\Vaildation;
use App\Core\ValidatesRequests;
use App\Models\UserModel;
use App\Utils\CsrfToken;
use App\Utils\EmailTemplate;
use App\Utils\FlashMessage;
use App\Utils\MailService;
use DateTime;

class UserController extends Controller
{
    use ValidatesRequests;
    public function register()
    {

        $this->setHeaders('Content-Type', 'text/html; charset=UTF-8');
        $this->setHeaders('X-Frame-Options', 'SAMEORIGIN');
        $this->setHeaders('X-Content-Type-Options', 'nosniff');
        $this->setHeaders('Strict-Transport-Security', 'max-age=31536000; includeSubDomains; preload');
        $this->setHeaders('Referrer-Policy', 'no-referrer-when-downgrade');
        $this->setHeaders('X-XSS-Protection', '1; mode=block');
        $this->setHeaders('Cache-Control', 'no-store, no-cache, must-revalidate, proxy-revalidate');
        $this->setHeaders('Permissions-Policy', 'geolocation=(self), microphone=(self), camera=(self)');
        return $this->renderView('register');
    }
    public function processRegistration(Request $request)
    {
        $feilds = [
            'username' => 'required | max:16',
            'email' => 'required | email',
            'password' => 'required',
            'confirmPassword' => 'required | same:password',
        ];

        $data = $this->validate($feilds, $request->body());
        if ($data === null || $this->validateCsrf($request->body()['csrf_token'])) {
            return $this->renderView('register');
        }
        $token = bin2hex(random_bytes(32));
        $expiryTime = (new DateTime())->modify('+24 hours')->format('Y-m-d H:i:s');
        $user = new UserModel;
        $timestamp = (new DateTime())->format('Y-m-d H:i:s');
        $result = [
            'username' => $data['username'],
            'email' => $data['email'],
            'password' => $data['password'],
            'is_email_verified' => 0,
            'email_verification_token' => $token,
            'email_verification_token_expiry' => $expiryTime,
            'password_reset_token' => null,
            'password_reset_token_expiry' => null,
            'created_at' => $timestamp,
            'updated_at' => $timestamp
        ];
        $user->createUser($result);
        $params = ['email' => $data['email'], 'token' => $token];
        $verificationUrl = "http://localhost:8000/verify-email?" . http_build_query($params);
        $subject = "Confirm your email address";
        $mail = new MailService;
        $mailTemp = EmailTemplate::verificationEmail($verificationUrl, $subject);
        $mail->sendVerificationEmail($data['email'], $subject, $mailTemp);
        return $this->renderView('welcome');
    }

    public function login()
    {
        return $this->renderView('login');
    }
    public function processLogin(Request $request)
    {
        $feilds = [
            'email' => 'required | email',
            'password' => 'required',
        ];
        $data = $this->validate($feilds, $request->body());
        if ($data === null || $this->validateCsrf($request->body()['csrf_token'])) {
            return $this->renderView('login');
        }
        $user = new UserModel;
        $mail = $user->getByEmial($data['email']);
        if (!$mail) {
            FlashMessage::setMessage('errors', ['email' => 'Not Found Email Please Register']);
            return $this->redierctTo('/login');
        }
        $result = $user->getUserByEmail($data['email']);
        if ($result && password_verify($data['password'], $result['password'])) {
            session_regenerate_id(true);
            $_SESSION['user_role'] = $result['name'];
            return $this->redierctTo('/dashboard');
        }
        FlashMessage::setMessage('errors', ['password' => 'Wrong Password Please try agin']);
        return $this->redierctTo('/login');
    }

    public function verfiyAccount(Request $request)
    {
        $body = $request->body();
        $email = $body['email'];
        $token = $body['token'];
        $user = new UserModel;
        $result = $user->getByEmial($email);
        $expiryTime = strtotime($result['email_verification_token_expiry']);
        $currentTime = time();
        if ($currentTime > $expiryTime) {
            echo "<br>The verification token has expired";
            exit;
        }
        if ($result['is_email_verified']) {
            echo "Account verifiy ";
            exit;
        }
        if ($result['email_verification_token'] === $token) {
            $data = ['is_email_verified' => 1, 'email_verification_token' => null];
            $user->updateUser($result['id'], $data);
            echo "Update";
        }
    }

    public function forgetPassword()
    {
        return $this->renderView('forgetPassword');
    }
    public function resetPasswordRequest(Request $request)
    {
        $user = new UserModel;
        $body = $request->body();
        $feilds = ['email' => 'required | email'];
        $data = $this->validate($feilds, $body);
        if ($data === null || $this->validateCsrf($body['csrf_token'])) {
            return $this->renderView('forgetPassword');
        }
        $email = $data['email'];
        $result = $user->getByEmial($email);
        if (!$result) {
            FlashMessage::setMessage('errors',['email' => 'not found']);
            return $this->renderView('forgetPassword');
        }

        $expiryTime = (new DateTime())->modify('+1 hours')->format('Y-m-d H:i:s');
        $token = bin2hex(random_bytes(32));
        $params = ['email' => $email, 'token' => $token];
        // add email to url
        $resetUrl = "http://localhost:8000/reset-password?" . http_build_query($params);
        $mailTemplate = EmailTemplate::verificationEmail($resetUrl, "Rest Password");
        $mail = new MailService;
        $mail->sendRestPasswordEmail($email, $mailTemplate);
        $update = ['password_reset_token' => $token, 'password_reset_token_expiry' => $expiryTime];
        $user->updateUser($result['id'], $update);
        FlashMessage::setMessage('success', ['لینک با موفقیت ارسال شد لطفا ایمیل خود را بررسی کنید.']);
        return $this->redierctTo('forgot-password');
    }
    public function restPassword(Request $request)
    {
        $body = $request->body();
        $email = $body['email'];
        $token = $body['token'];
        $user = new UserModel;
        $result = $user->getByEmial($email);
        $expiryTime = strtotime($result['password_reset_token_expiry']);
        if ($expiryTime < time()) {
            echo "Expiry Time";
            exit;
        }
        if ($result['password_reset_token'] !== $token) {
            echo "token not true";
            exit;
        }
        return $this->renderView('rest-password', $result);
    }
    public function processResetPassword(Request $request)
    {
        $user = new UserModel;
        $feilds = [
            'password' => 'required',
            'confirmPassword' => 'required | same:password',
        ];
        $data = $this->validate($feilds, $request->body());
        if ($data === null || $this->validateCsrf($request->body()['csrf_token'])) {
            return $this->renderView('rest-password');
        }
        $params = ['password' => password_hash($data['password'], PASSWORD_DEFAULT), 'password_reset_token' => null, 'password_reset_token_expiry' => null];
        $user->updateUser($request->body()['id'], $params);
        FlashMessage::setMessage('success', ['رمز عبور با موفقیت تغییر پیدا کرد.']);
        return $this->redierctTo('/');
    }
}
