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
        Schema::create('cotizacions', function (Blueprint $table) {
            $table->id();
            $table->date('date_start');
            $table->date('date_end');
            $table->string('total_primas');
            $table->string('descuento');
            $table->string('prima_neta');
            $table->string('gastos');
            $table->string('iva');
            $table->string('prima_total');
            $table->boolean('status')->default(false);
            $table->foreignId('coaseguro_id')
                ->contrained()
                ->cascadeOnDelete();
            $table->foreignId('solicitud_id')
                ->contrained()
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
        Schema::dropIfExists('cotizacions');
    }
};
