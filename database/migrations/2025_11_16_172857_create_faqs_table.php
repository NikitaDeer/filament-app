<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('faqs', function (Blueprint $table) {
            $table->id();
            $table->string('question');
            $table->text('answer');
            $table->string('category')->default('Общие вопросы');
            $table->integer('order')->default(0);
            $table->boolean('is_published')->default(true);
            $table->boolean('is_popular')->default(false);
            $table->timestamps();
            
            $table->index(['category', 'is_published']);
            $table->index('is_popular');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('faqs');
    }
};
