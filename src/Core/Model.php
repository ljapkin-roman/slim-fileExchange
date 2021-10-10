<?php

namespace Summit\Core;
use Summit\Config\Bootstrap;

class Model
{
    protected object $database;
    public function __construct()
    {
        $this->database = Bootstrap::connect();
    }
}