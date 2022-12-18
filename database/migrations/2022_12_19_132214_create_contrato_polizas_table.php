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
        Schema::create('contrato_polizas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('contrato_id')
                ->constrained()
                ->cascadeOnDelete();
            $table->foreignId('poliza_id')
                ->constrained()
                ->cascadeOnDelete();
            $table->string('prima_total');
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
        Schema::dropIfExists('contrato_polizas');
    }
};
