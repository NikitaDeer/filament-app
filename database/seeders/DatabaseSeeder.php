<?php

namespace Database\Seeders;

use App\Models\{User, Order, Page, Advantage, Tariff, Subscription, AccessKey};
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Crypt;

class DatabaseSeeder extends Seeder
{
  /**
   * Seed the application's database.
   */
  public function run(): void
  {
    $this->call([
      PriceSeeder::class,
    ]);
  }
}
