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
        Schema::create('redes_sociais_pets', function (Blueprint $table) {
            $table->id();
            $table->string('nome');
            $table->string('url');
            $table->timestamps();
    
            $table->unsignedBigInteger('cadastroPet_id');
            $table->foreign('cadastroPet_id')->references('id')->on('cadastro_pets')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('redes_sociais_pets');
    }
};
