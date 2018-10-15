<?php

namespace Core;

use Core\Session\Session;

class Twig
{
    private $twig;

    private $loader;

    public function __construct(Session $session)
    {
        $this->loader = new \Twig_Loader_Filesystem(dirname(__DIR__) . '/views');
        $this->twig = new \Twig_Environment($this->loader, []);
        $this->addGlobal('session', $session);
    }

    /**
     * Render a view template using Twig
     *
     * @param string $view  The template file
     * @param array $args  Associative array of data to display in the view (optional)
     *
     * @return string
     */
    public function render($view, $args = [])
    {
        return $this->twig->render($view, $args);
    }


    /**
     * @param string $key
     * @param mixed $value
     * @return mixed
     */
    public function addGlobal(string $key, $value)
    {
        $this->twig->addGlobal($key, $value);
    }
}
