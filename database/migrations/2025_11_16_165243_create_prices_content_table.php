<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('prices_content', function (Blueprint $table) {
            $table->id();
            
            // Hero секция
            $table->string('hero_badge')->nullable();
            $table->string('hero_title')->nullable();
            $table->text('hero_subtitle')->nullable();
            
            // Секция "Аренда транспорта"
            $table->string('transport_section_title')->nullable();
            $table->text('transport_section_subtitle')->nullable();
            
            // Секция "Дополнительные опции"
            $table->string('options_section_title')->nullable();
            $table->text('options_section_subtitle')->nullable();
            
            // Секция "Особые услуги"
            $table->string('special_section_title')->nullable();
            $table->text('special_section_subtitle')->nullable();
            
            // Секция "Условия работы"
            $table->string('conditions_section_title')->nullable();
            $table->text('conditions_section_description')->nullable();
            
            // Версионность
            $table->boolean('is_published')->default(false);
            $table->timestamp('published_at')->nullable();
            $table->foreignId('created_by')->nullable()->constrained('users')->nullOnDelete();
            
            $table->timestamps();
            $table->index('is_published');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('prices_content');
    }
};
