<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Car;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        \App\Models\User::factory()->create([
            'name' => 'Admin',
            'email' => 'hazem.ismail@hotmail.com',
            'password' => '123123123',
        ]);

        $this->call([
            DepartmentSeeder::class,
            CompanySeeder::class,
            BrandSeeder::class,
            TitleSeeder::class,
            TypeSeeder::class,
            DriverSeeder::class,
            CarSeeder::class,
        ]);
    }
}
