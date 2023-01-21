<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('studies', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('users_id');
            $table->unsignedInteger('goal_id');
            $table->string('subject', 50);
            $table->date('date');
            $table->integer('hour');
            $table->integer('minute');
            $table->timestamps();
            //外部キー
            $table->foreign('users_id')->references('id')->on('users');
            $table->foreign('goal_id')->references('id')->on('goal');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('studies');
    }
};
