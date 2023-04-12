<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('comandes', function (Blueprint $table) {
            $table->id();
            $table->string('mail');
            $table->dateTime('data_comanda');
            $table->boolean('parking')->nullable();
            $table->boolean('catering')->nullable();
            $table->enum('estat', ['pendent', 'acceptada', 'cancel·lada', 'tancada'])->default('pendent');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('comandes');
    }
};
