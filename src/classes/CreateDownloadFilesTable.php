<?php

namespace Summit\classes;

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Summit\Config\Bootstrap;

class CreateDownloadFilesTable extends Migration
{
     public object $capsule;

     public function __construct()
     {
         $this->capsule = Bootstrap::connect();
     }
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $this->capsule::schema()->create('download_files', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->json('properties');
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('flights');
    }
}