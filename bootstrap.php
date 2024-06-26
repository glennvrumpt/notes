<?php

use App\Core\App;
use App\Core\Container;
use App\Core\Database;

$container = new Container();

$container->bind('Core\Database', function (): Database {
    $config = require base_path('config.php');

    return new Database($config['database']);
});

$db = $container->resolve('Core\Database');

App::setContainer($container);
