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
        Schema::table('projects', function (Blueprint $table) {
            $table->foreignId('programming_language_id')->constrained('programming_languages');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('projects', function (Blueprint $table) {
            // Rimuovi il vincolo di chiave esterna e la colonna durante il rollback
            $table->dropForeign(['programming_language_id']);
            $table->dropColumn('programming_language_id');
        });
    }
};
