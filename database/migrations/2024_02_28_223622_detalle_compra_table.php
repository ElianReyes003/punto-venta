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
        Schema::create('detalleCompra', function (Blueprint $table) {
            $table->id('pkDetalleCompra')->autoIncrement();
            $table->unsignedBigInteger('fkComprasCliente');
            $table->unsignedBigInteger('fkArticulo');
            $table->foreign('fkArticulo')->references('pkArticulo')->on('articulo');
            $table->foreign('fkComprasCliente')->references('pkcomprasCliente')->on('comprasCliente');
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
        Schema::dropIfExists('detalleCompra');
    }
};
