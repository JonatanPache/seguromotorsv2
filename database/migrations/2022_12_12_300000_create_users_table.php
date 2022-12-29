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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('ci')->unique();
            $table->string('last_name');
            $table->string('phone');
            $table->string('address');
            $table->date('birthday');
            $table->rememberToken();
            $table->string('notification_token')->nullable();
            $table->string('user_image1');
            $table->string('user_image2')->nullable();
            $table->timestamps();
            $table->foreignId('city_id')
                ->constrained()
                ->cascadeOnDelete();
            $table->foreignId('rol_id')
                ->constrained()
                ->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
};
