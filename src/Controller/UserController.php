<?php

namespace RocketLeagoueTournament\controller;

require_once __DIR__ . '/../Model/User.php';

use Config\Controller;
use RocketLeagoueTournament\model\User;



class UserController
{
    public function listUser()
    {
        $userModel = new User();
        $users = $userModel->findAll();
        require_once __DIR__.'/../View/user/users.php';
    }
}