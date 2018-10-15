<?php

namespace Core;

abstract class Controller
{
    /**
     * Redirect to a different page
     *
     * @param string $url  The relative URL
     *
     * @return void
     */
    public function redirect($url): void
    {
        header('Location: http://' . $_SERVER['HTTP_HOST'] . $url, true, 303);
        exit;
    }
}
