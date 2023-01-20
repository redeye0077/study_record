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
        Schema::create('goal', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('monthly_goal_id');
            $table->integer('hour');
            $table->integer('minute');
            $table->timestamps();
            // 外部キー
            $table->foreign('monthly_goal_id')->references('id')->on('monthly_goal');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('goal');
    }
};
