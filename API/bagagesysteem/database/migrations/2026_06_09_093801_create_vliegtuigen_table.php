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
        $table->foreignId('vluchtschema_id')
              ->nullable()
              ->constrained('vluchtschemas')
              ->nullOnDelete();
        $table->foreignId('gate_id')
              ->nullable()
              ->constrained('gates')
              ->nullOnDelete();
        $table->foreignId('model_id')
              ->nullable()
              ->constrained('vliegtuigen')
              ->nullOnDelete();
        $table->string('vliegmaatschappij', 100);
        $table->timestamps();
    });
}

public function down(): void
{
    Schema::dropIfExists('vliegtuigen');
}
};
