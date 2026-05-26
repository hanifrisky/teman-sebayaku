<?php

namespace Database\Seeders;

use App\Models\Tribe;
use App\Models\Material;
use App\Models\MaterialQuestion;
use Illuminate\Database\Seeder;

class MinangPadangSelfHelpSeeder extends Seeder
{
    public function run(): void
    {
        // Create or find Suku Minang-Padang
        $tribe = Tribe::firstOrCreate(['name' => 'Minang-Padang']);

        // Data for Minang-Padang Self-Help Materials
        $materials = [
            [
                'title' => 'SELF-ACCEPTANCE (PENERIMAAN DIRI)',
                'values' => 'Ukua Tinggi Jo Bayang-bayang, Raso jo Pareso',
                'description' => "Ukua Tinggi Jo Bayang-bayang: menilai diri secara realistis sesuai kapasitas—tidak memaksakan diri di luar kemampuan.\n\nRaso jo Pareso: keseimbangan rasa (empati/intuisi) dan nalar (pertimbangan logis) dalam memahami diri.\n\nMakna: menerima diri secara realistis, jujur, dan proporsional.",
                'order' => 0,
                'questions' => [
                    ['category' => 'W', 'text' => 'Apa yang kamu inginkan berkaitan dengan penerimaan dirimu secara realistis (Ukua Tinggi Jo Bayang-bayang)?'],
                    ['category' => 'D', 'text' => 'Apa yang telah kamu lakukan agar dapat menerima dirimu secara realistis (Ukua Tinggi Jo Bayang-bayang)?'],
                    ['category' => 'E', 'text' => 'Apakah yang telah kamu lakukan dapat membantumu menerima dirimu secara realistis (Ukua Tinggi Jo Bayang-bayang)?'],
                    ['category' => 'P', 'text' => 'Apa yang akan kamu lakukan agar dapat menerima dirimu secara realistis (Ukua Tinggi Jo Bayang-bayang)?'],
                ]
            ],
            [
                'title' => 'POSITIVE RELATIONS (HUBUNGAN POSITIF)',
                'values' => 'Kato Nan Ampek, Dunsanak',
                'description' => "Kato Nan Ampek: etika komunikasi Minangkabau (kato mandaki, manurun, mandata, malereng) yang mengajarkan berbicara sesuai konteks dan lawan bicara.\n\nDunsanak: konsep persaudaraan yang menekankan kedekatan sosial dan solidaritas.\n\nMakna: komunikasi santun dan relasi yang hangat seperti keluarga.",
                'order' => 1,
                'questions' => [
                    ['category' => 'W', 'text' => 'Apa yang kamu inginkan berkaitan dengan hubungan positif bersama orang lain sehingga dapat berkomunikasi santun dan berelasi yang hangat seperti keluarga (kato nan ampek, dunsanak)?'],
                    ['category' => 'D', 'text' => 'Apa yang telah kamu lakukan dalam hubungan positif dengan orang lain sehingga dapat berkomunikasi santun dan berelasi yang hangat seperti keluarga (kato nan ampek, dunsanak)?'],
                    ['category' => 'E', 'text' => 'Apakah yang telah kamu lakukan dalam berhubungan positif dengan orang lain dapat membantumu berkomunikasi santun dan berelasi yang hangat seperti keluarga (kato nan ampek, dunsanak)?'],
                    ['category' => 'P', 'text' => 'Apa yang akan kamu lakukan dalam berhubungan positif dengan orang lain agar dapat berkomunikasi santun dan berelasi yang hangat seperti keluarga (kato nan ampek, dunsanak)?'],
                ]
            ],
            [
                'title' => 'AUTONOMY (KEMANDIRIAN)',
                'values' => 'Merantau, Raso jo Pareso',
                'description' => "Merantau: tradisi kemandirian—remaja didorong mengambil keputusan dan bertanggung jawab di lingkungan baru.\n\nRaso jo Pareso: menjadi dasar dalam pengambilan keputusan yang matang dan bijaksana.\n\nMakna: kemandirian dalam mengambil keputusan berbasis pertimbangan yang matang.",
                'order' => 2,
                'questions' => [
                    ['category' => 'W', 'text' => 'Apa yang kamu inginkan berkaitan dengan kemandirianmu sehingga kamu dapat mengambil keputusan berdasarkan pertimbangan yang matang (Merantau, Raso jo Pareso)?'],
                    ['category' => 'D', 'text' => 'Apa yang telah kamu lakukan berkaitan dengan kemandirianmu agar dapat mengambil keputusan berdasarkan pertimbangan yang matang (Merantau, Raso jo Pareso)?'],
                    ['category' => 'E', 'text' => 'Apakah yang telah kamu lakukan berkaitan dengan kemandirianmu dapat membantumu mengambil keputusan berdasarkan pertimbangan yang matang (Merantau, Raso jo Pareso)?'],
                    ['category' => 'P', 'text' => 'Apa yang akan kamu lakukan berkaitan dengan kemandirianmu agar dapat mengambil keputusan berdasarkan pertimbangan yang matang (Merantau, Raso jo Pareso)?'],
                ]
            ],
            [
                'title' => 'ENVIRONMENTAL MASTERY (PENGUASAAN LINGKUNGAN)',
                'values' => 'Dima Bumi Dipijak, Disinan Langik Dijunjung',
                'description' => "Prinsip adaptasi universal: di mana pun berada, seseorang harus menghormati norma dan aturan setempat.\n\nMakna: kemampuan beradaptasi secara fleksibel tanpa kehilangan jati diri.",
                'order' => 3,
                'questions' => [
                    ['category' => 'W', 'text' => 'Apa yang kamu inginkan berkaitan dengan penguasaan lingkungan sehingga dapat menyesuaikan diri dengan lingkungan sosial secara luwes (dima bumi dipijak, disinan langik dijunjung)?'],
                    ['category' => 'D', 'text' => 'Apa yang telah kamu lakukan berkaitan dengan penguasaan lingkungan agar dapat menyesuaikan diri dengan lingkungan sosial secara luwes (dima bumi dipijak, disinan langik dijunjung)?'],
                    ['category' => 'E', 'text' => 'Apakah yang telah kamu lakukan berkaitan dengan penguasaan lingkungan dapat membantumu mampu menyesuaikan diri dengan lingkungan sosial secara luwes (dima bumi dipijak, disinan langik dijunjung)?'],
                    ['category' => 'P', 'text' => 'Apa yang akan kamu lakukan berkaitan dengan penguasaan lingkungan agar dapat menyesuaikan diri dengan lingkungan sosial secara luwes (dima bumi dipijak, disinan langik dijunjung)?'],
                ]
            ],
            [
                'title' => 'PURPOSE IN LIFE (TUJUAN HIDUP)',
                'values' => 'Adat Basandi Syarak, Syarak Basandi Kitabullah (ABS-SBK)',
                'description' => "Prinsip dasar Minangkabau bahwa kehidupan harus berlandaskan adat dan ajaran agama, sehingga tujuan hidup memiliki arah moral dan spiritual yang jelas.\n\nMakna: hidup yang terarah, bermakna, dan sesuai nilai agama serta budaya.",
                'order' => 4,
                'questions' => [
                    ['category' => 'W', 'text' => 'Apa tujuan hidup bermakna sesuai adat dan agama (Adat Basandi Syarak, Syarak Basandi Kitabullah) yang ingin kamu capai?'],
                    ['category' => 'D', 'text' => 'Apa yang telah kamu lakukan untuk mencapai tujuan hidup bermakna sesuai adat dan agama (Adat Basandi Syarak, Syarak Basandi Kitabullah)?'],
                    ['category' => 'E', 'text' => 'Apakah yang telah kamu lakukan dapat membantumu mencapai tujuan hidup bermakna sesuai adat dan agama (Adat Basandi Syarak, Syarak Basandi Kitabullah)?'],
                    ['category' => 'P', 'text' => 'Apa yang akan kamu lakukan agar dapat mencapai tujuan hidup bermakna sesuai adat dan agama (Adat Basandi Syarak, Syarak Basandi Kitabullah)?'],
                ]
            ],
            [
                'title' => 'PERSONAL GROWTH (PERTUMBUHAN PRIBADI)',
                'values' => 'Alam Takambang Jadi Guru',
                'description' => "Falsafah bahwa alam dan pengalaman hidup adalah guru terbaik untuk belajar dan berkembang.\n\nMakna: pertumbuhan melalui pengalaman, refleksi, dan pembelajaran berkelanjutan.",
                'order' => 5,
                'questions' => [
                    ['category' => 'W', 'text' => 'Apa yang kamu inginkan berkaitan dengan perkembangan dirimu sehingga kamu dapat bertumbuh melalui pengalaman dan refleksi yang berkelanjutan (alam takambang jadi guru)?'],
                    ['category' => 'D', 'text' => 'Apa yang telah kamu lakukan agar dapat mengembangkan dirimu sehingga dapat bertumbuh melalui pengalaman dan refleksi yang berkelanjutan (alam takambang jadi guru)?'],
                    ['category' => 'E', 'text' => 'Apakah yang telah kamu lakukan dapat mengembangkan dirimu sehingga dapat bertumbuh melalui pengalaman dan refleksi yang berkelanjutan (alam takambang jadi guru)?'],
                    ['category' => 'P', 'text' => 'Apa yang akan kamu lakukan agar dapat mengembangkan dirimu sehingga dapat bertumbuh melalui pengalaman dan refleksi yang berkelanjutan (alam takambang jadi guru)?'],
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
