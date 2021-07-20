<?php

class HomeModel
{
    private $message = 'Welcome to CPIPS Famework.';
    private $bootcamp_message = 'Welcome to CPIPS Bootcamp ';

    function __construct()
    {

    }

    public function default_message()
    {
        return $this->message;
    }

    public function bootcamp_message()
    {
        return $this->bootcamp_message;
    }
}