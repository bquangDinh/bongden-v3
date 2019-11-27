<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

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
          $table->char('name',100);
          $table->string('email')->unique();
          $table->integer('birthYear');
          $table->char('gender',10);
          $table->char('phoneNumber',50)->nullable();
          $table->string('avatarURL')->nullable();
          $table->json('award')->nullable();
          $table->json('organization')->nullable();
          $table->string('description')->nullable();
          $table->string('password');
          $table->string('verified_email_token');
          $table->boolean('verified_email')->default(false);
          $table->date('verified_email_at')->nullable();
          $table->string('password_reset_token');
          $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
