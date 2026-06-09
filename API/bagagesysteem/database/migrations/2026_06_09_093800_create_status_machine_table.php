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
    Schema::create('status_machine', function (Blueprint $table) {
        $table->id();
        $table->enum('naam', ['actief', 'inactief', 'onderhoud', 'error']);
        $table->string('omschrijving', 255)->nullable();
        $table->timestamps();
    });
}

public function down(): void
{
    Schema::dropIfExists('status_machine');
}
};
