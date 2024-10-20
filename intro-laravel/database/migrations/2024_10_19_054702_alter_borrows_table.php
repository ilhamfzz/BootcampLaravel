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
        Schema::table('borrows', function (Blueprint $table) {
            // add column borrowers_id
            $table->foreignId('borrowers_id')->constrained()->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('borrows', function (Blueprint $table) {
            // drop column user_id
            $table->dropForeign('borrows_user_id_foreign');
            $table->dropColumn('user_id');
        });
    }

    // run the down function with the following command
    // php artisan migrate:rollback --path=database/migrations/2024_10_19_054702_alter_borrows_table.php
};
