<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\OptionGroup;
use App\Models\OptionItem;
use App\Models\Question;
use App\Models\Interpretation;
use App\Models\Tribe;
use App\Models\Material;
use App\Models\MaterialQuestion;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Create Admin
        User::firstOrCreate(
            ['email' => 'admin@temansebayaku.com'],
            [
                'name' => 'Administrator',
                'password' => bcrypt('password'),
                'role' => 'admin',
            ]
        );

        // 2. Create Counselors via CounselorSeeder
        $this->call(CounselorSeeder::class);

        // 3. Create Konseli
        User::firstOrCreate(
            ['email' => 'konseli@temansebayaku.com'],
            [
                'name' => 'Andi Wijaya',
                'password' => bcrypt('password'),
                'role' => 'konseli',
            ]
        );

        // 4. Create Interpretations
        $interpretations = [
            [
                'min_score' => 30,
                'max_score' => 69,
                'description' => 'Kesejahteraan Psikologis Rendah. Anda mungkin sedang menghadapi tekanan berat atau merasa kurang mendapat dukungan. Sangat disarankan untuk melakukan konseling dengan Konselor Anda.'
            ],
            [
                'min_score' => 70,
                'max_score' => 109,
                'description' => 'Kesejahteraan Psikologis Sedang. Anda memiliki ketahanan mental yang cukup baik, namun masih ada area yang dapat dioptimalkan melalui self-help dan diskusi bersama teman.'
            ],
            [
                'min_score' => 110,
                'max_score' => 150,
                'description' => 'Kesejahteraan Psikologis Tinggi. Selamat! Anda memiliki kesehatan mental dan emosional yang sangat stabil serta mampu menjalin hubungan sosial yang positif.'
            ]
        ];

        foreach ($interpretations as $interp) {
            Interpretation::firstOrCreate(
                [
                    'min_score' => $interp['min_score'],
                    'max_score' => $interp['max_score']
                ],
                [
                    'description' => $interp['description']
                ]
            );
        }

        // 5. Create Madura Self-Help
        $this->call(MaduraSelfHelpSeeder::class);

        // 6. Create Bugis-Makassar Self-Help
        $this->call(BugisMakassarSelfHelpSeeder::class);

        // 7. Create Jawa Self-Help
        $this->call(JawaSelfHelpSeeder::class);

        // 8. Create Minang-Padang Self-Help
        $this->call(MinangPadangSelfHelpSeeder::class);

        // 9. Create Sasak-Lombok Self-Help
        $this->call(SasakLombokSelfHelpSeeder::class);

        // 10. Create Wellbeing Custom Scale Questions (Positif/Negatif)
        $this->call(WellbeingQuestionSeeder::class);
    }
}






