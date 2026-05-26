<?php

namespace Database\Seeders;

use App\Models\Tribe;
use App\Models\Material;
use App\Models\MaterialQuestion;
use Illuminate\Database\Seeder;

class JawaSelfHelpSeeder extends Seeder
{
    public function run(): void
    {
        // Create or find Suku Jawa
        $tribe = Tribe::firstOrCreate(['name' => 'Jawa']);

        // Data for Jawa Self-Help Materials
        $materials = [
            [
                'title' => 'SELF-ACCEPTANCE (PENERIMAAN DIRI)',
                'values' => 'Nrimo ing Pandum, Wong Jeneng Jenang',
                'description' => "Nrimo ing Pandum: sikap menerima dengan kesadaran aktif atas apa yang dimiliki tanpa menyerah, melainkan tetap berusaha secara realistis.\n\nWong Jeneng Jenang: menekankan bahwa kehormatan (jeneng/nama baik) lebih penting daripada materi (jenang), sehingga individu menghargai diri berdasarkan nilai, bukan pencapaian eksternal.\n\nMakna: menerima diri secara realistis, bermartabat, dan tidak terjebak perbandingan sosial.",
                'order' => 0,
                'questions' => [
                    ['category' => 'W', 'text' => 'Apa yang kamu inginkan berkaitan dengan penerimaan dirimu apa adanya sehingga dapat menjaga kehormatan dirimu (Nrimo ing Pandum, Wong Jeneng Jenang)?'],
                    ['category' => 'D', 'text' => 'Apa yang telah kamu lakukan agar dapat menerima dirimu apa adanya sehingga dapat menjaga kehormatan dirimu (Nrimo ing Pandum, Wong Jeneng Jenang)?'],
                    ['category' => 'E', 'text' => 'Apakah yang telah kamu lakukan dapat membantumu untuk menerima dirimu apa adanya sehingga dapat menjaga kehormatan dirimu (Nrimo ing Pandum, Wong Jeneng Jenang)?'],
                    ['category' => 'P', 'text' => 'Apa yang akan kamu lakukan agar dapat menerima dirimu apa adanya sehingga dapat menjaga kehormatan dirimu (Nrimo ing Pandum, Wong Jeneng Jenang)?'],
                ]
            ],
            [
                'title' => 'POSITIVE RELATIONS (HUBUNGAN POSITIF)',
                'values' => 'Tepa Selira, Guyub Rukun',
                'description' => "Tepa Selira: kemampuan menempatkan diri pada posisi orang lain (empati), sehingga perilaku menjadi lebih sensitif dan menghargai.\n\nGuyub Rukun: nilai kebersamaan dan keharmonisan dalam hubungan sosial.\n\nMakna: hubungan yang harmonis, saling menghargai, dan minim konflik.",
                'order' => 1,
                'questions' => [
                    ['category' => 'W', 'text' => 'Apa yang kamu inginkan berkaitan dengan hubungan positif bersama orang lain sehingga dapat membina keharmonisan hubungan sosial yang saling menghargai (tepa Selira, guyub rukun)?'],
                    ['category' => 'D', 'text' => 'Apa yang telah kamu lakukan dalam hubungan positif dengan orang lain sehingga dapat membina keharmonisan hubungan sosial yang saling menghargai (tepa Selira, guyub rukun)?'],
                    ['category' => 'E', 'text' => 'Apakah yang telah kamu lakukan dalam berhubungan positif dengan orang lain dapat membina keharmonisan hubungan sosial (tepa Selira, guyub rukun)?'],
                    ['category' => 'P', 'text' => 'Apa yang akan kamu lakukan dalam berhubungan positif dengan orang lain agar dapat membina keharmonisan hubungan sosial (tepa Selira, guyub rukun)?'],
                ]
            ],
            [
                'title' => 'AUTONOMY (KEMANDIRIAN)',
                'values' => 'Eling lan Waspada, Wani Ngalah',
                'description' => "Eling lan Waspada: kesadaran diri dan kewaspadaan dalam berpikir serta bertindak, sehingga keputusan tidak impulsif.\n\nWani Ngalah: kemampuan mengendalikan ego dengan bijak, bukan karena lemah, tetapi demi kebaikan yang lebih besar.\n\nMakna: kemandirian yang disertai kontrol diri dan kebijaksanaan.",
                'order' => 2,
                'questions' => [
                    ['category' => 'W', 'text' => 'Apa yang kamu inginkan berkaitan dengan kemandirianmu sehingga kamu dapat mengendalikan dirimu dengan bijaksana (Eling lan Waspada, Wani Ngalah)?'],
                    ['category' => 'D', 'text' => 'Apa yang telah kamu lakukan berkaitan dengan kemandirianmu agar dapat mengendalikan dirimu dengan bijaksana (Eling lan Waspada, Wani Ngalah)?'],
                    ['category' => 'E', 'text' => 'Apakah yang telah kamu lakukan berkaitan dengan kemandirianmu dapat mengendalikan dirimu dengan bijaksana (Eling lan Waspada, Wani Ngalah)?'],
                    ['category' => 'P', 'text' => 'Apa yang akan kamu lakukan berkaitan dengan kemandirianmu agar dapat mengendalikan dirimu secara bijaksana (Eling lan Waspada, Wani Ngalah)?'],
                ]
            ],
            [
                'title' => 'ENVIRONMENTAL MASTERY (PENGUASAAN LINGKUNGAN)',
                'values' => 'Empan Papan',
                'description' => "Empan Papan: kemampuan menempatkan diri secara tepat sesuai situasi, kondisi, dan konteks sosial.\n\nMakna: adaptasi sosial yang cerdas dan kontekstual.",
                'order' => 3,
                'questions' => [
                    ['category' => 'W', 'text' => 'Apa yang kamu inginkan berkaitan dengan penguasaan lingkungan sehingga dapat menyesuaikan diri dengan lingkungan sosial secara baik (Empan Papan)?'],
                    ['category' => 'D', 'text' => 'Apa yang telah kamu lakukan berkaitan dengan penguasaan lingkungan agar dapat menyesuaikan diri dengan lingkungan sosial secara baik (Empan Papan)?'],
                    ['category' => 'E', 'text' => 'Apakah yang telah kamu lakukan berkaitan dengan penguasaan lingkungan dapat membantumu untuk mampu menyesuaikan diri dengan lingkungan sosial secara baik (Empan Papan)?'],
                    ['category' => 'P', 'text' => 'Apa yang akan kamu lakukan berkaitan dengan penguasaan lingkungan agar dapat menyesuaikan diri dengan lingkungan sosial secara baik (Empan Papan)?'],
                ]
            ],
            [
                'title' => 'PURPOSE IN LIFE (TUJUAN HIDUP)',
                'values' => 'Urip Iku Urup, Sangkan Paraning Dumadi',
                'description' => "Urip Iku Urup: hidup harus memberi manfaat bagi orang lain.\n\nSangkan Paraning Dumadi: kesadaran tentang asal-usul dan tujuan hidup manusia, sehingga hidup memiliki arah yang jelas.\n\nMakna: hidup yang bermakna, terarah, dan bermanfaat.",
                'order' => 4,
                'questions' => [
                    ['category' => 'W', 'text' => 'Apa tujuan hidup bermakna bagi diri and orang lain (Urip Iku Urup, Sangkan Paraning Dumadi) yang ingin kamu capai?'],
                    ['category' => 'D', 'text' => 'Apa yang telah kamu lakukan untuk mencapai tujuan hidup bermakna bagi diri dan orang lain (Urip Iku Urup, Sangkan Paraning Dumadi)?'],
                    ['category' => 'E', 'text' => 'Apakah yang telah kamu lakukan dapat membantumu mencapai tujuan hidup bermakna bagi diri dan orang lain (Urip Iku Urup, Sangkan Paraning Dumadi)?'],
                    ['category' => 'P', 'text' => 'Apa yang akan kamu lakukan agar dapat mencapai tujuan hidup bermakna bagi diri dan orang lain (Urip Iku Urup, Sangkan Paraning Dumadi)?'],
                ]
            ],
            [
                'title' => 'PERSONAL GROWTH (PERTUMBUHAN PRIBADI)',
                'values' => 'Laku Prihatin',
                'description' => "Laku Prihatin: praktik pengendalian diri dan kesungguhan dalam menjalani proses kehidupan untuk mencapai kematangan diri.\n\nMakna: pertumbuhan melalui disiplin, ketekunan, dan refleksi diri.",
                'order' => 5,
                'questions' => [
                    ['category' => 'W', 'text' => 'Apa yang kamu inginkan berkaitan dengan perkembangan dirimu sehingga kamu dapat menjaga pengendalian diri dan kesungguhan dalam perkembangan tersebut (laku prihatin)?'],
                    ['category' => 'D', 'text' => 'Apa yang telah kamu lakukan agar dapat mengembangkan dirimu sehingga dapat menjaga pengendalian diri dan kesungguhan dalam perkembangan tersebut (laku prihatin)?'],
                    ['category' => 'E', 'text' => 'Apakah yang telah kamu lakukan dapat mengembangkan dirimu sehingga dapat menjaga pengendalian diri dan kesungguhan dalam perkembangan tersebut (laku prihatin)?'],
                    ['category' => 'P', 'text' => 'Apa yang akan kamu lakukan agar dapat mengembangkan dirimu sehingga dapat menjaga pengendalian diri dan kesungguhan dalam perkembangan tersebut (laku prihatin)?'],
                ]
            ],
        ];

        foreach ($materials as $mdata) {
            $material = Material::firstOrCreate(
                [
                    'tribe_id' => $tribe->id,
                    'title' => $mdata['title'],
                ],
                [
                    'values' => $mdata['values'],
                    'description' => $mdata['description'],
                    'order' => $mdata['order'],
                ]
            );

            foreach ($mdata['questions'] as $qindex => $q) {
                MaterialQuestion::firstOrCreate(
                    [
                        'material_id' => $material->id,
                        'category' => $q['category'],
                    ],
                    [
                        'text' => $q['text'],
                        'order' => $qindex,
                    ]
                );
            }
        }
    }
}
