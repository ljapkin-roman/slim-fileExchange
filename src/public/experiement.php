<?php
require __DIR__ . '/../../vendor/autoload.php';
use Summit\Models\Model_Authentication as Model_User;
use Summit\classes\User as User;
use Summit\Config\Bootstrap;
use Summit\Models\Model_Authentication as Auth;
use Illuminate\Database\Capsule\Manager as Capsule;
Capsule::connection();
Capsule::schema()->create('abiturients', function ($table) {

    $table->increments('id');

    $table->string('name');
    $table->string('last_name');

    $table->string('email')->unique();

    $table->string('password');

    $table->timestamps();

});



