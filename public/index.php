<?php

require __DIR__ . '/../vendor/autoload.php';

require_once __DIR__ . '/../core/Router.php';

$router = new Router();

require __DIR__ . '/../routes/web.php';

$router->dispatch($_SERVER['REQUEST_URI']);
