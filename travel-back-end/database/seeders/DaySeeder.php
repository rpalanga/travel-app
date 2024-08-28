<?php

namespace Database\Seeders;

use App\Models\Day;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DaySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $days = [
            [
                'holiday_id' => 1, // Assumiamo che esista un giorno festivo con ID 1
                'name' => 'Cena della Vigilia di Natale',
                'img' => 'https://example.com/cena_vigilia_natale.jpg',
                'description' => 'Un tradizionale ritrovo familiare e cena alla vigilia di Natale.',
                'place' => 'Casa',
                'date' => '2024-12-24',
            ],
            [
                'holiday_id' => 2, // Assumiamo che esista un giorno festivo con ID 2
                'name' => 'Festa di Capodanno',
                'img' => 'https://example.com/capodanno.jpg',
                'description' => 'Un festeggiamento per celebrare del nuovo anno.',
                'place' => 'Locale',
                'date' => '2024-12-31',
            ],
            [
                'holiday_id' => 3, // Assumiamo che esista un giorno festivo con ID 3
                'name' => 'Caccia alle uova di Pasqua',
                'img' => 'https://example.com/uova_pasqua.jpg',
                'description' => 'Attività divertente per i bambini per trovare uova nascoste.',
                'place' => 'Parco',
                'date' => '2025-04-13', // Esempio di data per la Domenica di Pasqua nel 2025
            ],
            [
                'holiday_id' => 4, // Assumiamo che esista un giorno festivo con ID 4
                'name' => 'Sfilata di Halloween',
                'img' => 'https://example.com/sfilata_halloween.jpg',
                'description' => 'Una sfilata colorata con persone in costume.',
                'place' => 'Centro città',
                'date' => '2024-10-31',
            ],
            [
                'holiday_id' => 5, // Assumiamo che esista un giorno festivo con ID 5
                'name' => 'Cena del Ringraziamento',
                'img' => 'https://example.com/cena_ringraziamento.jpg',
                'description' => 'Un tradizionale ritrovo familiare con un banchetto.',
                'place' => 'Casa',
                'date' => '2024-11-28', // Esempio di data per il Ringraziamento nel 2024
            ],
        ];
        foreach ($days as $day) {
            Day::create($day);
        }
    }
}
