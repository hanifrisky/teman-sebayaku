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

        // 2. Create Counselor
        $counselor = User::firstOrCreate(
            ['email' => 'budi@temansebayaku.com'],
            [
                'name' => 'Budi Raharjo, S.Psi',
                'password' => bcrypt('password'),
                'role' => 'konselor',
            ]
        );

        $counselor->counselorProfile()->firstOrCreate(
            ['user_id' => $counselor->id],
            [
                'description' => 'Saya adalah Konselor yang berfokus pada pendampingan psikologis remaja, pengembangan minat bakat, dan manajemen stres akademis.',
                'motto' => 'Hari ini adalah kesempatan untuk tumbuh lebih baik.',
                'photo_path' => null,
                'whatsapp_number' => '081234567890',
            ]
        );

        $counselor2 = User::firstOrCreate(
            ['email' => 'siti@temansebayaku.com'],
            [
                'name' => 'Siti Aminah',
                'password' => bcrypt('password'),
                'role' => 'konselor',
            ]
        );

        $counselor2->counselorProfile()->firstOrCreate(
            ['user_id' => $counselor2->id],
            [
                'description' => 'Mendengarkan dengan empati adalah kunci utama konseling. Mari berbagi cerita dan mencari solusi terbaik bersama-sama.',
                'motto' => 'Tenang, semua badai pasti berlalu.',
                'photo_path' => null,
                'whatsapp_number' => '082345678901',
            ]
        );

        // 3. Create Konseli
        User::firstOrCreate(
            ['email' => 'konseli@temansebayaku.com'],
            [
                'name' => 'Andi Wijaya',
                'password' => bcrypt('password'),
                'role' => 'konseli',
            ]
        );

        // 4. Create Option Group and Items
        $group = OptionGroup::firstOrCreate(['name' => 'Skala Kesejahteraan Psikologis (Wellbeing)']);
        
        $options = [
            ['label' => 'Sangat Sesuai', 'score' => 4, 'order' => 0],
            ['label' => 'Sesuai', 'score' => 3, 'order' => 1],
            ['label' => 'Tidak Sesuai', 'score' => 2, 'order' => 2],
            ['label' => 'Sangat Tidak Sesuai', 'score' => 1, 'order' => 3],
        ];

        foreach ($options as $opt) {
            OptionItem::firstOrCreate(
                [
                    'option_group_id' => $group->id,
                    'label' => $opt['label']
                ],
                [
                    'score' => $opt['score'],
                    'order' => $opt['order']
                ]
            );
        }

        // 5. Create Questions
        $questions = [
            'Saya merasa optimis tentang masa depan saya.',
            'Saya memiliki hubungan yang baik dengan teman-teman sebaya saya.',
            'Saya dapat mengatasi masalah hidup saya dengan baik.',
            'Saya merasa puas dengan kehidupan saya saat ini.',
            'Saya merasa dihargai oleh orang-orang di sekitar saya.',
            'Saya mampu menerima kelebihan dan kekurangan diri saya.',
            'Saya memiliki tujuan hidup yang jelas yang ingin dicapai.',
            'Saya merasa tenang dalam menghadapi tekanan atau stres.',
        ];

        foreach ($questions as $index => $text) {
            Question::firstOrCreate(
                ['text' => $text],
                [
                    'option_group_id' => $group->id,
                    'order' => $index
                ]
            );
        }

        // 6. Create Interpretations
        $interpretations = [
            [
                'min_score' => 8,
                'max_score' => 15,
                'description' => 'Kesejahteraan Psikologis Rendah. Anda mungkin sedang menghadapi tekanan berat atau merasa kurang mendapat dukungan. Sangat disarankan untuk melakukan konseling dengan Konselor Anda.'
            ],
            [
                'min_score' => 16,
                'max_score' => 24,
                'description' => 'Kesejahteraan Psikologis Sedang. Anda memiliki ketahanan mental yang cukup baik, namun masih ada area yang dapat dioptimalkan melalui self-help dan diskusi bersama teman.'
            ],
            [
                'min_score' => 25,
                'max_score' => 32,
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

        // 7. Create Tribes, Materials, Questions (Self-Help)
        $tribe1 = Tribe::firstOrCreate(['name' => 'Suku Jawa']);
        $tribe2 = Tribe::firstOrCreate(['name' => 'Suku Sunda']);

        // Material for Jawa
        $materialJawa = Material::firstOrCreate(
            [
                'tribe_id' => $tribe1->id,
                'title' => 'Filosofi "Alon-alon Waton Kelakon"'
            ],
            [
                'values' => 'Kesabaran, Ketekunan, Kehati-hatian',
                'description' => 'Filosofi ini mengajarkan pentingnya kesabaran dan proses dalam hidup. Bukan berarti lambat dan bermalas-malasan, melainkan melangkah secara matang, hati-hati, konsisten, dan selamat mencapai tujuan tanpa tergesa-gesa.',
                'order' => 0
            ]
        );

        $questionsJawa = [
            ['category' => 'W', 'text' => 'Apa keinginan (Wants) terbesar atau tujuan hidup yang sedang ingin kamu capai saat ini?'],
            ['category' => 'D', 'text' => 'Apa langkah nyata (Doing) yang sudah kamu lakukan secara konsisten untuk mendekati tujuan tersebut?'],
            ['category' => 'E', 'text' => 'Mari evaluasi (Evaluation), apakah selama ini kamu cenderung terburu-buru ataukah sudah melangkah secara matang dan penuh pertimbangan?'],
            ['category' => 'P', 'text' => 'Susun rencana (Planning) langkah kecil yang realistis dan konsisten yang akan kamu ambil mulai besok!'],
        ];

        foreach ($questionsJawa as $index => $q) {
            MaterialQuestion::firstOrCreate(
                [
                    'material_id' => $materialJawa->id,
                    'category' => $q['category']
                ],
                [
                    'text' => $q['text'],
                    'order' => $index
                ]
            );
        }

        // Material for Sunda
        $materialSunda = Material::firstOrCreate(
            [
                'tribe_id' => $tribe2->id,
                'title' => 'Filosofi "Cageur, Bageur, Sengseur, Pinter"'
            ],
            [
                'values' => 'Kesehatan Emosional, Kebaikan Sosial, Keceriaan Hidup, Kebijaksanaan',
                'description' => 'Cageur berarti sehat fisik dan mental. Bageur berarti berakhlak mulia dan penolong. Sengseur bermakna memberikan kebahagiaan dan keceriaan bagi orang lain. Pinter bermakna bijak dan cerdas dalam bertindak.',
                'order' => 0
            ]
        );

        $questionsSunda = [
            ['category' => 'W', 'text' => 'Bagaimana gambaran pribadi ideal (Wants) yang sehat fisik, mental, dan berakhlak baik menurut bayanganmu?'],
            ['category' => 'D', 'text' => 'Apa hal baik (Doing) yang telah kamu berikan kepada dirimu (kesehatan) dan orang lain hari ini?'],
            ['category' => 'E', 'text' => 'Mari evaluasi (Evaluation), aspek manakah dari Cageur, Bageur, Sengseur, atau Pinter yang masih kurang dalam keseharianmu?'],
            ['category' => 'P', 'text' => 'Rencanakan (Planning) aksi sederhana untuk membagikan keceriaan (Sengseur) kepada satu orang teman terdekatmu hari ini!'],
        ];

        foreach ($questionsSunda as $index => $q) {
            MaterialQuestion::firstOrCreate(
                [
                    'material_id' => $materialSunda->id,
                    'category' => $q['category']
                ],
                [
                    'text' => $q['text'],
                    'order' => $index
                ]
            );
        }
    }
}
