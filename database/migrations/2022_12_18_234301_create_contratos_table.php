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
        Schema::create('contratos', function (Blueprint $table) {
            $table->id();
            $table->text('preposicion');
            $table->foreignId('user_id')
                ->constrained()
                ->cascadeOnDelete();
            $table->foreignId('cotizacion_id')
                ->constrained()
                ->cascadeOnDelete();
            $table->date('date_start');
            $table->date('date_end');
            $table->string('cliente_firm')->nullable();
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
        Schema::dropIfExists('contratos');
    }
};
