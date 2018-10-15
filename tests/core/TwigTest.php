<?php
/**
 * Created by PhpStorm.
 * User: mokhtar
 * Date: 10/15/18
 * Time: 12:53 PM
 */

namespace Tests\core;

use PHPUnit\Framework\TestCase;
use Core\Twig;

class TwigTest extends TestCase
{
    private $twig;

    public function setUp()
    {
        $this->twig = new Twig();

    }

    public function testRender()
    {
        $content = $this->twig->render('signup/index.html.twig');
        $this->assertContains('<h1>Welcome</h1>', $content);

    }
}
