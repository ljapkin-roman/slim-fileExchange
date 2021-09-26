<?php

namespace Summit\Core;
use Summit\Config\Bootstrap;

class Model
{
    protected object $connect_DB;
    public function __construct()
    {
        $this->connect_DB = Bootstrap::connect();
    }
}