<?php

namespace Core;

class Controller
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
        exit(header('Location: http://' . $_SERVER['HTTP_HOST'] . $url, true, 303));
    }
}
