<?php

namespace Core;

use Core\Router\MiddlewareRoute;
use Core\Router\Route;
use Psr\Http\Message\ServerRequestInterface;
use Zend\Expressive\Router\FastRouteRouter;
use Zend\Expressive\Router\Route as ZRoute;

class Router
{
    /**
     * @var FastRouteRouter
     */
    private $router;


    /**
     * Router constructor.
     */
    public function __construct()
    {
        $this->router = new FastRouteRouter();
    }

    /**
     * @param string $path
     * @param callable|string $callable
     * @param string $name
     * @param null|array $methods
     */
    public function add(string $path, $callable, string $name, $methods = null)
    {
        $this->router->addRoute(new ZRoute($path, new MiddlewareRoute($callable), $methods, $name));
    }

    /**
     * @param ServerRequestInterface $request
     * @return Route|null
     */
    public function match(ServerRequestInterface $request): ?Route
    {
        $routeResult = $this->router->match($request);
        if ($routeResult->isSuccess()) {
            return new Route(
                $routeResult->getMatchedRouteName(),
                $routeResult->getMatchedRoute()->getMiddleware(),
                $routeResult->getMatchedParams()
            );
        }
        return null;
    }

    public function generateUri(string $name, array $params): ?string
    {
        return $this->router->generateUri($name, $params);
    }
}
