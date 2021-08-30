<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCarModelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('carros_modelos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('marca_id');
            $table->string('nome', 40);
            $table->string('imagem', 120);
            $table->integer('numero_portas');
            $table->integer('lugares');
            $table->boolean('air_bag');
            $table->boolean('abs');
            $table->timestamps();
            //foreign key (constraints)
            $table->foreign('marca_id')->references('id')->on('carros_marcas');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('car_models');
    }
}
