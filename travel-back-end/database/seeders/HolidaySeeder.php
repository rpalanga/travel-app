<?php

namespace Database\Seeders;

use App\Models\Holiday;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class HolidaySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $holidays = [
            [
                'title' => 'Christmas',
                'img' => 'https://example.com/christmas.jpg',
                'description' => 'A festive holiday celebrating the birth of Jesus Christ.',
            ],
            [
                'title' => 'New Year\'s Eve',
                'img' => 'https://example.com/new_years_eve.jpg',
                'description' => 'A celebration of the start of a new year.',
            ],
            [
                'title' => 'Valentine\'s Day',
                'img' => 'https://example.com/valentines_day.jpg',
                'description' => 'A romantic holiday celebrating love.',
            ],
            [
                'title' => 'Easter',
                'img' => 'https://example.com/easter.jpg',
                'description' => 'A Christian holiday celebrating the resurrection of Jesus Christ.',
            ],
        ];

        foreach ($holidays as $holiday) {
            Holiday::create($holiday);
        }
    }
}
