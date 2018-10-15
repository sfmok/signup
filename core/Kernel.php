<?php

namespace Core;


use GuzzleHttp\Psr7\Response;
use Psr\Container\ContainerInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class Kernel
{
    /**
     * List of bundles
     * @var array
     */
    private $bundles = [];

    /**
     * @var Router
     */
    private $router;

    /**
     * @var ContainerInterface
     */
    private $container;

    /**
     * Kernel constructor.
     * @param ContainerInterface $container
     * @param array $bundles
     */
    public function __construct(ContainerInterface $container, array $bundles = [])
    {
        $this->container = $container;
        $this->router = $container->get(Router::class);
        foreach ($bundles as $bundle) {
            $this->bundles[] = $container->get($bundle);
        }
    }

    public function run(ServerRequestInterface $request): ResponseInterface
    {
        $route = $this->router->match($request);

        if (is_null($route)) {
            return new Response(404, [], 'This route is not found');
        }

        $params = $route->getParams();
        $request = array_reduce(array_keys($params), function($request, $key) use ($params) {
            return $request->withAttribute($key, $params[$key]);
        }, $request);

        $callback = $route->getCallback();
        if(is_array($route->getCallback())){
            $response = call_user_func_array([$this->container->get($callback['controller']), $callback['action']], [$request]);
        } else {
            $response = call_user_func_array($route->getCallback(), [$request]);
        }

        if (is_string($response)) {

            return new Response(200, [], $response);

        } elseif ($response instanceof ResponseInterface) {

            return$response;

        } else {

            throw new \Exception('The response is not string or response interface');
        }
    }
}