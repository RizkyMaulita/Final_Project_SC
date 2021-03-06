<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKomentarpertanyaansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('komentarpertanyaans', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->longText('komentar');
            $table->unsignedBigInteger('pertanyaan_id') ->nullable();
            $table->foreign('pertanyaan_id')->references('id')->on('pertanyaans');
            $table->unsignedBigInteger('user_id') -> nullable();
            $table->foreign('user_id') -> references('id')->on('users');
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
        Schema::dropIfExists('komentarpertanyaans');
    }
}
