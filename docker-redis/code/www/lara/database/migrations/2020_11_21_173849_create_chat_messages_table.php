<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateChatMessagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('chat_messages', function (Blueprint $table) {
            $table->increments('id');
            $table->string('message');
            $table->integer('user_id')->unsigned();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::drop('chat_messages');
    }
}
