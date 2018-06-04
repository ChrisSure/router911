<?php

namespace Snayper911_Router;


class Result
{

    //Метод [get, post] маршруту
    private $method;

    //Шлях маршруту
    private $path;

    //Контроллер маршруту
    private $controller;

    //Метод-дія маршруту
    private $action;

    //Ім'я маршруту
    private $name;



    /**
    * Конструктор встановлює атрибути маршруту
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


    /**
    * Метод повертає метод [get, post] маршруту
    *
    * @return array
    */
    public function getMethod(): array
    {
        return $this->method;
    }

    /**
    * Метод повертає шлях маршруту
    *
    * @return string
    */
    public function getPath(): string
    {
        return $this->path;
    }

    /**
    * Метод повертає клас-контроллер маршруту
    *
    * @return string
    */
    public function getController(): string
    {
        return $this->controller;
    }

    /**
    * Метод повертає метод-класу-контроллер маршруту
    *
    * @return string
    */
    public function getAction(): string
    {
        return $this->action;
    }

    /**
    * Метод повертає назву маршруту
    *
    * @return string
    */
    public function getName(): string
    {
        return $this->name;
    }


}