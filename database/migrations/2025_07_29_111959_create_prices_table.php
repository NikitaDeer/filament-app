<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
  /**
   * Run the migrations.
   */
  public function up(): void
  {
    Schema::create('prices', function (Blueprint $table) {
      $table->id();
      $table->string('name');
      $table->string('description')->nullable();
      $table->decimal('price', 8, 2);
      $table->string('price_prefix')->nullable();
      $table->string('price_suffix')->nullable();
      $table->string('category');
      $table->json('features')->nullable();
      $table->boolean('is_popular')->default(false);
      $table->integer('order')->default(0);
      $table->timestamps();
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::dropIfExists('prices');
  }
};
