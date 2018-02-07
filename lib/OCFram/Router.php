<?php

namespace OCFrams;

/**
 * Class Router
 * @package App
 */
class Router
{
    /**
     * @var Request
     */
    private $request;

    /**
     * @var array
     */
    private $routes = [];

    /**
     * Router constructor
     * @param Request $request
     */
    public function __construct($request)
    {
        $this->request = $request;
    }

    /**
     * @param Route $route
     * @throws \Exception
     */
    public function add(Route $route)
    {
        if (isset($this->routes[$route->getName()])) {
            throw new \Exception("La route existe déjà !");
        }
        $this->routes[$route->getName()] = $route;
    }

    /**
     * @return Route
     */
    public function match() 
    {
        $routes = array_filter($this->routes, function(Route $route) {
            return $route->match($this->request->getUri());
        });
        return count($routes) ? array_shift($routes) : null;
    }
}