<?php

namespace Summit\Core;
use Summit\Core\View;
use Summit\Core\Model;
class Controller
{
    public $model;
    public $view;

    function __construct()
    {
        $this->view = new View();
    }

    function action_index()
    {

    }
}