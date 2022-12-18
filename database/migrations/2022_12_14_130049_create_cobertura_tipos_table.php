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
        Schema::create('cobertura_tipos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('cobertura_id')
                ->constrained()
                ->cascadeOnDelete();
            $table->foreignId('cobertura_tipo_id')
                ->constrained()
                ->cascadeOnDelete();
            $table->string('porcentaje_cob');
            $table->string('monto_cobertura');
            $table->foreignId('limite_id')
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
        Schema::dropIfExists('cobertura_tipos');
    }
};
