<?php

namespace Askedio\LaravelRatchet;

use Illuminate\Support\Collection;
use Symfony\Component\Routing\Route;
use Symfony\Component\Routing\RouteCollection;
//use Ratchet\WebSocket\WsServer;
use Askedio\LaravelRatchet\BroadcastableWsServer;
use Ratchet\WebSocket\MessageComponentInterface;

class RatchetRouteHandler
{

	protected $routes;

	public function __construct()
	{
	    $this->routes = new RouteCollection();
	}

	public function getRoutes(): RouteCollection
    {
        return $this->routes;
    }
	
    public function get(string $uri, $action)
    {
        $this->addRoute('GET', $uri, $action);
    }

    public function webSocket(string $uri, $action)
    {
        if (! is_subclass_of($action, MessageComponentInterface::class)) 
        {
            throw new \Exception("{action} must be of type ".MessageComponentInterface::class);
        }

        $this->get($uri, $action);
    }

    protected function getRoute(string $method, string $uri, $action): Route
    {
        if(is_subclass_of($action, MessageComponentInterface::class))
        {
            $action = $this->createWebSocketsServer($action);
        }
        else
        {
            throw new \Exception("{action} must be of type ".MessageComponentInterface::class);
        }

        return new Route($uri, ['_controller' => $action], [], [], null, [], [$method]);
    }

    public function addRoute(string $method, string $uri, $action)
    {
        $this->routes->add($uri, $this->getRoute($method, $uri, $action));
    }

    protected function createWebSocketsServer(string $action): BroadcastableWsServer
    {
        $app = app($action);

        return new BroadcastableWsServer($app);
    }
}