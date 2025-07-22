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
        Schema::create('notification_channels', function (Blueprint $table) {
            $table->id();
            $table->string('name')->comment('Название канала уведомлений');
            $table->string('type')->comment('Тип канала: email, telegram, whatsapp, etc.');
            $table->string('value')->comment('Значение (email, номер телефона, id чата)');
            $table->boolean('is_active')->default(true)->comment('Активен ли канал');
            $table->boolean('is_default')->default(false)->comment('Канал по умолчанию');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('notification_channels');
    }
};
