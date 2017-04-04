<?php

namespace App\Controllers;

use \Core\View;

/**
 * Home controller
 *
 * PHP version 7.0
 */
class Home extends \Core\Controller
{

    /**
     * Show the index page
     *
     * @return void
     */
    public function indexAction()
    {
//        View::renderTemplate('Home/index.html', [
//            'user' => Auth::getUser()
//        ]); moved as global twig variable
//        \App\Mail::send('alexandruiuliancucu@yahoo.es', 'Test', 'This is a test', '<h1>This is a test</h1>');
        View::renderTemplate('Home/index.html');
    }
}
