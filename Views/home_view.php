<?php

/**
* The home page view
*/
class HomeView
{

    private $model;

    private $controller;

    function __construct($controller, $model)
    {
        $this->controller = $controller;

        $this->model = $model;
    }

    // http://localhost/tutorials/cpips-framework/home/index/
    public function index()
    {
        return $this->controller->welcome();
    }

    // http://localhost/tutorials/cpips-framework/home/welcome/peter
    public function welcome($name)
    {
        return $this->controller->welcome_bootcamp() . " " . $name[0];
    }

}