<?php namespace GroundworkPHP\Framework;

use GroundworkPHP\Framework\Contracts\Application;
use GroundworkPHP\Framework\Http\RouteRequest;
use GroundworkPHP\Framework\Http\Router;
use Symfony\Component\HttpFoundation\JsonResponse;

/**
 * Class App
 *
 * Groundwork application
 *
 * @package GroundworkPHP\Framework
 * @author Jason Michels <michelsja@gmail.com>
 * @version $Id$
 */
class App implements Application
{
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
        $this->appendRouteRequest($route, $callable, Router::HTTP_REQUEST_POST);
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
        $this->appendRouteRequest($route, $callable, Router::HTTP_REQUEST_GET);
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

        $this->router->dispatch(
            $this->requestUri,
            $this->requestMethod,
            function (callable $callable, array $args = []) use ($response) {
                $response = call_user_func_array($callable, [$response, $args]);
                $response->send();
        });

        return $this;
    }
}
