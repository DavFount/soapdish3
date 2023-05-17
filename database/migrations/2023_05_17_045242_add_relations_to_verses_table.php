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
        Schema::table('verses', function (Blueprint $table) {
            $table->foreignId('book_id')->constrained()->cascadeOnDelete();
            $table->foreignId('translation_id')->constrained()->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('verses', function (Blueprint $table) {
            $table->dropColumn('book_id');
            $table->dropColumn('translation_id');
        });
    }
};
