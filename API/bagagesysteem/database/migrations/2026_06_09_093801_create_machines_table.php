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
    Schema::create('machines', function (Blueprint $table) {
        $table->id();
        $table->string('naam', 50);
        $table->string('positie', 50);
        $table->foreignId('status_id')
              ->constrained('status_machine')
              ->cascadeOnDelete();
        $table->timestamps();
    });
}

public function down(): void
{
    Schema::dropIfExists('machines');
}
};
