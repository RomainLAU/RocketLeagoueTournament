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

$router->before('GET', '/buyToken', function() {
    if (!isset($_SESSION['user'])) {
        header('location: /login');
        exit();
    }
});
$router->before('GET', '/listTournament', function() {
    if (!isset($_SESSION['user'])) {
        header('location: /login');
        exit();
    }
});
$router->before('GET', '/delete', function() {
    if (isset($_SESSION['user'])) {
        header('location: /');
        exit();
    }
});
$router->before('GET', '/delete', function() {
    if (!isset($_SESSION['user'])) {
        header('location: /login');
        exit();
    }
});
$router->before('GET', '/join', function() {
    if (isset($_SESSION['user'])) {
        header('location: /');
        exit();
    }
});
$router->before('GET', '/join', function() {
    if (!isset($_SESSION['user'])) {
        header('location: /login');
        exit();
    }
});
$router->before('GET', '/addPlayer', function() {
    if (isset($_SESSION['user'])) {
        header('location: /');
        exit();
    }
});
$router->before('GET', '/addPlayer', function() {
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

$router->get('/buyToken', 'Mvc\Controller\UserController@buyToken');
$router->post('/buyToken', 'Mvc\Controller\UserController@buyToken');

$router->mount('/listTournament', function() use ($router) {

    $router->get('/', 'Mvc\Controller\TournamentController@listTournament');

    $router->post('/', 'Mvc\Controller\TournamentController@listTournament');

    $router->post('/', 'Mvc\Controller\TournamentController@listUser');

    $router->get('/(\d+)', 'Mvc\Controller\TournamentController@showDetails');

    $router->post('/delete', 'Mvc\Controller\TournamentController@deleteTournament');

    $router->post('/join', 'Mvc\Controller\TournamentController@joinTournament');

    $router->post('/addPlayer', 'Mvc\Controller\TournamentController@addPlayerTournament');
});


$router->get('/deconnection', function() {
    session_destroy();
    header('location: /login');
});

$router->run();

?>