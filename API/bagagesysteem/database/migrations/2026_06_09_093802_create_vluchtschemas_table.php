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
    Schema::create('vluchtschemas', function (Blueprint $table) {
        $table->id();
        $table->foreignId('gate_id')
              ->constrained('gates')
              ->cascadeOnDelete();
        $table->foreignId('vliegtuig_id')
              ->constrained('vliegtuigen')
              ->cascadeOnDelete();
        $table->foreignId('status_bagage_id')
              ->constrained('status_bagage')
              ->cascadeOnDelete();
        $table->dateTime('vertrektijd');
        $table->integer('vertraging')->default(0);
        $table->timestamps();
    });
}

public function down(): void
{
    Schema::dropIfExists('vluchtschemas');
}
};
