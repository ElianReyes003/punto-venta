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
        Schema::create('cliente', function (Blueprint $table) {
            $table->id('pkCliente')->autoIncrement();
            $table->string('nombreCliente',80);
            $table->string('telefono',20)->nullable();
            $table->unsignedBigInteger("fkColonia")->nullable();
            $table->foreign("fkColonia")->references("pkColonia")->on("colonia");
            $table->string('calle',200)->nullable();
            $table->string('numCasa',20)->nullable();
            $table->text('descripcionDomicilio')->nullable();
            $table->text('imagenDomicilio')->nullable();
            $table->text('rfc')->nullable();
            $table->text('cp')->nullable();
            $table->smallInteger('estatus');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cliente');
    }
};
