<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVotejawabansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('votejawabans', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->enum('vote',['up','down']);
            $table->unsignedBigInteger('jawaban_id') ->nullable();
            $table->foreign('jawaban_id')->references('id')->on('jawabans');
            $table->unsignedBigInteger('user_id') -> nullable();
            $table->foreign('user_id') -> references('id')->on('users');
            // $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('votejawabans');
    }
}
