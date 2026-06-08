<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('bagage', function (Blueprint $table) {
            $table->string('rfid')->primary();
            $table->dateTime('timestamp_inlevering');
            $table->dateTime('timestamp_uitlevering')->nullable();
            $table->enum('status', [
                'ingeleverd',
                'onderweg',
                'in_zone',
                'bij_gate',
                'uitgeleverd',
                'error'
            ])->default('ingeleverd');
            $table->foreignId('zone_id')
                  ->nullable()
                  ->constrained('zones')
                  ->nullOnDelete();
            $table->string('gate_id')->nullable();
            $table->foreignId('vliegtuig_id')
                  ->constrained('vluchten')
                  ->cascadeOnDelete();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('bagage');
    }
};