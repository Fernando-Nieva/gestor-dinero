<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Categoria;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        if (!User::where('email', 'test@example.com')->exists()) {
            User::create([
                'name' => 'Test User',
                'email' => 'test@example.com',
                'password' => bcrypt('password'),
            ]);
        }

        if (Categoria::count() === 0) {
            $this->call(CategoriaSeeder::class);
        }
    }
}
