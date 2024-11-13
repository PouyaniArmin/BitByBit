<?php 
namespace App\Core;
use App\Utils\CsrfToken;

trait ValidatesRequests{
    public function validate(array $fields,array $data){
        $validation=new Vaildation();
        return $validation->validate($fields,$data);
    }
    public function validateCsrf($token){
        if (!CsrfToken::validateToken($token)) {
            return true;
        }
    }
}