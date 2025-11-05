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
            $table->date('scheduled_date')->nullable()->after('status');
            $table->time('scheduled_time')->nullable()->after('scheduled_date');
            $table->text('client_comments')->nullable()->after('scheduled_time');
            $table->boolean('is_cash_payment')->default(false)->after('client_comments');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropColumn(['scheduled_date', 'scheduled_time', 'client_comments', 'is_cash_payment']);
        });
    }
};
