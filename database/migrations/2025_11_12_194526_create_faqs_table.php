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
        Schema::create('faqs', function (Blueprint $table) {
            $table->id();
            $table->text('question'); // вопрос
            $table->text('answer'); // ответ
            $table->string('category')->default('прочее'); // категория
            $table->integer('order')->default(0); // порядок сортировки
            $table->boolean('is_published')->default(true); // опубликован ли
            $table->timestamps();

            // Индексы
            $table->index(['category', 'is_published']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('faqs');
    }
};
