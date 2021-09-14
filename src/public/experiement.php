<?php
require __DIR__ . '/../../vendor/autoload.php';
use Summit\Config\Bootstrap;
use Summit\classes\User;
$hope = Bootstrap::connect();
$user = User::Create([    'name' => "Kshiitj Soni",    'email' => "kshitij206@gmail.com",    'password' => password_hash("1234",PASSWORD_BCRYPT), ]);


