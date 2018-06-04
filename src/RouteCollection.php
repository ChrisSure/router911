<?php

namespace Snayper911_Router;

use Snayper911_Router\Route;
use Snayper911_Router\Exception\NotRouteMethod;

class RouteCollection
{
	//Массив маршрутів
	private $routes = [];

	/**
    * Метод добавляє об'єкт Route в массив маршрутів
    *
    * @param Route $route
    *
    * @return void
    */
	private function addRoute(Route $route): void
	{
		$this->routes[] = $route;
	}

	/**
    * Метод встановлює маршрут типу get
    *
    * @param String $path
    * @param $controller
    * @param String $action
    * @param String $name
    *
    * @return void
    */
	public function get(String $path, $controller, String $action, String $name): void
	{
		$this->addRoute(new Route(['GET'], $path, $controller, $action, $name));
	}

	/**
    * Метод встановлює маршрут типу post
    *
    * @param String $path
    * @param $controller
    * @param String $action
    * @param String $name
    *
    * @return void
    */
	public function post(String $path, $controller, String $action, String $name): void
	{
		$this->addRoute(new Route(['POST'], $path, $controller, $action, $name));
	}

	/**
    * Метод встановлює маршрут типу any [GET, POST]
    *
    * @param String $path
    * @param $controller
    * @param String $action
    * @param String $name
    *
    * @return void
    */
	public function any(String $path, $controller, String $action, String $name): void
	{
		$this->addRoute(new Route(['POST', 'GET'], $path, $controller, $action, $name));
	}


	/**
    * Метод повертає массив маршрутів
    *
    * @return array
    */
	public function getRoutes(): array
	{
		return $this->routes;
	}


    /**
    * Метод спрацьовує коли введено неіснуючий метод
    *
    * @throws NotRouteMethod
    *
    * @return void
    */
    public function __call($name, $arguments): void
    {
        throw new NotRouteMethod('Даного метода для роутингу не існує');
    }
	
	
}