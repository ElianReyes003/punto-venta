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
        Schema::create('presupuesto', function (Blueprint $table) {
            $table->id('pkPresupuesto')->autoIncrement();
            $table->string('folioPresupuesto', 20);
            $table->unsignedBigInteger('fkCliente');
            $table->foreign('fkCliente')->references('pkCliente')->on('cliente');
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
        Schema::dropIfExists('presupuesto');
    }
};
