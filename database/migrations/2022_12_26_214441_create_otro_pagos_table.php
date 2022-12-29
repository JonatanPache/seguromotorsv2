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
        Schema::create('otro_pagos', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->foreignId('pago_id')
            ->contrained()
            ->cascadeOnDelete();
            $table->foreignId('siniestro_id')
            ->contrained()
            ->cascadeOnDelete();
            $table->text('detalle');
            $table->string('costo');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('otro_pagos');
    }
};
