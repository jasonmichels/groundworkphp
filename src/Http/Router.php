<?php namespace GroundworkPHP\Framework\Http;

use GroundworkPHP\Framework\Exceptions\MethodNotAllowed;
use GroundworkPHP\Framework\Exceptions\NotFound;
use FastRoute;
use FastRoute\Dispatcher\GroupCountBased;

/**
 * Class Router
 *
 * Router will match routes
 *
 * @package GroundworkPHP\Framework\Http
 * @author Jason Michels <michelsja@gmail.com>
 * @version $Id$
 */
class Router
{
    const HTTP_REQUEST_POST = 'POST';
    const HTTP_REQUEST_GET = 'GET';

    /**
     * Route request collection
     *
     * @var array
     */
    protected $routeRequestCollection = [];

    /**
     * @var GroupCountBased
     */
    protected $dispatcher;

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
     * Register necessary routes with route provider
     */
    protected function registerRoutes()
    {
        $this->dispatcher = FastRoute\simpleDispatcher(function (FastRoute\RouteCollector $routeCollector) {

            $this->each(function (RouteRequest $routeRequest) use ($routeCollector) {
                $routeCollector->addRoute($routeRequest->method, $routeRequest->route, $routeRequest->callable);
            });

        });
    }

    /**
     * Dispatch router
     *
     * @param string $requestUri
     * @param string $requestMethod
     * @param callable $callable
     * @return $this
     * @throws MethodNotAllowed
     * @throws NotFound
     */
    public function dispatch(string $requestUri, string $requestMethod, callable $callable)
    {
        $this->registerRoutes();

        $routeInfo = $this->dispatcher->dispatch($requestMethod, $requestUri);
        switch ($routeInfo[0]) {
            case FastRoute\Dispatcher::NOT_FOUND:
                throw new NotFound('Unable to match request for route ' . $requestUri . ' and method: ' . $requestMethod);
                break;
            case FastRoute\Dispatcher::METHOD_NOT_ALLOWED:
                $allowedMethods = $routeInfo[1];
                throw new MethodNotAllowed($requestMethod . ' is not allowed for route', 0, null, $allowedMethods);
                break;
            case FastRoute\Dispatcher::FOUND:
                $handler = $routeInfo[1];
                $vars = $routeInfo[2];
                call_user_func_array($callable, [$handler, $vars]);
                break;
        }

        return $this;
    }
}
