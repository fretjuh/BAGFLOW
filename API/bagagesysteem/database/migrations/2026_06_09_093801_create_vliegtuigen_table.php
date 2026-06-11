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
    Schema::create('vliegtuigen', function (Blueprint $table) {
        $table->id();
        $table->unsignedBigInteger('vluchtschema_id')->nullable();
        $table->foreignId('gate_id')
              ->nullable()
              ->constrained('gates')
              ->nullOnDelete();
        $table->unsignedBigInteger('model_id')->nullable();
        $table->string('vliegmaatschappij', 100);
        $table->timestamps();
    });
}

public function down(): void
{
    Schema::dropIfExists('vliegtuigen');
}
};
