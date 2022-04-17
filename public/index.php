<?php
require_once __DIR__ . '/../vendor/autoload.php';

session_start();

$router = new \Bramus\Router\Router();

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

$router->before('GET', 'createTournament', function() {
    if (!isset($_SESSION) || $_SESSION['user']['role'] === 'user') {
        header('location: /');
        exit();
    }
});

$router->before('GET', '/buyToken', function() {
    if (!isset($_SESSION['user'])) {
        header('location: /login');
        exit();
    }
});

$router->before('GET', '/delete', function() {
    if (isset($_SESSION['user']) && $_SESSION['user']['role'] === 'user' ) {
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
    if (!isset($_SESSION['user'])) {
        header('location: /login');
        exit();
    }
});
$router->before('GET', '/addPlayer', function() {
    if (!isset($_SESSION['user']) || $_SESSION['user']['role'] === 'user') {
        header('location: /');
        exit();
    }
});

$router->before('GET', '/profile', function() {
    if (!isset($_SESSION['user'])) {
        header('location: /login');
        exit();
    }
});

$router->get('/profile', 'Mvc\Controller\ProfileController@displayProfile');

$router->before('GET', '/profile/buyHost', function() {
    if ($_SESSION['user']['role'] === 'admin' || $_SESSION['user']['role'] === 'host') {
        header('location: /profile');
        exit();
    }
});

$router->get('/profile/buyHost', 'Mvc\Controller\UserController@buyHost');

$router->get('/', 'Mvc\Controller\AccueilController@displayAccueil');

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

$router->mount('/listTournament/(\d+)', function() use ($router) {

    $router->get('/createMatch', 'Mvc\Controller\TournamentController@createMatch');
    
    $router->post('/createMatch', 'Mvc\Controller\TournamentController@createMatch');

    $router->get('/updateMatch/(\d+)', 'Mvc\Controller\TournamentController@updateMatch');

    $router->post('/updateMatch/(\d+)', 'Mvc\Controller\TournamentController@updateMatch');

    $router->get('/setWinner/(\d+)', 'Mvc\Controller\TournamentController@setWinner');
});

$router->get('/deconnection', function() {
    session_destroy();
    header('location: /');
});

$router->run();

?>