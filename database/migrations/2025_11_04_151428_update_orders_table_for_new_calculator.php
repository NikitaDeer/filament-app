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
        Schema::table('orders', function (Blueprint $table) {
            // Добавляем связь с автомобилем
            $table->unsignedBigInteger('vehicle_id')->nullable();
            $table->foreign('vehicle_id')->references('id')->on('vehicles')->onDelete('set null');

            // Маршрут и точки
            $table->json('route_points')->nullable(); // Массив всех точек маршрута

            // Выбранные услуги
            $table->json('selected_services')->nullable(); // Массив ID услуг

            // Грузчики
            $table->integer('loaders_count')->default(0);
            $table->decimal('loader_price', 10, 2)->default(0);

            // Пассажиры
            $table->integer('passengers_count')->default(0);
            $table->decimal('passenger_price', 10, 2)->default(0);

            // Этажи
            $table->integer('floors_count')->default(0);
            $table->decimal('floor_price', 10, 2)->default(0);
            $table->boolean('has_cargo_elevator')->default(false);

            // Расчеты
            $table->decimal('estimated_hours', 8, 2)->default(0); // Расчетное время
            $table->decimal('base_distance_cost', 10, 2)->default(0); // Стоимость за расстояние
            $table->decimal('base_time_cost', 10, 2)->default(0); // Стоимость за время
            $table->decimal('services_cost', 10, 2)->default(0); // Стоимость услуг
            $table->decimal('options_cost', 10, 2)->default(0); // Стоимость доп. опций
            $table->decimal('total_cost', 10, 2)->default(0); // Итоговая стоимость

            // Индексы
            $table->index('vehicle_id');
            $table->index('created_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            // Удаляем индексы
            $table->dropIndex(['vehicle_id']);
            $table->dropIndex(['created_at']);

            // Удаляем внешний ключ
            $table->dropForeign(['vehicle_id']);

            // Удаляем новые колонки
            $table->dropColumn([
                'vehicle_id',
                'route_points',
                'selected_services',
                'loaders_count',
                'loader_price',
                'passengers_count',
                'passenger_price',
                'floors_count',
                'floor_price',
                'has_cargo_elevator',
                'estimated_hours',
                'base_distance_cost',
                'base_time_cost',
                'services_cost',
                'options_cost',
                'total_cost',
            ]);
        });
    }
};
