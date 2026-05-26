<?php

namespace Database\Seeders;

use App\Models\OptionGroup;
use App\Models\OptionItem;
use App\Models\Question;
use Illuminate\Database\Seeder;

class WellbeingQuestionSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Create Sangat Setuju (Positif) Option Group and Items
        $groupPositif = OptionGroup::firstOrCreate(['name' => 'Sangat Setuju (Positif)']);
        
        $optionsPositif = [
            ['label' => 'Sangat Setuju', 'score' => 5, 'order' => 0],
            ['label' => 'Setuju', 'score' => 4, 'order' => 1],
            ['label' => 'Netral', 'score' => 3, 'order' => 2],
            ['label' => 'Tidak Setuju', 'score' => 2, 'order' => 3],
            ['label' => 'Sangat Tidak Setuju', 'score' => 1, 'order' => 4],
        ];

        foreach ($optionsPositif as $opt) {
            OptionItem::firstOrCreate(
                [
                    'option_group_id' => $groupPositif->id,
                    'label' => $opt['label']
                ],
                [
                    'score' => $opt['score'],
                    'order' => $opt['order']
                ]
            );
        }

        // 2. Create Sangat Setuju (Negatif) Option Group and Items
        $groupNegatif = OptionGroup::firstOrCreate(['name' => 'Sangat Setuju (Negatif)']);
        
        $optionsNegatif = [
            ['label' => 'Sangat Setuju', 'score' => 1, 'order' => 0],
            ['label' => 'Setuju', 'score' => 2, 'order' => 1],
            ['label' => 'Netral', 'score' => 3, 'order' => 2],
            ['label' => 'Tidak Setuju', 'score' => 4, 'order' => 3],
            ['label' => 'Sangat Tidak Setuju', 'score' => 5, 'order' => 4],
        ];

        foreach ($optionsNegatif as $opt) {
            OptionItem::firstOrCreate(
                [
                    'option_group_id' => $groupNegatif->id,
                    'label' => $opt['label']
                ],
                [
                    'score' => $opt['score'],
                    'order' => $opt['order']
                ]
            );
        }

        // 3. Create Questions
        $questionsData = [
            ['type' => 'P', 'text' => 'Saya mampu mengambil keputusan secara mandiri.'],
            ['type' => 'P', 'text' => 'Saya yakin terhadap pilihan yang saya tentukan.'],
            ['type' => 'P', 'text' => 'Saya mampu menghadapi permasalahan yang ada di sekolah.'],
            ['type' => 'P', 'text' => 'Saya mampu mengelola waktu dengan baik.'],
            ['type' => 'P', 'text' => 'Saya bertanggung jawab untuk berkembang menjadi pribadi yang lebih baik.'],
            ['type' => 'N', 'text' => 'Saya merasa pesimis untuk menjadi orang yang unggul.'],
            ['type' => 'P', 'text' => 'Saya memiliki teman dekat.'],
            ['type' => 'N', 'text' => 'Saya mengalami kesulitan menerima orang baru.'],
            ['type' => 'P', 'text' => 'Saya menerima kritik secara positif dari orang lain terhadap diri saya .'],
            ['type' => 'P', 'text' => 'Saya bangga pada diri saya apa adanya.'],
            ['type' => 'P', 'text' => 'Saya merasa bahwa hidup saya bermakna baik pada masa lalu maupun sekarang.'],
            ['type' => 'N', 'text' => 'Mempertahankan arah hidup yang jelas sama dengan mempermudah pencapaian tujuan yang diharapkan'],
            ['type' => 'P', 'text' => 'Saya memiliki hubungan yang baik dengan warga sekolah.'],
            ['type' => 'P', 'text' => 'Saya menyukai hal-hal baru untuk belajar.'],
            ['type' => 'P', 'text' => 'Saya menolak sesuatu yang tidak sesuai dengan keyakinan saya.'],
            ['type' => 'N', 'text' => 'Saya terbiasa dibantu dalam melakukan suatu pekerjaan.'],
            ['type' => 'P', 'text' => 'Saya menyukai tantangan untuk mengembangkan diri saya.'],
            ['type' => 'P', 'text' => 'Saya memiliki tujuan kedepannya yang ingin dicapai.'],
            ['type' => 'N', 'text' => 'Saya merasa sulit memelihara makna/arti positif dalam hidup saya.'],
            ['type' => 'P', 'text' => 'Saya menerima kelebihan dan/atau kekurangan yang saya miliki.'],
            ['type' => 'N', 'text' => 'Saya memiliki pandangan yang negatif terhadap kemampuan saya sendiri.'],
            ['type' => 'P', 'text' => 'Saya merasa mampu untuk mencapai tujuan yang diharapkan.'],
            ['type' => 'N', 'text' => 'Saya mudah terpengaruh pandangan orang di sekitar saya.'],
            ['type' => 'N', 'text' => 'Saya sulit menyesuaikan lingkungan untuk mendukung perkembangan diri saya.'],
            ['type' => 'N', 'text' => 'Saya abai dengan waktu yang saya miliki'],
            ['type' => 'N', 'text' => 'Saya sulit menemukan potensi yang saya miliki'],
            ['type' => 'P', 'text' => 'Saya mampu memberikan dukungan kepada orang lain untuk berkembang.'],
            ['type' => 'N', 'text' => 'Saya membandingkan capaian diri saya dengan capaian orang lain yang lebih berhasil.'],
            ['type' => 'N', 'text' => 'Saya bersikap masa bodoh dengan orang lain di sekitar saya.'],
            ['type' => 'P', 'text' => 'Saya mampu memanfaatkan kesempatan secara efektif.'],
        ];

        foreach ($questionsData as $index => $q) {
            $groupId = ($q['type'] === 'P') ? $groupPositif->id : $groupNegatif->id;

            Question::firstOrCreate(
                ['text' => $q['text']],
                [
                    'option_group_id' => $groupId,
                    'order' => $index + 1
                ]
            );
        }
    }
}
