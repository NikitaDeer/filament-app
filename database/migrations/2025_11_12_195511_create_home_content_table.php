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
        Schema::create('home_content', function (Blueprint $table) {
            $table->id();
            
            // Hero секция
            $table->string('hero_title')->nullable();
            $table->text('hero_subtitle')->nullable();
            $table->string('hero_feature1')->nullable();
            $table->string('hero_feature2')->nullable();
            $table->string('hero_feature3')->nullable();
            $table->string('hero_feature4')->nullable();
            $table->string('hero_image')->nullable(); // путь к изображению
            
            // Статистика
            $table->string('stats_clients')->nullable();
            $table->string('stats_clients_label')->nullable();
            $table->string('stats_availability')->nullable();
            $table->string('stats_availability_label')->nullable();
            $table->string('stats_years')->nullable();
            $table->string('stats_years_label')->nullable();
            
            // Преимущества
            $table->string('advantages_title')->nullable();
            $table->text('advantages_subtitle')->nullable();
            $table->string('advantages_adv1_title')->nullable();
            $table->text('advantages_adv1_description')->nullable();
            $table->string('advantages_adv2_title')->nullable();
            $table->text('advantages_adv2_description')->nullable();
            $table->string('advantages_adv3_title')->nullable();
            $table->text('advantages_adv3_description')->nullable();
            
            // О компании
            $table->string('about_title')->nullable();
            $table->text('about_subtitle')->nullable();
            $table->string('about_history_title')->nullable();
            $table->text('about_description1')->nullable();
            $table->text('about_description2')->nullable();
            
            // Автопарк
            $table->string('fleet_title')->nullable();
            $table->text('fleet_subtitle')->nullable();
            
            // Услуги
            $table->string('services_title')->nullable();
            $table->text('services_subtitle')->nullable();
            
            // Версионность
            $table->boolean('is_published')->default(false);
            $table->timestamp('published_at')->nullable();
            $table->foreignId('created_by')->nullable()->constrained('users')->nullOnDelete();
            
            $table->timestamps();
            
            // Индекс для быстрого поиска опубликованной версии
            $table->index('is_published');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('home_content');
    }
};
