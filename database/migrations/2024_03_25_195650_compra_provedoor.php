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
        Schema::create('compraProveedor', function (Blueprint $table) {
            $table->id('pkCompraProveedor')->autoIncrement();
            $table->string('folioCompraProveedor', 20);
            $table->unsignedBigInteger('fkProveedor');
            $table->foreign('fkProveedor')->references('pkProveedor')->on('proveedor');
            $table->smallInteger('estatus');
            $table->date('fecha');
            $table->decimal('total', 10, 2);
            $table->unsignedBigInteger('fkEmpleado');
            $table->foreign('fkEmpleado')->references('pkEmpleado')->on('empleado')->nullable();
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
