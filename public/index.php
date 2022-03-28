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
    if (isset($_SESSION['user'])) {
        header('location: /login');
    }
});

$router->before('GET', '/', function() {
    if (isset($_SESSION['user'])) {
        header('location: /userConnected');
    } else if (isset($_SESSION['admin'])) {
        header('location: /adminConnected');
    } else {
        header('location: /');
    }
});


$router->before('GET', '/createTournament', function() {
    if (!isset($_SESSION['user'])) {
        header('location: /login');
    }else {
        header('location: /createTournament');
    }
});



$router->get('/', 'Mvc\Controller\AccueilController@displayAccueil');
$router->get('/userConnected', 'Mvc\Controller\AccueilController@displayAccueilUserConnected');
$router->get('/adminConnected', 'Mvc\Controller\AccueilController@displayAccueilAdminConnected');

$router->get('/register', 'Mvc\Controller\UserController@register');
$router->post('/register', 'Mvc\Controller\UserController@register');

$router->get('/login', 'Mvc\Controller\UserController@login');
$router->post('/login', 'Mvc\Controller\UserController@login');

$router->get('/createTournament', 'Mvc\Controller\TournamentController@createTournament');
$router->post('/createTournament', 'Mvc\Controller\TournamentController@createTournament');

$router->get('/deconnection', function() {
    session_destroy();
    header('location: /');
});

$router->run();

?>