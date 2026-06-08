<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('vluchten', function (Blueprint $table) {
            $table->id();
            $table->string('vliegtuig_id');
            $table->string('gate_id');
            $table->string('vluchtschema');
            $table->dateTime('aan_gate');
            $table->dateTime('uit_gate');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('vluchten');
    }
};