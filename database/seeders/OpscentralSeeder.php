<?php

namespace Database\Seeders;

use App\Enums\RoleEnum;
use App\Enums\TypeEnum;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class OpscentralSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\Opscentral::factory(1)->create()->each(function ($opscentral) {
            // Seed the relation with 5 skiareas
            $skiareas = \App\Models\Skiarea::factory(5)->make();
            $opscentral->skiareas()->saveMany($skiareas);

            // Seed the relation with 5 users
            $users = \App\Models\User::factory(3, ['type' => TypeEnum::OPSCENTRAL->value, 'role' => fake()->randomElement(RoleEnum::cases())->value])->make();
            $opscentral->users()->saveMany($users);
        });
    }
}
