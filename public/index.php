<?php
// Habilitar la visualización de errores
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Configurar cookies de sesión seguras
ini_set('session.cookie_httponly', 1);
ini_set('session.cookie_secure', 1);
ini_set('session.use_strict_mode', 1);

session_start();

// Prevenir el secuestro de sesiones
if (!isset($_SESSION['initiated'])) {
    session_regenerate_id(true);
    $_SESSION['initiated'] = true;
}

require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/../src/core/Router.php';
require_once __DIR__ . '/../src/core/Database.php';
require_once __DIR__ . '/../src/helpers/csrf.php';
require_once __DIR__ . '/../src/helpers/sanitize.php';
require_once __DIR__ . '/../src/controllers/UserController.php';
require_once __DIR__ . '/../src/controllers/SiteController.php';
require_once __DIR__ . '/../src/models/User.php';
require_once __DIR__ . '/../src/models/Site.php';

$router = new Router();

$router->addRoute('GET', '/', function() {
    echo 'Welcome to Web Monitoring App<br>';
});

$router->addRoute('GET', '/register', [new UserController(), 'register']);
$router->addRoute('POST', '/register', [new UserController(), 'register']);
$router->addRoute('GET', '/login', [new UserController(), 'login']);
$router->addRoute('POST', '/login', [new UserController(), 'login']);
$router->addRoute('GET', '/dashboard', [new UserController(), 'dashboard']);
$router->addRoute('GET', '/add-site', [new SiteController(), 'add']);
$router->addRoute('POST', '/add-site', [new SiteController(), 'add']);
$router->addRoute('GET', '/list-sites', [new SiteController(), 'list']);
$router->addRoute('POST', '/delete-site', [new SiteController(), 'delete']);
$router->addRoute('GET', '/view-site/:id', [new SiteController(), 'view']);

$router->run();
?>
