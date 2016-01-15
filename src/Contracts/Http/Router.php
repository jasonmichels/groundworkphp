<?php namespace GroundworkPHP\Framework\Contracts\Http;

use GroundworkPHP\Framework\Http\RouteRequest;
use GroundworkPHP\Framework\Contracts\Exceptions\MethodNotAllowed;
use GroundworkPHP\Framework\Contracts\Exceptions\NotFound;

/**
 * Interface Router
 *
 * Interface for application router
 *
 * @package GroundworkPHP\Framework\Contracts\Http
 * @author Jason Michels <michelsja@gmail.com>
 * @version $Id$
 */
interface Router
{
    const HTTP_REQUEST_POST = 'POST';
    const HTTP_REQUEST_GET = 'GET';

    /**
     * Append new route request to the collection
     *
     * @param RouteRequest $routeRequest
     * @return Router
     */
    public function append(RouteRequest $routeRequest);

    /**
     * Dispatch router
     *
     * @param string $requestUri
     * @param string $requestMethod
     * @param callable $callable
     * @return Router
     * @throws MethodNotAllowed
     * @throws NotFound
     */
    public function dispatch(string $requestUri, string $requestMethod, callable $callable);
}
