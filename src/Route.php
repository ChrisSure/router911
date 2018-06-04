<?php

namespace Snayper911_Router;


class Route
{
	
	//Метод маршруту
	public $method;

	//Шлях маршруту
	public $path;

	//Контроллер, кий обробляє маршрут
	public $controller;

	//Метод контроллера, який обробляє маршрут
	public $action;

	//Ім'я маршруту
	public $name;


	/**
    * Конструктор встановлює метод, шлях, контроллер та ім'я маршрута
    *
    * @param String $method
    * @param String $path
    * @param $controller
    * @param String $action
    * @param String $name
    *
    * @return void
    */
	public function __construct(array $method, String $path, $controller, String $action, String $name)
	{
		$this->method = $method;
		$this->path = $path;
		$this->controller = $controller;
		$this->action = $action;
		$this->name = $name;
	}
	
	
}