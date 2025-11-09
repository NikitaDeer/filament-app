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
        Schema::create('pricing_options', function (Blueprint $table) {
            $table->id();
            $table->string('type'); // Тип опции (грузчики, пассажиры, этажи и т.д.)
            $table->string('name'); // Название опции
            $table->text('description')->nullable(); // Описание
            $table->decimal('price_per_hour', 10, 2)->nullable(); // Для грузчиков/пассажиров
            $table->decimal('price_per_floor', 10, 2)->nullable(); // Для этажей
            $table->integer('max_quantity')->default(10); // Макс кол-во (например 3 грузчика)
            $table->boolean('is_active')->default(true); // Активна ли
            $table->timestamps();

            // Индексы
            $table->index(['type', 'is_active']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pricing_options');
    }
};
