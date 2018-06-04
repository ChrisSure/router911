<?php

namespace Snayper911_Router\Interfaces;

use Snayper911_Router\Result;


interface RouterInterface
{

	/**
  	* Конструктор встановлює массив заповнених маршрутів
  	*
  	* @param RouteCollection $routes
  	*
  	* @return void
  	*/
	public function __construct(RouteCollection $routes);


	/**
    * Метод парсить url та перевіряє який маршрут задіяти, якщо знайдено співпадіння повертає об'єкт Result
    *
    * @param Reques $request
    *
    * @return Result
    */
	public function match(Request $request): Result;


	

}