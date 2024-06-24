<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('articulo', function (Blueprint $table) {
            $table->id('pkArticulo')->autoIncrement();
            $table->string('nombreArticulo',80);
            $table->unsignedBigInteger('fkCategoriaArticulo');
            $table->foreign("fkCategoriaArticulo")->references("pkCategoriaArticulo")->on("categoriaArticulo");
            $table->unsignedBigInteger('fkUnidad');
            $table->foreign("fkUnidad")->references("pkUnidad")->on("unidad");
            $table->decimal('precio', 10, 2);
            $table->decimal('costo', 10, 2);
            $table->integer('cantidadMinima');
            $table->integer('cantidadActual');
            $table->text('imagenArticulo')->nullable();
            $table->smallInteger('estatus');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('articulo');
    }
};
