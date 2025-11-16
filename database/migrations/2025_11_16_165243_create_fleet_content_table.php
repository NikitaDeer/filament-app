<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('fleet_content', function (Blueprint $table) {
            $table->id();
            
            // Hero секция
            $table->string('hero_title')->nullable();
            $table->text('hero_subtitle')->nullable();
            
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
        Schema::dropIfExists('fleet_content');
    }
};
