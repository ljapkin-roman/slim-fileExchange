<?php
use Illuminate\Database\Eloquent\Model as Eloquent;
use src\database\Connect;
require __DIR__ . '/../../vendor/autoload.php';
Connect::launch();
class Book extends Eloquent
{
protected $fillable = ['title', 'pages_count', 'price', 'description'];
public string $title;
public int $pages_count;
public int $price;
public string $description;
}
$book = new Book();
$book->fill(['title' => 'Gachi', 'pages_count'=> 4, 'price' => 30, 'description' => "second record in db"]);
$book->save();