<?php

namespace Tests\Src;

use PHPUnit\Framework\TestCase;
use Snayper911_Router\RouteCollection;
use App\Controllers\PageController;



class RouterCollectionTest extends TestCase
{
  
    /**
    * Тест перевіряє правильність роботи метода get()
    *
    * @return void
    */
    public function testCollectionGet(): void
    {
        $route = new RouteCollection();
        $route->get($path = 'page', PageController::class, 'view', 'pageOne');

        self::assertTrue(count($route->getRoutes()) > 0);
        self::assertEquals($path, $route->getRoutes()[0]->path);
        self::assertTrue(in_array('GET', $route->getRoutes()[0]->method));
    }


    /**
    * Тест перевіряє правильність роботи метода post()
    *
    * @return void
    */
    public function testCollectionPost(): void
    {
        $route = new RouteCollection();
        $route->post($path = 'page', PageController::class, 'view', 'pageOne');

        self::assertTrue(count($route->getRoutes()) > 0);
        self::assertEquals($path, $route->getRoutes()[0]->path);
        self::assertTrue(in_array('POST', $route->getRoutes()[0]->method));
    }


    /**
    * Тест перевіряє правильність роботи метода any()
    *
    * @return void
    */
    public function testCollectionAny(): void
    {
        $route = new RouteCollection();
        $route->any($path = 'page', PageController::class, 'view', 'pageOne');

        self::assertTrue(count($route->getRoutes()) > 0);
        self::assertEquals($path, $route->getRoutes()[0]->path);
        self::assertTrue(in_array('GET', $route->getRoutes()[0]->method));
        self::assertTrue(in_array('POST', $route->getRoutes()[0]->method));
    }

    





}