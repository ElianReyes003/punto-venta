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
        Schema::create('proveedor', function (Blueprint $table) {
            $table->id('pkProveedor')->autoIncrement();
            $table->string('nombreProveedor', 80);
            $table->string('telefono', 20);
            $table->unsignedBigInteger("fkColonia");
            $table->foreign("fkColonia")->references("pkColonia")->on("colonia");
            $table->string('calle', 200);
            $table->string('numCasa', 20);
            $table->text('descripcionDomicilio');
            $table->text('rfc')->nullable();
            $table->text('cp');
            $table->smallInteger('estatus');
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
