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
        Schema::table('prices_content', function (Blueprint $table) {
            if (!Schema::hasColumn('prices_content', 'conditions_items')) {
                $table->json('conditions_items')->nullable();
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('prices_content', function (Blueprint $table) {
            if (Schema::hasColumn('prices_content', 'conditions_items')) {
                $table->dropColumn('conditions_items');
            }
        });
    }
};
