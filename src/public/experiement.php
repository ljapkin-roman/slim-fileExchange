<?php
require __DIR__ . '/../../vendor/autoload.php';
use Summit\Models\Model_Authentication as Model_User;
use Summit\classes\User as User;
use Summit\Config\Bootstrap;
use Summit\Models\Model_Authentication as Auth;
use Illuminate\Database\Capsule\Manager as Capsule;
use Summit\Models\Model_Login as Model_Login;
$DB = Bootstrap::connect();
$userObject = $DB::table('users')->where('email', 'kertaza@gmail.com')->first();
print_r($userObject->id);



