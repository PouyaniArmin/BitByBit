<?php

namespace App\Controllers;

use App\Core\DBManager;
use App\Core\Request;
use App\Core\Controller;
use App\Core\ValidatesRequests;
use App\Models\CommentModel;
use App\Models\PostModel;
use App\Models\UserModel;
use App\Models\VisitViewModel;
use App\Utils\FlashMessage;
use DateTime;
use tidy;

class HomeController extends Controller
{
    use ValidatesRequests;
    public function index(Request $request)
    {
        $this->setHeaders('Content-Type', 'text/html; charset=UTF-8');
        $this->setHeaders('X-Frame-Options', 'SAMEORIGIN');
        $this->setHeaders('X-Content-Type-Options', 'nosniff');
        $this->setHeaders('Strict-Transport-Security', 'max-age=31536000; includeSubDomains; preload');
        $this->setHeaders('Referrer-Policy', 'no-referrer-when-downgrade');
        $this->setHeaders('X-XSS-Protection', '1; mode=block');
        $this->setHeaders('Cache-Control', 'no-store, no-cache, must-revalidate, proxy-revalidate');
        $this->setHeaders('Permissions-Policy', 'geolocation=(self), microphone=(self), camera=(self)');
        if (isset($_COOKIE['page_views'])) {
         $views=$_COOKIE['page_views']+1;
        }else{
            $views=1;
        }
        setcookie('page_views',$views,time()+(86400*7),'/');
        $vistView=new VisitViewModel;
        $timestamp = (new DateTime())->format('Y-m-d H:i:s');
        $vistView->createVistView(['views'=>$views,'created_at'=>$timestamp]);
        $posts = new PostModel();
        $data = $posts->getAllPost();
        return $this->renderView('home', $data[0]);
    }

    public function search(Request $request)
    {
        $feilds = ['search' => 'required '];
        $data = $this->validate($feilds, $request->body());
        if ($data === null) {
            return $this->redierctTo('/');
        }
        $posts = new PostModel;
        $search = $data['search'];
        $result = $posts->serarchPost($search);
        // var_dump($result); 
        return $this->renderView('search-output',['result'=>$result]);
    }
    public function articles(Request $request)
    {
        return $this->renderView('articles');
    }

    public function test($id)
    {
        echo $id;
    }
    public function posts($id)
    {
        $posts = new PostModel;
        $comments = new CommentModel;
        $comment = $comments->getAllComment();
        $post = $posts->getPostById($id);
        return $this->renderView('article', ['post' => $post[0], 'comments' => $comment]);
    }
    public function comments(Request $request)
    {
        $feilds = [
            'email' => 'required | email',
            'comment' => 'required'
        ];

        $data = $this->validate($feilds, $request->body());
        $post_id = $request->body()['post_id'];
        if ($data === null || $this->validateCsrf($request->body()['csrf_token'])) {
            return $this->redierctTo('/post' . "/" . $post_id);
        }

        $comment = new CommentModel;
        $check = $comment->getByEmail($data['email']);
        if ($check) {
            $timestamp = (new DateTime())->format('Y-m-d H:i:s');
            $result = ['email' => $data['email'], 'comment' => $data['comment'], 'post_id' => $post_id, 'created_at' => $timestamp];
            $comment->createComment($result);
        } else {
            FlashMessage::setMessage('errors', ['email' => 'Email not found. Please register an account before commenting on the post']);
            // return $this->redierctTo('/post' . "/" . $post_id);
        }
        return $this->redierctTo('/post' . "/" . $post_id);
    }
}
