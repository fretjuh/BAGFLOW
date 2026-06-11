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
    Schema::table('vliegtuigen', function (Blueprint $table) {
        $table->foreign('vluchtschema_id')
              ->references('id')
              ->on('vluchtschemas')
              ->nullOnDelete();
    });
}

public function down(): void
{
    Schema::table('vliegtuigen', function (Blueprint $table) {
        $table->dropForeign(['vluchtschema_id']);
    });
}
};
