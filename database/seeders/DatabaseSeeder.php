<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Enums\RoleEnum;
use App\Enums\TypeEnum;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        \App\Models\User::factory(1, ['type' => TypeEnum::ADMIN->value, 'role' => RoleEnum::ADMIN->value])->create();
        $this->call([
            OpscentralSeeder::class,
            SkiareaSeeder::class,
            SensorSeeder::class,
        ]);
    }
}
