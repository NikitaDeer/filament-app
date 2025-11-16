<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('contacts_content', function (Blueprint $table) {
            $table->id();
            
            // Hero секция
            $table->string('hero_title')->nullable();
            $table->text('hero_subtitle')->nullable();
            
            // Контактная информация
            $table->string('address_title')->nullable();
            $table->string('address_line1')->nullable();
            $table->string('address_line2')->nullable();
            
            $table->string('support_title')->nullable();
            $table->string('support_phone')->nullable();
            $table->string('support_email')->nullable();
            
            $table->string('hours_title')->nullable();
            $table->string('hours_weekdays')->nullable();
            $table->string('hours_weekend')->nullable();
            
            // Социальные сети
            $table->string('social_title')->nullable();
            $table->string('social_vk')->nullable();
            $table->string('social_telegram')->nullable();
            $table->string('social_whatsapp')->nullable();
            
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
        Schema::dropIfExists('contacts_content');
    }
};
