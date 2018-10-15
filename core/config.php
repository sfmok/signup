<?php

use Core\Router;
use Core\Session\Session;
use App\AuthBundle\Api\Api;
use App\AuthBundle\Manager\UserManager;
use Core\Twig;

return [
    Router::class => \DI\create(),
    Session::class => \DI\create(),
    Twig::class => \DI\create()->constructor(\DI\get(Session::class)),
    Api::class => \DI\create(),
    UserManager::class => \DI\create(),
];