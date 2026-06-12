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
    Schema::create('bagages', function (Blueprint $table) {
        $table->id();
        $table->foreignId('status_bagage_id')
              ->constrained('status_bagage')
              ->cascadeOnDelete();
        $table->string('omschrijving', 255)->nullable();
        $table->dateTime('inlevertijd');
        $table->string('rfid')->unique();
        $table->dateTime('aflevertijd')->nullable();
        $table->timestamps();
    });
}

public function down(): void
{
    Schema::dropIfExists('bagages');
}
};
