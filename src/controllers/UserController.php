<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Core\Request;
use App\Core\Vaildation;
use App\Core\ValidatesRequests;
use App\Models\UserModel;
use App\Utils\CsrfToken;
use DateTime;

class UserController extends Controller
{
    use ValidatesRequests;
    public function register()
    {
        return $this->renderView('register');
    }
    public function processRegistration(Request $request)
    {
        $feilds = [
            'name' => 'required | max:16',
            'email' => 'required | email',
            'password' => 'required',
            'confirmPassword' => 'required | same:password',
        ];

        $data = $this->validate($feilds, $request->body());
        if ($data === null || $this->validateCsrf($request->body()['csrf_token'])) {
            return $this->renderView('register');
        }
        $user = new UserModel;
        $timestamp = (new DateTime())->format('Y-m-d H:i:s');
        $result = ['name' => $data['name'], 'email' => $data['email'], 'password' => $data['password'], 'created_at' => $timestamp, 'updated_at' => $timestamp];
        $user->createUser($result);
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
        $result = $user->getUserByEmail($data['email']);
        if ($result && password_verify($data['password'], $result['password'])) {
            session_regenerate_id(true);
            $_SESSION['user_role'] = $result['name'];
            return $this->redierctTo('/dashboard');
        }
    }
}
