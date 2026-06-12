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
    Schema::create('gates', function (Blueprint $table) {
        $table->id();
        $table->string('naam', 50);
        $table->string('positie', 50);
        $table->boolean('is_open')->default(false);
        $table->string('omschrijving', 255)->nullable();
        $table->timestamps();
    });
}

public function down(): void
{
    Schema::dropIfExists('gates');
}
};
