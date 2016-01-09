<?php namespace GroundworkPHP\Framework\Tests;

use GroundworkPHP\Framework\App;
use GroundworkPHP\Framework\Http\Router;
use GroundworkPHP\Framework\Tests\TestCase;
use \Mockery as mockery;
use GroundworkPHP\Framework\Contracts\Application;

/**
 * Class AppTest
 *
 * Tests for main application code
 *
 * @package GroundworkPHP\Tests
 * @author Jason Michels <michelsja@gmail.com>
 * @version $Id$
 */
class AppTest extends TestCase
{
    /**
     * Test the app returns the correct contract
     */
    public function testAppReturnsCorrectInstance()
    {
        $requestUri = "/";
        $requestMethod = "GET";
        $router = mockery::mock(Router::class);

        $app = new App($requestUri, $requestMethod, $router);

        $this->assertInstanceOf(Application::class, $app);
    }
}
