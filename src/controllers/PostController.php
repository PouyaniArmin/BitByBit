<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Core\Request;
use App\Core\ValidatesRequests;
use App\Models\CategoryModel;
use App\Models\PostModel;
use App\Models\TagModel;
use DateTime;

class PostController extends Controller
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
    public function posts()
    {
        $post = new PostModel;
        $data = $post->getAllPost();
        return $this->renderView('posts', $data);
    }
    public function createPost()
    {
        $categoy=new CategoryModel;
        $tag=new TagModel;
        $data=['categories'=>$categoy->getAllCategory(),'tags'=>$tag->getAllTag()];
        return $this->renderView('createPost',$data);
    }

    public function insertPost(Request $request)
    {
        $fields = [
            'postTitle' => 'required',
            'category_id'=>'required',
            'postImage' => 'required | image',
            'content' => 'required'
        ];
        $data = $this->validate($fields, $request->body());
        if ($data === null) {
            return $this->renderView('createPost');
        }
        $folder = uploadImage($data['postImage']);
        $updateContent = uploadImagesFromContent($data['content']);
        $timestamp = (new DateTime())->format('Y-m-d H:i:s');
        $result = ['title' => htmlspecialchars($data['postTitle'], ENT_QUOTES, 'UTF-8'), 'content' => base64_encode($updateContent), 'image' => $folder,'category_id'=> $data['category_id'],'created_at' => $timestamp, 'updated_at' => $timestamp];
      
        $post = new PostModel;
        $post->createPost($result);
        return $this->redierctTo('/dashboard/posts');
    }
    public function updatePost($id)
    {
        $post = new PostModel;
        $data = $post->getPostById($id);
        return $this->renderView('updatePost', $data[0]);
    }

    public function updatedPost(Request $request)
    {
        $body = $request->body();
        $id = intval($body['id']);
        $title = htmlspecialchars($body['title']);
        $timestamp = (new DateTime())->format('Y-m-d H:i:s');
        $post = new PostModel;
        $currentPost = $post->getPostById($id);
        $updateContent = $currentPost['content'] !== $body['content']
            ? uploadImagesFromContent($body['content']) : $currentPost['content'];

        $folder = $currentPost['image'];
        if (!empty($body['image'] || $body['image'] !== "")) {
            $folder = uploadImage($body['image']);
        }

        $result = ['title' => $title, 'content' => base64_encode($updateContent), 'image' => $folder, 'updated_at' => $timestamp];
        $post->updatePost($id, $result);
        echo "update";
    }

    public function deletePost(Request $request)
    {
        $id = intval($request->body()['id']);
        $post = new PostModel;
        $post->deletePostById($id);
        return $this->redierctTo('/dashboard/posts');
    }
}
