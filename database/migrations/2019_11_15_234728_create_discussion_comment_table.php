<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDiscussionCommentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('discussion_comment', function (Blueprint $table) {
          $table->increments('id');
          $table->integer('discussion_id')->unsigned();
          $table->foreign('discussion_id')->references('id')->on('discussion');
          $table->integer('user_id')->unsigned();
          $table->foreign('user_id')->references('id')->on('users');
          $table->string('content');
          $table->integer('parent_id')->unsigned()->nullable();
          $table->foreign('parent_id')->references('id')->on('discussion_comment');
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
        Schema::dropIfExists('discussion_comment');
    }
}
