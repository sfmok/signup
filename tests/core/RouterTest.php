<?php

namespace Tests\Core;

use Core\Router;
use GuzzleHttp\Psr7\ServerRequest;
use PHPUnit\Framework\TestCase;

class RouterTest extends TestCase
{
    /**
     * @var Router
     */
    private $router;


    public function setUp()
    {
        $this->router = new Router();
    }

    public function testGetMethod()
    {
        $request = new ServerRequest('GET', '/test');
        $this->router->add('/test', function () { return "TEST"; }, 'test');
        $route = $this->router->match($request);
        $this->assertEquals('test', $route->getName());
        $this->assertEquals('TEST', call_user_func_array($route->getCallback(), [$request]));
    }

    public function testGetMethodIfUrlDoesNotExits()
    {
        $request = new ServerRequest('GET', '/test');
        $this->router->add('/tttt', function () { return "TEST"; }, 'test');
        $route = $this->router->match($request);
        $this->assertEquals(null, $route);
    }

    public function testGetMethodWithParams()
    {
        $request = new ServerRequest('GET', '/blog/my-post-8');
        $this->router->add('/blog/{slug:[a-z0-9\-]+}-{id:\d+}', function () { return "Hello"; }, 'post.show');
        $route = $this->router->match($request);
        $this->assertEquals('post.show', $route->getName());
        $this->assertEquals('Hello', call_user_func_array($route->getCallback(), [$request]));
        $this->assertEquals(['slug' => 'my-post', 'id' => '8'], $route->getParams());
    }

    public function testGenerateUri()
    {
        $this->router->add('/blog/{slug:[a-z0-9\-]+}-{id:\d+}', function () { return "Hello"; }, 'post.show');
        $uri = $this->router->generateUri('post.show', ['slug' => 'my-post', 'id' => '2']);
        $this->assertEquals('/blog/my-post-2', $uri);
    }
}
