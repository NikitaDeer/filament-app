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
        Schema::table('services', function (Blueprint $table) {
            $table->boolean('is_calculator_option')->default(false)->after('is_published'); // Доступна ли в калькуляторе
            $table->string('icon')->nullable()->after('is_calculator_option'); // Иконка FontAwesome
            
            // Индекс для быстрого поиска
            $table->index(['is_published', 'is_calculator_option']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('services', function (Blueprint $table) {
            $table->dropIndex(['is_published', 'is_calculator_option']);
            $table->dropColumn(['is_calculator_option', 'icon']);
        });
    }
};
