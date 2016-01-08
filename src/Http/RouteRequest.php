<?php namespace Groundwork\Http;

use Groundwork\Exceptions\MethodNotAllowed;

/**
 * Class RouteRequest
 *
 * An instance of a route the app will listen form and respond to
 *
 * @package Groundwork\Http
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

    /**
     * See if the requested uri and method matches the route
     *
     * @param string $requestUri
     * @param string $requestMethod
     * @return bool
     */
    public function match(string $requestUri, string $requestMethod)
    {
        $match = false;
        $this->matchRoute($requestUri, function () use ($requestMethod, &$match) {
            $match = $this->matchMethod($requestMethod);
        });

        return $match;
    }

    /**
     * Match the route to the requested uri
     *
     * @param string $requestUri
     * @param callable $callable
     * @return bool
     */
    protected function matchRoute(string $requestUri, callable $callable)
    {
        if ($requestUri == $this->route) {
            call_user_func($callable);
        }

        return false;
    }

    /**
     * Match the method to the requested method
     *
     * @param string $requestMethod
     * @return bool
     * @throws MethodNotAllowed
     */
    protected function matchMethod(string $requestMethod)
    {
        if ($requestMethod == $this->method) {
            return true;
        }
        throw new MethodNotAllowed($requestMethod . ' is not allowed for ' . htmlentities($this->route));
    }
}
