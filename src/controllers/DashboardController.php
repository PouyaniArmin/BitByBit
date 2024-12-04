<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Core\DBManager;
use App\Core\Request;
use App\Core\SessionManager;
use App\Core\ValidatesRequests;
use App\Models\PostModel;
use App\Models\UserModel;
use App\Models\VisitViewModel;
use App\Utils\CsrfToken;
use DateTime;
use DOMDocument;
use DOMXPath;

class DashboardController extends Controller
{
    use ValidatesRequests;
    public function __construct()
    {

        $this->setHeaders('Content-Type', 'text/html; charset=UTF-8');
        $this->setHeaders('X-Frame-Options', 'SAMEORIGIN');
        $this->setHeaders('X-Content-Type-Options', 'nosniff');
        $this->setHeaders('Strict-Transport-Security', 'max-age=31536000; includeSubDomains; preload');
        $this->setHeaders('Referrer-Policy', 'no-referrer-when-downgrade');
        $this->setHeaders('X-XSS-Protection', '1; mode=block');
        $this->setHeaders('Cache-Control', 'no-store, no-cache, must-revalidate, proxy-revalidate');
        $this->setHeaders('Permissions-Policy', 'geolocation=(self), microphone=(self), camera=(self)');
        $this->layout = "main-dashboard";
    }
    public function index()
    {
        $posts = new PostModel;
        $users = new UserModel;
        $vist=new VisitViewModel;
        $posts = $posts->getPostCountByMonth();
        $users = $users->getUsersStatusCount();
        $vists=$vist->getViews();
        return $this->renderView('dashboard', ['posts' => $posts, 'users' => $users,'vists'=>$vists]);
    }

    public function users()
    {
        $users = new UserModel;
        $data = $users->getUserAndRole();
        return $this->renderView('users', $data);
    }
    public function updateUser($id)
    {
        $user = new UserModel;
        $data = $user->getUserById($id);
        // var_dump($data[0]['name']);
        return $this->renderView('updateUser', $data[0]);
    }
    public function updatedUser(Request $request)
    {
        $feilds = [
            'username' => 'required',
            'email' => 'required | email',
        ];
        $data = $this->validate($feilds, $request->body());
        if ($data === null || $this->validateCsrf($request->body()['csrf_token'])) {
            return $this->renderView('login');
        }
        $user = new UserModel;
        $timestamp = (new DateTime())->format('Y-m-d H:i:s');
        $resutt = ['name' => $data['name'], 'email' => $data['email'], 'updated_at' => $timestamp];
        $user->updateUser($data['id'], $resutt);
        return $this->redierctTo('/dashboard/users');
    }

    public function setting()
    {
        return $this->renderView('setting');
    }

    public function logout()
    {
        CsrfToken::clearToken();
        $sm = new SessionManager;
        $sm->regenerateId();
        $sm->remvoe();
        return $this->redierctTo('/');
    }
}
