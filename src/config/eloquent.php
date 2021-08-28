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
/*
$capsule::schema()->create('books', function($table)
{
    $table->increments('id');
     $table->string('title', 30);
     $table->integer('pages_count');
     $table->decimal('price', 5, 2);
     $table->text('description');
     $table->timestamps(); 
});
*/
