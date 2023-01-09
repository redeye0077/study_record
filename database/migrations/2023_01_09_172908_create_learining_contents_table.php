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
        //learning_contentsテーブルの情報
        // Schema::create('learning_contents', function (Blueprint $table) {
        //     $table->increments('id');
        //     $table->integer('users_id');
        //     $table->string('learning_contents_id', 50);
        // });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('learning_contents');
    }
};
