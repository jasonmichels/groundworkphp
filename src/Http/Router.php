<?php namespace Groundwork\Http;

use Groundwork\Exceptions\NotFound;

/**
 * Class Router
 *
 * Router will match routes
 *
 * @package Groundwork\Http
 * @author Jason Michels <michelsja@gmail.com>
 * @version $Id$
 */
class Router
{
    /**
     * Route request collection
     *
     * @var array
     */
    protected $routeRequestCollection = [];

    /**
     * Append new route request to the collection
     *
     * @param RouteRequest $routeRequest
     * @return $this
     */
    public function append(RouteRequest $routeRequest)
    {
        $this->routeRequestCollection[] = $routeRequest;
        return $this;
    }

    /**
     * Loop through route request collection
     *
     * @param callable $callable
     * @return $this
     */
    public function each(callable $callable)
    {
        foreach ($this->routeRequestCollection as $routeRequest) {
            call_user_func($callable, $routeRequest);
        }
        return $this;
    }

    /**
     * Match a request to a route request
     *
     * @param string $requestUri
     * @param string $requestMethod
     * @param callable $callable
     * @return $this
     * @throws NotFound
     */
    public function match(string $requestUri, string $requestMethod, callable $callable)
    {
        $match = false;

        $this->each(function (RouteRequest $routeRequest) use ($requestUri, $requestMethod, $callable, &$match)  {

            if ($routeRequest->match($requestUri, $requestMethod)) {
                call_user_func($callable, $routeRequest);
                $match = true;
            }

        });

        if (!$match) {
            throw new NotFound('Unable to match request for route ' . $requestUri . ' and method: ' . $requestMethod);
        }
        return $this;
    }
}
