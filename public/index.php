<?php

require_once __DIR__ . '/../vendor/autoload.php';
session_start();


$router = new \Bramus\Router\Router();

// $router->get('/', 'Mvc\Controller\');
$router->get('/users', 'Mvc\Controller\UserController@listUser');

$router->run();





$router->run();

?>