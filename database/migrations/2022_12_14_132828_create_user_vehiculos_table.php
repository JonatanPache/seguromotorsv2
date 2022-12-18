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
        Schema::create('user_vehiculos', function (Blueprint $table) {
            $table->id();
            $table->string('user_id')
                ->constrained()
                ->cascadeOnDelete();
            $table->string('vehiculo_id')
                ->constrained()
                ->cascadeOnDelete();
            $table->string('tipo_servicio_id')
                ->constrained()
                ->cascadeOnDelete();
            $table->string('tipo_uso_id')
                ->constrained()
                ->cascadeOnDelete();
            $table->string('city_id')
                ->constrained()
                ->cascadeOnDelete();
            $table->string('tipo_combustible_id')
                ->constrained()
                ->cascadeOnDelete();
            $table->string('placa')->unique();
            $table->string('image1');
            $table->string('image2');
            $table->string('image3');
            $table->string('valor_comercial');
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
        Schema::dropIfExists('user_vehiculos');
    }
};
