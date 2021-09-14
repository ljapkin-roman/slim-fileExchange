<?php

namespace Summit\Config;
require __DIR__ . '/../../vendor/autoload.php';

use Illuminate\Database\Capsule\Manager as Capsule;
use Illuminate\Database\Eloquent\Model as Eloquent;



class Bootstrap
{
    public static object $capsule;
    static function connect() :object
    {
        self::$capsule = new Capsule();
        self::$capsule->addConnection([
            'driver' => 'pgsql',
            'host' => 'ziggy.db.elephantsql.com',
            'database' => 'zzbyaybv',
            'username' => 'zzbyaybv',
            'password' => 'WAdOsrEpcI3Lqe7L48XSFeN3ktdklAdK'
        ]);

        self::$capsule->setAsGlobal();
        self::$capsule->bootEloquent();
        return self::$capsule;

    }

    public function result()
    {
        print_r("reusl method of bootstrap class");
    }

}