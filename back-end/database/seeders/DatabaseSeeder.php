<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Expense;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'is_admin' => true,
            'password' => Hash::make('Admin@123'),
        ]);
        Category::factory()->create([
            'title' => 'Insumos',
            'is_global' => false,
            'user_id' => User::factory(),
        ]);

        User::factory(10)->create();
        Category::factory(4)->create();
        Expense::factory(4)->create();
    }
}
