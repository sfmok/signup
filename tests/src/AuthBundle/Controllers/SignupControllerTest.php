<?php

namespace Tests\App\AuthBundle\Controllers;

use App\AuthBundle\Controllers\SignupController;
use App\AuthBundle\Manager\UserManager;
use Core\Session\Session;
use Core\Twig;
use GuzzleHttp\Psr7\ServerRequest;
use PHPUnit\Framework\TestCase;

class SignupControllerTest extends TestCase
{
    private $signupController;

    private $twig;

    private $session;

    private $userManager;

    public function setUp()
    {
        $this->session = new Session();
        $this->userManager = new UserManager();
        $this->twig = new Twig($this->session);

        $this->signupController = new SignupController(
            $this->session,
            $this->userManager,
            $this->twig
        );
    }

    public function testIndex()
    {
        $request = new ServerRequest('GET', '/');
        $response = call_user_func_array([$this->signupController, 'index'], [$request]);

        $this->assertContains('<h1>Welcome</h1>', $response);
    }

    public function testNew()
    {
        $request = new ServerRequest('GET', '/');
        $response = call_user_func_array([$this->signupController, 'new'], [$request]);

        $this->assertContains('<h3>Personal Details</h3>', $response);
        $this->assertContains('<h3>Your Address</h3>', $response);
        $this->assertContains('<h3>Payment Details</h3>', $response);
    }
}
