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
        Schema::create('detallePresupuesto', function (Blueprint $table) {
            $table->id('pkDetallePresupuesto')->autoIncrement();
            $table->unsignedBigInteger('fkPresupuesto');
            $table->unsignedBigInteger('fkArticulo');
            $table->foreign('fkArticulo')->references('pkArticulo')->on('articulo');
            $table->foreign('fkPresupuesto')->references('pkPresupuesto')->on('presupuesto');
            $table->Integer('cantidad');
            $table->decimal('totalSubCompra', 10, 2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detalle_presupuesto');
    }
};
