<?php

const BASE_PATH = __DIR__ . '/../';

require BASE_PATH . 'app/Core/functions.php';

spl_autoload_register(function($class){
    require base_path($class . '.php');
});

require base_path('bootstrap.php');

$router = new \App\Core\Router();

$routes = require base_path('routes.php');
$uri = parse_url($_SERVER['REQUEST_URI'])['path'];
$method = $_SERVER['REQUEST_METHOD'];

$baseDir = str_replace('\\', '/', dirname($_SERVER['SCRIPT_NAME']));
if (strpos($uri, $baseDir) === 0) {
    $uri = substr($uri, strlen($baseDir));
}

$uri = $uri ?: '/';

$router->dispatch($uri, $method);
