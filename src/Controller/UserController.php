<?php

require_once __DIR__ . '/../Model/User.php';

class UserController
{
    public function listUser()
    {
        $userModel = new User();
        $users = $userModel->findAll();
        require_once __DIR__.'/../View/user/users.php';
    }
}