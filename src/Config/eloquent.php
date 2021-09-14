<?php
use Illuminate\Database\Capsule\Manager as Capsule;
use Illuminate\Database\Eloquent\Model as Eloquent;
$capsule = new Capsule();
$capsule->addConnection([
    'driver' => 'pgsql',
    'host' => 'ziggy.db.elephantsql.com',
    'database' => 'zzbyaybv',
    'username' => 'zzbyaybv',
    'password' => 'WAdOsrEpcI3Lqe7L48XSFeN3ktdklAdK'
]);

$capsule->setAsGlobal();
$capsule->bootEloquent();

