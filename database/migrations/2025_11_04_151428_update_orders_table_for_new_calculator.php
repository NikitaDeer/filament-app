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
            $table->foreignId('vehicle_id')->nullable()->after('id')->constrained('vehicles')->nullOnDelete();
            
            // Маршрут и точки
            $table->json('route_points')->nullable()->after('to_address'); // Массив всех точек маршрута
            
            // Выбранные услуги
            $table->json('selected_services')->nullable()->after('route_points'); // Массив ID услуг
            
            // Грузчики
            $table->integer('loaders_count')->default(0)->after('selected_services');
            $table->decimal('loader_price', 10, 2)->default(0)->after('loaders_count');
            
            // Пассажиры
            $table->integer('passengers_count')->default(0)->after('loader_price');
            $table->decimal('passenger_price', 10, 2)->default(0)->after('passengers_count');
            
            // Этажи
            $table->integer('floors_count')->default(0)->after('passenger_price');
            $table->decimal('floor_price', 10, 2)->default(0)->after('floors_count');
            $table->boolean('has_cargo_elevator')->default(false)->after('floor_price');
            
            // Расчеты
            $table->decimal('estimated_hours', 8, 2)->default(0)->after('has_cargo_elevator'); // Расчетное время
            $table->decimal('base_distance_cost', 10, 2)->default(0)->after('cost'); // Стоимость за расстояние
            $table->decimal('base_time_cost', 10, 2)->default(0)->after('base_distance_cost'); // Стоимость за время
            $table->decimal('services_cost', 10, 2)->default(0)->after('base_time_cost'); // Стоимость услуг
            $table->decimal('options_cost', 10, 2)->default(0)->after('services_cost'); // Стоимость доп. опций
            $table->decimal('total_cost', 10, 2)->default(0)->after('options_cost'); // Итоговая стоимость
            
            // Переименовываем cost в old_cost для совместимости
            $table->renameColumn('cost', 'old_cost');
            
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
            
            // Возвращаем старое имя колонки
            $table->renameColumn('old_cost', 'cost');
        });
    }
};
