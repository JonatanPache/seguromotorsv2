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
        Schema::create('cotizacion_deducibles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('cotizacion_id')
                ->constrained()
                ->cascadeOnDelete();
            $table->foreignId('tipo_cobertura_id')
                ->constrained()
                ->cascadeOnDelete();
            $table->foreignId('deducible_id')
                ->constrained()
                ->cascadeOnDelete();
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
        Schema::dropIfExists('cotizacion_deducibles');
    }
};
