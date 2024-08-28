<?php

namespace Database\Seeders;

use App\Models\Stage;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $stages = [
            [
                'day_id' => 1, // Assumiamo che esista un evento con ID 1
                'name' => 'Palco della Piazza',
                'img' => 'https://example.com/palco_piazza.jpg',
                'description' => 'Il palco principale per la celebrazione della Vigilia di Natale.',
                'latitude' => '41.9028',
                'longitude' => '12.5964', // Coordinate di esempio per Roma
            ],
            [
                'day_id' => 2, // Assumiamo che esista un evento con ID 2
                'name' => 'Palco del Beach Club',
                'img' => 'https://example.com/palco_beach_club.jpg',
                'description' => 'Il palco per il party di Capodanno.',
                'latitude' => '40.8158',
                'longitude' => '14.2518', // Coordinate di esempio per Napoli
            ],
            [
                'day_id' => 3, // Assumiamo che esista un evento con ID 3
                'name' => 'Palco del Parco',
                'img' => 'https://example.com/palco_parco.jpg',
                'description' => 'Il palco per la caccia alle uova di Pasqua.',
                'latitude' => '45.4642',
                'longitude' => '9.1888', // Coordinate di esempio per Milano
            ],
            [
                'day_id' => 4, // Assumiamo che esista un evento con ID 4
                'name' => 'Palco di Via Principale',
                'img' => 'https://example.com/palco_via_principale.jpg',
                'description' => 'Il palco per la sfilata di Halloween.',
                'latitude' => '41.8902',
                'longitude' => '12.5113', // Coordinate di esempio per Città del Vaticano
            ],
            [
                'day_id' => 5, // Assumiamo che esista un evento con ID 5
                'name' => 'Palco della Sala Famiglia',
                'img' => 'https://example.com/palco_sala_famiglia.jpg',
                'description' => 'Il palco sarà di intrattenimento durante la cena del Ringraziamento.',
                'latitude' => '44.4034',
                'longitude' => '7.6978', // Coordinate di esempio per Torino
            ],
        ];
        foreach ($stages as $stage) {
            Stage::create($stage);
        }
    }
}
