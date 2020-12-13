<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBoardsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('boards', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id', false, true);
            $table->string('title', 64);
            $table->string('description', 1024);
            $table->integer('price');
            $table->string('image');
            $table->timestamps();

            $table->foreign('user_id')
                ->references('id')
                ->on('users');

        });


    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('boards');
    }
}
