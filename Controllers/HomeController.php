<?php

class HomeController{
    
    private $model;

    function __construct($model)
    {
        $this->model = $model;
    }

    public function welcome()
    {
        return $this->model->default_message();
    }

    public function welcome_bootcamp()
    {
        return $this->model->bootcamp_message();
    }
}