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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->bigInteger('telegram_id')->nullable()->unique();
            $table->boolean('trial_used')->default(false);
            $table->timestamp('trial_ends_at')->nullable();
            $table->foreignId('current_tariff_id')->nullable()->constrained('tariffs')->nullOnDelete();
            $table->enum('tariff_status', ['active', 'expired', 'paused'])->default('expired');
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};