<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Core\Request;
use App\Core\Vaildation;
use App\Core\ValidatesRequests;
use App\Utils\CsrfToken;

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
            'username' => 'required | max:16',
            'email' => 'required | email',
            'password' => 'required',
            'confirmPassword' => 'required | same:password',
        ];

        $data=$this->validate($feilds,$request->body());
        if ($data===null || $this->validateCsrf($request->body()['csrf_token'])) {
            return $this->renderView('register');
        }
        var_dump($data);
        return $this->renderView('welcome');
    }

    public function login(Request $request)
    {
        return $this->renderView('login');
    }
}
