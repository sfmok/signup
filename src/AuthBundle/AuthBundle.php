<?php

namespace App\AuthBundle;

use Core\Router;
use App\AuthBundle\Controllers\SignupController;

class AuthBundle
{
    public function __construct(Router $router)
    {
        $router->add('/', ['controller' => SignupController::class, 'action' => 'index'], 'signup.index', ['GET']);
        $router->add('/signup', ['controller' => SignupController::class, 'action' => 'new'], 'signup.new', ['GET', 'POST']);
        $router->add('/signup/create', ['controller' => SignupController::class, 'action' => 'create'], 'signup.create', ['POST']);
        $router->add('/signup/confirmed', ['controller' => SignupController::class, 'action' => 'confirmed'], 'signup.confirmed', ['GET']);
        $router->add('/signup/ajax-save-step', ['controller' => SignupController::class, 'action' => 'ajaxSaveStep'], 'signup.ajax_save_step', ['POST']);
    }
}
