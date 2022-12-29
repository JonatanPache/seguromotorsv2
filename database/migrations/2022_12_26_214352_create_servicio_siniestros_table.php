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
        Schema::create('servicio_siniestros', function (Blueprint $table) {
            $table->id();
            $table->foreignId('solicitud_siniestro_id')
            ->contrained()
            ->cascadeOnDelete();
            $table->foreignId('empleado_id')
            ->contrained()
            ->cascadeOnDelete();
            $table->text('observaciones');
            $table->enum('status',
             ['new', 'processing', 'up', 'down', 'cancelled'])
             ->default('new');
             $table->string('latitude');
             $table->string('longitude');
             $table->string('total_costo')->nullable();
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
        Schema::dropIfExists('servicio_siniestros');
    }
};
