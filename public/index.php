<?php

require_once __DIR__ . '/../vendor/autoload.php';
session_start();


$router = new \Bramus\Router\Router();

$router->before('GET', '/admin', function() {
    if (!(isset($_SESSION['user']))) {
        header('location: /login');
    }
});

$router->before('GET', '/register', function() {
    if (!(isset($_SESSION['user']))) {
        header('location: /login');
    }
});

$router->get('/', function () {
    echo "Accueil";
});

$router->get('/register', 'Mvc\Controller\UserController@register');
$router->post('/register', 'Mvc\Controller\UserController@register');

$router->get('/login', 'Mvc\Controller\UserController@login');
$router->post('/login', 'Mvc\Controller\UserController@login');

$router->get('/deconnection', function() {
    session_destroy();
    header('location: /');
});

$router->run();

?>