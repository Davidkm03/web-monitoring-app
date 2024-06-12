<?php

session_start();

require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/../src/core/Router.php';
require_once __DIR__ . '/../src/core/Database.php';
require_once __DIR__ . '/../src/controllers/UserController.php';
require_once __DIR__ . '/../src/models/User.php';

$router = new Router();

$router->addRoute('GET', '/', function() {
    echo 'Welcome to Web Monitoring App<br>';
});

$router->addRoute('GET', '/register', [new UserController(), 'register']);
$router->addRoute('POST', '/register', [new UserController(), 'register']);
$router->addRoute('GET', '/login', [new UserController(), 'login']);
$router->addRoute('POST', '/login', [new UserController(), 'login']);

$router->run();
