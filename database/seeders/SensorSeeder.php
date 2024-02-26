<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Sensor;

class SensorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = \Faker\Factory::create();
        $sensors = [
            'Temperature',
            'Saturation',
            'HeartRate',
            'BreathFrequency',
            'Position',
            'Ecg',
            'Respiration',
            'Respiration2',
            'AccelerationX',
            'AccelerationY',
            'AccelerationZ',
        ];
        foreach ($sensors as $sensor) {
            Sensor::create(
                [
                    'name' => $sensor,
                    'color' => $faker->hexColor(),
                ]
            );
        }
    }
}
