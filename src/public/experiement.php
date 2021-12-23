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
$Capsule = Bootstrap::connect();
$DownloadFile = new CreateDownloadFilesTable();
$DownloadFile->up();






