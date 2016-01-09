<?php namespace GroundworkPHP\Http;

/**
 * Class RouteRequest
 *
 * An instance of a route
 *
 * @package GroundworkPHP\Http
 * @author Jason Michels <michelsja@gmail.com>
 * @version $Id$
 */
class RouteRequest
{
    /**
     * @var string
     */
    public $route;

    /**
     * @var callable
     */
    public $callable;

    /**
     * @var string
     */
    public $method;

    /**
     * RouteRequest constructor.
     * @param string $route
     * @param callable $callable
     * @param string $method
     */
    public function __construct(string $route, callable $callable, string $method)
    {
        $this->route = $route;
        $this->callable = $callable;
        $this->method = $method;
    }
}
