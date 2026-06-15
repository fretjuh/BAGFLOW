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
    Schema::create('status_bagage', function (Blueprint $table) {
        $table->id();
        $table->enum('naam', ['onderweg', 'afgeleverd', 'opgeslagen', 'zoek']);
        $table->string('positie', 50);
        $table->string('omschrijving', 255)->nullable();
        $table->timestamps();
    });
}

public function down(): void
{
    Schema::dropIfExists('status_bagage');
}
};
