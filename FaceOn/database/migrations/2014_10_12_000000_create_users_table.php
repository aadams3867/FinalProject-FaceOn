<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('email')->unique();
            $table->string('password');
            $table->string('gallery_name');
            $table->string('image');
            $table->rememberToken();
            $table->timestamps();
        });

        /*User::create([
            'name' => 'Bob',
            'email' => 'bob@gmail.com',
            'password' => 'bob123',
            'image' => 'https://s3.ohio.amazonaws.com/face-on-bucket/Friends1/Bert.jpg',
            'gallery_name' => 'Friends1'
        ]);*/
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
