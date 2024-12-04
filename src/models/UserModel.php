<?php

namespace App\Models;

use App\Core\Model;

class UserModel extends Model
{
    public function getAllUser()
    {
        return $this->getAll('users');
    }
    public function createUser(array $data)
    {
        return $this->create('users', $data);
    }
    public function getUserById($id)
    {
        return $this->getById('users', $id);
    }
    public function updateUser($id, $data)
    {
        return $this->updateById('users', $id, $data);
    }
    public function deleteUserById($id)
    {
        return $this->deleteById('users', intval($id));
    }
    public function getUserByEmail($email)
    {
        
        return array_merge($this->getBy('users', 'email', $email), $this->getUserRoleByEmail($email));
    }
    public function getByEmial($email){
        return $this->getBy('users', 'email', $email);
    }
    public function getUserAndRole()
    {
        return $this->getUsersWithRoles();
    }
    public function getUsersStatusCount(){
        return $this->getByStatus('users');
    }
}
