<?php 

namespace App\Controllers;

use App\Core\Controller;
use App\Core\Request;
use App\Core\ValidatesRequests;
use App\Models\TagModel;
use DateTime;

class TagsController extends Controller{
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
        $this->layout='main-dashboard';
    }
    public function index(){
        $tags=new TagModel;
        $data=$tags->getAllTag();
        return $this->renderView('tag',$data);
    }
    public function saveTag(Request $request){
        $fields = ['tag_name' => 'required'];
        $data=$this->validate($fields,$request->body());
        $tags=new TagModel;
        $timestamp=(new DateTime())->format('Y-m-d H:i:s');
        $result=['tag_name'=>$data['tag_name'],'created_at'=>$timestamp,'updated_at'=>$timestamp];
        $tags->createTag($result);
        return $this->redierctTo('/dashboard/tag');
        
    }

    public function updateTag($id){
        $tag=new TagModel;
        $data=$tag->getTagById($id);
        return $this->renderView('updateTag',$data[0]);
    }
    public function updatedTag(Request $request){
        $body=$request->body();
        $tag=new TagModel;
        $tag->updateTag($body['id'],$body);
        return $this->redierctTo('/dashboard/tag');
    }
    public function deletedTad(Request $request){
        $tag=new TagModel;
        $tag->deleteTagById($request->body()['id']);
        return $this->redierctTo('/dashboard/tag');    
    }
}