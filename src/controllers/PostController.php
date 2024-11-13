<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Core\Request;
use App\Core\ValidatesRequests;
use App\Models\PostModel;
use DateTime;

class PostController extends Controller
{

    use ValidatesRequests;
    public function __construct()
    {

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
        return $this->renderView('createPost');
    }

    public function insertPost(Request $request)
    {
        $fields = [
            'postTitle' => 'required',
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
        $result = ['title' => htmlspecialchars($data['postTitle'], ENT_QUOTES, 'UTF-8'), 'content' => base64_encode($updateContent), 'image' => $folder, 'created_at' => $timestamp, 'updated_at' => $timestamp];
        $post = new PostModel;
        $post->createPost($result);
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
