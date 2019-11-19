<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDiscussionVoteTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('discussion_vote', function (Blueprint $table) {
          $table->increments('id');
          $table->integer('discussion_id')->unsigned();
          $table->foreign('discussion_id')->references('id')->on('discussion');
          $table->integer('reactor_id')->unsigned();
          $table->foreign('reactor_id')->references('id')->on('users');
          $table->string('vote');
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
        Schema::dropIfExists('discussion_vote');
    }
}
