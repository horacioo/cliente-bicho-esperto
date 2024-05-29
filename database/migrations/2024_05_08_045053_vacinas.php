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
        Schema::create('vacinas', function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            $table->string('vacina');
            $table->date('data');
            $table->date('proxima');
            ///$table->integer('pet_id');

            $table->unsignedBigInteger('pet_id');
            $table->foreign('pet_id')->references('id')->on('meus_pets')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('vacinas');
    }
};
