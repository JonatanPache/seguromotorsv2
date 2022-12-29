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
        Schema::create('costo_siniestros', function (Blueprint $table) {
            $table->id();
            $table->foreignId('siniestro_id')
            ->contrained()
            ->cascadeOnDelete();
            $table->string('name');
            $table->text('detalle')->nullable();
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
        Schema::dropIfExists('costo_siniestros');
    }
};
