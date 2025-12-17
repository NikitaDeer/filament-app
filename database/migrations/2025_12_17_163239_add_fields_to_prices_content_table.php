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
            // Icons for sections
            $table->string('transport_section_icon')->nullable()->after('transport_section_subtitle');
            $table->string('options_section_icon')->nullable()->after('options_section_subtitle');
            $table->string('special_section_icon')->nullable()->after('special_section_subtitle');
            
            // Conditions section cards (Repeater)
            $table->json('conditions_items')->nullable()->after('conditions_section_description');
        });
    }

    public function down(): void
    {
        Schema::table('prices_content', function (Blueprint $table) {
            $table->dropColumn([
                'transport_section_icon',
                'options_section_icon',
                'special_section_icon',
                'conditions_items',
            ]);
        });
    }
};
