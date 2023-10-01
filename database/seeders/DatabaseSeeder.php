<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Category;
use App\Models\Product;
use App\Models\Store;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */

    //! Command -> php artisan db:seed
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        //! Seeders 
        // $this->call(UserSeeder::class);
        // $this->call(CategoriesSeeder::class);

        //! Factories
        // Store::factory(5)->create();
        // Category::factory(10)->create(); 
        // Product::factory(100)->create();
    }
}
