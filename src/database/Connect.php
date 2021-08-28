<?php
namespace Summit\database;
require __DIR__ . '/../../vendor/autoload.php';
use Illuminate\Database\Capsule\Manager as Capsule;
class Connect
{
   private static object $capsule;
   public static function launch()
   {
       self::$capsule = new Capsule();
       self::$capsule->addConnection([
               'driver' => 'pgsql',
               'host' => 'ziggy.db.elephantsql.com',
               'database' => 'zzbyaybv',
               'username' => 'zzbyaybv',
               'password' => 'WAdOsrEpcI3Lqe7L48XSFeN3ktdklAdK'
           ]
       );
       self::$capsule->setAsGlobal();
       self::$capsule->bootEloquent();
   }
}