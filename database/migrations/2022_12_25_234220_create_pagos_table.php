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
        Schema::create('pagos', function (Blueprint $table) {
            $table->id();
            $table->string('poliza_id');
            $table->string('cliente_id');
            $table->date('date');
            $table->date('date_pay')->nullable();
            $table->string('otros_pagos')->nullable();
            $table->string('total');
            $table->string('dias_plazo');
            $table->string('recargo_financiero')->nullable();
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
        Schema::dropIfExists('pagos');
    }
};
