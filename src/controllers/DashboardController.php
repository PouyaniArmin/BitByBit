<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Core\DBManager;
use App\Core\Request;
use App\Core\ValidatesRequests;
use App\Models\PostModel;
use DateTime;
use DOMDocument;
use DOMXPath;

class DashboardController extends Controller
{
    use ValidatesRequests;
    public function __construct()
    {
        $this->layout = "main-dashboard";
    }
    public function index()
    {
        return $this->renderView('dashboard');
    }
    
    public function users()
    {
        return $this->renderView('users');
    }
    public function updateUser($id)
    {
        return $this->renderView('updateUser');
    }
    public function setting()
    {
        return $this->renderView('setting');
    }
}
