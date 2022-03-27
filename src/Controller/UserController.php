<?php
namespace RocketLeagoueTournament\controller;
require_once __DIR__ . '/../model/User.php';

use Config\Controller;
use RocketLeagoueTournament\model\User;



class UserController
{
    public function listUser()
    {
        $userModel = new User();
        $users = $userModel->findAll();
        require_once __DIR__.'/../view/user/users.php';
    }
}