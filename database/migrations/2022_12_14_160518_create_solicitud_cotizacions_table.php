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
        Schema::create('solicitud_cotizacions', function (Blueprint $table) {
            $table->id();
            $table->date('date');
            $table->foreignId('seguro_id')
                ->contrained()
                ->cascadeOnDelete();
            $table->foreignId('cliente_id')
                ->contrained()
                ->cascadeOnDelete();
            $table->foreignId('conductor_id')
                ->contrained()
                ->cascadeOnDelete();
            $table->foreignId('prima_id')
                ->contrained()
                ->cascadeOnDelete();
            $table->string('placa');
            $table->string('image_hist_conduc');
            $table->string('image_hist_auto');
            $table->enum('status',
             ['new', 'processing', 'up', 'down', 'cancelled'])
             ->default('new');
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
        Schema::dropIfExists('solicitud_cotizacions');
    }
};
