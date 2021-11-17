<?php
require __DIR__ . '/../../vendor/autoload.php';
use Summit\Models\Model_Authentication as Model_User;
use Summit\classes\User as User;
USE Summit\classes\Post as Post;
use Summit\Config\Bootstrap;
use Summit\Models\Model_Authentication as Auth;
use Illuminate\Database\Capsule\Manager as Capsule;
use Summit\Models\Model_Login as Model_Login;
use Summit\classes\CreateDownloadFilesTable;
use Summit\Models\Model_Files;
$Capsule


    = Bootstrap::connect();
/*
$post = Post::Create(['text' => "my first post"]);
$post->comments()->create(['text' => "are you kidding me"]);
*/
/*
Capsule::schema()->create('posts', function($table)
{
    $table->increments('id');
    $table->string('text');
    $table->timestamps();
});
Capsule::schema()->create('comments', function($table)
{
    $table->increments('id');
    $table->string('text');
    $table->integer('post_id')->unsigned();
    $table->json('properties');
    $table->foreign('post_id')->references('id')->on('posts')->onDelete('cascade');
    $table->timestamps();
});
*/

$files = new Model_Files();
$files->do_record(['kek' => 'cheburek']);
//$creator = new CreateDownloadFilesTable();
//$creator->up();





