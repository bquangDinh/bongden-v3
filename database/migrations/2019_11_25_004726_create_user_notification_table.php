<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserNotificationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_notification', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('notification_type_id')->unsigned();
            $table->foreign('notification_type_id')->references('id')->on('notification_type');
            $table->integer('actor_id')->unsigned();
            $table->foreign('actor_id')->references('id')->on('users');
            $table->string('message');
            $table->integer('notifier_id')->unsigned();
            $table->foreign('notifier_id')->references('id')->on('users');
            $table->string('url')->nullable();
            $table->boolean('read')->default(false);
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
        Schema::dropIfExists('user_notification');
    }
}
