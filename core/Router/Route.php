<?php

namespace Core\Router;

class Route
{
    /**
     * @var string
     */
    private $name;

    /**
     * @var callable|string
     */
    private $callback;

    /**
     * @var array
     */
    private $params;


    /**
     * Route constructor.
     * @param string $name
     * @param MiddlewareRoute $middlewareRoute
     * @param array $params
     */
    public function __construct(string $name, MiddlewareRoute $middlewareRoute, array $params)
    {
        $this->name = $name;
        $this->callback = $middlewareRoute->getCallback();
        $this->params = $params;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return callable|string
     */
    public function getCallback()
    {
        return $this->callback;
    }

    /**
     * @return array
     */
    public function getParams(): array
    {
        return $this->params;
    }
}