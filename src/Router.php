<?php

namespace Snayper911_Router;

use Snayper911_Http\Interfaces\RequestInterface;
use Snayper911_Router\Exception\NotCountParamException;



class Router
{
	
	//Массив запонених маршрутів
	private $routes;


	/**
  	* Конструктор встановлює массив заповнених маршрутів
  	*
  	* @param RouteCollection $routes
  	*
  	* @return void
  	*/
	public function __construct(RouteCollection $routes)
	{
		$this->routes = $routes;
	}

	/**
    * Метод парсить url та перевіряє який маршрут задіяти, якщо знайдено співпадіння повертає об'єкт Result
    *
    * @param Reques $request
    *
    * @return Result
    */
	public function match(RequestInterface $request)
	{
		$uri = explode('?', $request->getAllServer()['REQUEST_URI']);
		$uri_first = explode('/', $uri[0]);

		foreach ($this->routes->getRoutes() as $route) {
			if (!in_array($request->getAllServer()['REQUEST_METHOD'], $route->method)) {
               continue;
        	}
			$path = explode('/', $route->path);
			if ($uri_first[1] === $path[0]) {
				$this->setAttribute($request, $uri_first, $route->path);
				return new Result($route->method, $route->path, $route->controller, $route->action, $route->name);
			}
		}
		
	}


	/**
	* Метод повертає массив аттрибутів 
	* 
	* @param Request $request
	* @param array $uri
	* @param String $path
	* @throws NotCountParamException
	*
	* @return array
	*/
	private function setAttribute(RequestInterface $request, array $uri, String $path): array
	{
		
		foreach($uri as $key => $value) {
			if ($key == 0 || $key == 1) continue;
			$attribute_arr[] = $value;
		}
		$exp = explode('/', $path);
		foreach($exp as $value) {
			if (preg_match('|{|', $value)) {
				$attribute_path[] = substr($value, 1, -1);
			}
		}

		if (count($attribute_arr) !== count($attribute_path)) {
			throw new NotCountParamException('Кількість параметрів в маршруті неспівпадає');
		}

		if ($attribute_path && $attribute_arr) {
			$attribute =  array_combine($attribute_path, $attribute_arr);
			//Занесення атрибутів (get) в Request 
			foreach($attribute as $attribute => $value) {
				$request->setAttribute($attribute, $value);
			}
		}
		return [];
	}
	
	
}