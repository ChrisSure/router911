<?php

namespace Tests\Src;

use PHPUnit\Framework\TestCase;
use Snayper911_Router\RouteCollection;
use Snayper911_Router\Router;
use Snayper911_Http\Request;
use Snayper911_Http\RequestFactory;
use App\Controllers\PageController;
use Snayper911_Router\Exception\NotCountParamException;



class RouterTest extends TestCase
{
  
    /**
    * Тест перевіряє метод Router::match
    *
    * @return void
    */
    public function testMatch(): void
    {
        $request_params = new RequestFactory();
        $request_params->server['REQUEST_URI'] = '/pages'; //Встановлюємо вручну маршрут
        $request_params->server['REQUEST_METHOD'] = 'GET'; //Встановлюємо вручну метод маршруту
        $request = new Request($request_params);
        $route = new RouteCollection();
        $route->get($path = 'pages', $class = PageController::class, $action = 'all', $name = 'pages');
        $router = new Router($route);
        $result = $router->match($request);

        self::assertTrue(in_array('GET', $route->getRoutes()[0]->method));
        self::assertEquals($path, $result->getPath());
        self::assertEquals($class, $result->getController());
        self::assertEquals($action, $result->getAction());
        self::assertEquals($name, $result->getName());
    }


    /**
    * Тест перевіряє метод Router::match на некоректність
    *
    * @return void
    */
    public function testIncorectMatch(): void
    {
        $request_params = new RequestFactory();
        $request_params->server['REQUEST_URI'] = '/pagess'; //Встановлюємо вручну маршрут
        $request_params->server['REQUEST_METHOD'] = 'GET'; //Встановлюємо вручну метод маршруту
        $request = new Request($request_params);
        $route = new RouteCollection();
        $route->get($path = 'page', $class = PageController::class, $action = 'all', $name = 'page');
        $router = new Router($route);
        $result = $router->match($request);
        self::assertTrue(is_null($result));
    }


    /**
    * Тест перевіряє метод Router::match на некоректність (невірна кількість параметрів)
    *
    * @expectedException Snayper911_Router\Exception\NotCountParamException
    * @expectedExceptionMessage Кількість параметрів в маршруті неспівпадає
    *
    * @return void
    */
    public function testIncorectCountMatch(): void
    {
        $request_params = new RequestFactory();
        $request_params->server['REQUEST_URI'] = '/page'; //Встановлюємо вручну маршрут
        $request_params->server['REQUEST_METHOD'] = 'GET'; //Встановлюємо вручну метод маршруту
        $request = new Request($request_params);
        $route = new RouteCollection();
        $route->get($path = 'page/{id}', $class = PageController::class, $action = 'all', $name = 'page');
        $router = new Router($route);
        $result = $router->match($request);
    }
    

}