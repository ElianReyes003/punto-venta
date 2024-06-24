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
        Schema::create('detalleCompraProveedor', function (Blueprint $table) {
            $table->id('pkDetalleCompraProveedor')->autoIncrement();
            $table->unsignedBigInteger('fkCompraProveedor');
            $table->unsignedBigInteger('fkArticulo');
            $table->foreign('fkArticulo')->references('pkArticulo')->on('articulo');
            $table->foreign('fkCompraProveedor')->references('pkCompraProveedor')->on('compraProveedor');
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
        //
    }
};
