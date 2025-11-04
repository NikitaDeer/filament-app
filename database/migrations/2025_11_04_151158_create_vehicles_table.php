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
        Schema::create('vehicles', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // Название (например "Газель 3м")
            $table->text('description')->nullable(); // Описание
            $table->boolean('allows_passengers')->default(false); // Можно ли пассажиров
            $table->integer('max_passengers')->default(0); // Макс кол-во пассажиров
            $table->decimal('price_per_hour', 10, 2); // Цена в час
            $table->decimal('price_per_km', 10, 2); // Цена за км
            $table->decimal('capacity_tons', 8, 2); // Грузоподъемность в тоннах
            $table->decimal('length_m', 8, 2); // Длина в метрах
            $table->decimal('width_m', 8, 2); // Ширина в метрах
            $table->decimal('height_m', 8, 2); // Высота в метрах
            $table->string('image')->nullable(); // Фото автомобиля
            $table->boolean('is_active')->default(true); // Активен ли
            $table->integer('sort_order')->default(0); // Порядок сортировки
            $table->timestamps();

            // Индексы для производительности
            $table->index(['is_active', 'sort_order']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vehicles');
    }
};
