<?php

namespace Core\Session;

class Session implements SessionInterface
{
    public function __construct()
    {
        ini_set('session.cookie_lifetime', 86400);
        ini_set('session.gc_maxlifetime', 86400);
    }

    /**
     * Start session
     */
    public function start()
    {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
    }

    /**
     * @param string $key
     * @param $value
     */
    public function set(string $key, $value): void
    {
        $this->start();
        $_SESSION[$key] = $value;
    }

    /**
     * @param string $key
     * @param $default
     * @return mixed
     */
    public function get(string $key, $default = null)
    {
        $this->start();
        if (array_key_exists($key, $_SESSION)) {
            return $_SESSION[$key];
        }
        return $default;
    }

    /**
     * Destroy session
     */
    public function destroy()
    {
        if (session_status() == PHP_SESSION_ACTIVE) {
            session_destroy();
        }
    }

    /**
     * Remove item from session
     * @param string $key
     */
    public function remove(string $key): void
    {
        $this->start();
        if (array_key_exists($key, $_SESSION)) {
            unset($_SESSION[$key]);
        }
    }

    /**
     * Clear session
     */
    public function clear()
    {
        $this->start();
        unset($_SESSION);
    }

    /**
     * Check if key exists in session
     * @param string $key
     * @return bool
     */
    public function has(string $key): bool
    {
        $this->start();
        return array_key_exists($key, $_SESSION) ? true : false;
    }
}
