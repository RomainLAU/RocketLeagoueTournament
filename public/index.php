<?php

require_once __DIR__ . '/../vendor/autoload.php';

session_start();

$router = new \Bramus\Router\Router();

$router->before('GET', '/admin', function() {
    if (!(isset($_SESSION['user']))) {
        header('location: /login');
        exit();
    }
});

$router->before('GET', '/register', function() {
    if (isset($_SESSION['user'])) {
        header('location: /');
        exit();
    }
});

$router->before('GET', '/login', function() {
    if (isset($_SESSION['user'])) {
        header('location: /');
        exit();
    }
});

$router->before('GET', '/createTournament', function() {
    if (!isset($_SESSION['user'])) {
        header('location: /login');
        exit();
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

$router->get('/listTournament', 'Mvc\Controller\TournamentController@listTournament');
$router->post('/listTournament', 'Mvc\Controller\TournamentController@listTournament');

$router->get('/deconnection', function() {
    session_destroy();
    header('location: /login');
});

$router->run();

?>