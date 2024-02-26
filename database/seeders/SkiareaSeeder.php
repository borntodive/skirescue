<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Enums\TypeEnum;
use App\Enums\RoleEnum;

class SkiareaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\Skiarea::all()->each(function ($skiarea) {
            // Seed the relation with 5 skiruns
            $opscentrals =
                \App\Models\Opscentral::get();
            $opscentral = $opscentrals->random();
            $skiarea->opscentral()->associate($opscentral);
            $skiruns = \App\Models\Skirun::factory(5)->make();
            $skiarea->skiruns()->saveMany($skiruns);

            // Seed the relation with 5 users
            $users = \App\Models\User::factory(5, ['type' => TypeEnum::RESCUER->value, 'role' => fake()->randomElement(RoleEnum::cases())->value])->make();
            $skiarea->users()->saveMany($users);
        });
    }
}
