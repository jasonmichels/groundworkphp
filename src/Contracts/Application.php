<?php namespace GroundworkPHP\Framework\Contracts;

use GroundworkPHP\Framework\Exceptions\NotFound;

/**
 * Interface Application
 *
 * @package GroundworkPHP\Framework\Contracts
 * @author Jason Michels <michelsja@gmail.com>
 * @version $Id$
 */
interface Application
{
    /**
     * Create a post request listener
     *
     * @param string $route
     * @param callable $callable
     * @return Application
     */
    public function post(string $route, callable $callable);

    /**
     * New GET request listener
     *
     * @param string $route
     * @param callable $callable
     * @return Application
     */
    public function get(string $route, callable $callable);

    /**
     * Run the application and match routes to the requested uri
     *
     * @return $this
     * @throws NotFound
     */
    public function run();
}
