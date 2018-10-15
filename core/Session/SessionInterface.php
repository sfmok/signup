<?php

namespace Core\Session;

interface SessionInterface
{
    /**
     * Start session
     */
    public function start();

    /**
     * Check if key exists in session
     * @param string $key
     * @return bool
     */
    public function has(string $key): bool;

    /**
     * @param string $key
     * @param mixed $value
     */
    public function set(string $key, $value): void;

    /**
     * @param string $key
     * @param mixed $default
     * @return mixed
     */
    public function get(string $key, $default = null);

    /**
     * Destroy session
     */
    public function destroy();

    /**
     * Remove item from session
     * @param string $key
     */
    public function remove(string $key): void;

    /**
     * Clear session
     */
    public function clear();
}