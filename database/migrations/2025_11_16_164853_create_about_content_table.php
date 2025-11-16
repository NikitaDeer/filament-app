<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('about_content', function (Blueprint $table) {
            $table->id();
            
            // Hero секция
            $table->string('hero_title')->nullable();
            $table->text('hero_subtitle')->nullable();
            
            // Основной блок "Почему выбирают нас"
            $table->string('why_title')->nullable();
            $table->text('why_description1')->nullable();
            $table->text('why_description2')->nullable();
            $table->string('why_feature1')->nullable();
            $table->string('why_feature2')->nullable();
            $table->string('why_feature3')->nullable();
            
            // Статистика (4 блока)
            $table->string('stat1_number')->nullable();
            $table->string('stat1_label')->nullable();
            $table->string('stat2_number')->nullable();
            $table->string('stat2_label')->nullable();
            $table->string('stat3_number')->nullable();
            $table->string('stat3_label')->nullable();
            $table->string('stat4_number')->nullable();
            $table->string('stat4_label')->nullable();
            
            // Ценности компании (4 карточки)
            $table->string('value1_title')->nullable();
            $table->text('value1_description')->nullable();
            $table->string('value2_title')->nullable();
            $table->text('value2_description')->nullable();
            $table->string('value3_title')->nullable();
            $table->text('value3_description')->nullable();
            $table->string('value4_title')->nullable();
            $table->text('value4_description')->nullable();
            
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
        Schema::dropIfExists('about_content');
    }
};
