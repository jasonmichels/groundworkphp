<?php namespace Groundwork;

use Groundwork\Contracts\Application;
use Groundwork\Http\RouteRequest;
use Groundwork\Http\Router;
use Symfony\Component\HttpFoundation\JsonResponse;

/**
 * Class App
 *
 * Groundwork application
 *
 * @package Groundwork
 * @author Jason Michels <michelsja@gmail.com>
 * @version $Id$
 */
class App implements Application
{
    const HTTP_REQUEST_POST = 'POST';
    const HTTP_REQUEST_GET = 'GET';

    /**
     * @var string
     */
    protected $requestUri;

    /**
     * @var string
     */
    protected $requestMethod;

    /**
     * @var Router
     */
    protected $router;

    /**
     * App constructor.
     *
     * @param $requestUri
     * @param $requestMethod
     * @param Router $router
     */
    public function __construct(string $requestUri, string $requestMethod, Router $router)
    {
        $this->requestUri = $requestUri;
        $this->requestMethod = $requestMethod;
        $this->router = $router;
    }

    /**
     * Create a post request listener
     *
     * @param string $route
     * @param callable $callable
     * @return $this
     */
    public function post(string $route, callable $callable)
    {
        $this->appendRouteRequest($route, $callable, self::HTTP_REQUEST_POST);
        return $this;
    }

    /**
     * New GET request listener
     *
     * @param string $route
     * @param callable $callable
     * @return $this
     */
    public function get(string $route, callable $callable)
    {
        $this->appendRouteRequest($route, $callable, self::HTTP_REQUEST_GET);
        return $this;
    }

    /**
     * Append a new route request
     *
     * @param string $route
     * @param callable $callable
     * @param string $method
     * @return $this
     */
    protected function appendRouteRequest(string $route, callable $callable, string $method)
    {
        $requestRoute = new RouteRequest($route, $callable, $method);
        $this->router->append($requestRoute);
        return $this;
    }

    /**
     * Run the application and match routes to the requested uri
     *
     * @return $this
     * @throws Exceptions\NotFound
     */
    public function run()
    {
        $response = new JsonResponse();

        $this->router->match(
            $this->requestUri,
            $this->requestMethod,
            function (RouteRequest $routeRequest) use ($response) {
                $response = call_user_func($routeRequest->callable, $response);
                $response->send();
            }
        );

        return $this;
    }
}
