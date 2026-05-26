<?php

namespace Database\Seeders;

use App\Models\Tribe;
use App\Models\Material;
use App\Models\MaterialQuestion;
use Illuminate\Database\Seeder;

class BugisMakassarSelfHelpSeeder extends Seeder
{
    public function run(): void
    {
        // Create or find Suku Bugis-Makassar
        $tribe = Tribe::firstOrCreate(['name' => 'Bugis-Makassar']);

        // Data for Bugis-Makassar Self-Help Materials
        $materials = [
            [
                'title' => 'SELF-ACCEPTANCE (PENERIMAAN DIRI)',
                'values' => 'Sipakatau, Cekak Ado',
                'description' => "Sipakatau: prinsip memanusiakan manusia—termasuk diri sendiri—sehingga individu menerima diri dengan penuh penghargaan dan tidak merendahkan diri.\n\nCekak Ado: sikap merasa cukup, yang membantu remaja tidak terjebak dalam perbandingan sosial dan tekanan standar eksternal.\n\nMakna dalam tahap ini: menerima diri secara utuh, realistis, dan bermartabat.",
                'order' => 0,
                'questions' => [
                    ['category' => 'W', 'text' => 'Apa yang kamu inginkan berkaitan dengan penerimaan dirimu sehingga kamu dapat menjaga harga dirimu (sipakatau)?'],
                    ['category' => 'D', 'text' => 'Apa yang telah kamu lakukan agar dapat menerima dirimu seutuhnya sehingga dapat menjaga harga dirimu (sipakatau)?'],
                    ['category' => 'E', 'text' => 'Apakah yang telah kamu lakukan dapat menerima dirimu seutuhnya sehingga dapat menjaga harga dirimu (sipakatau)?'],
                    ['category' => 'P', 'text' => 'Apa yang akan kamu lakukan agar dapat menerima dirimu seutuhnya sehingga dapat menjaga harga dirimu (sipakatau)?'],
                ]
            ],
            [
                'title' => 'POSITIVE RELATIONS (HUBUNGAN POSITIF)',
                'values' => 'Sipakalebbi, Sipakainge',
                'description' => "Sipakalebbi: budaya saling memuliakan, menghargai, dan menjaga perasaan orang lain dalam interaksi sosial.\n\nSipakainge: budaya saling mengingatkan dalam kebaikan secara bijak dan konstruktif.\n\nMakna: membangun relasi yang hangat, suportif, dan beretika.",
                'order' => 1,
                'questions' => [
                    ['category' => 'W', 'text' => 'Apa yang kamu inginkan berkaitan dengan hubungan positif bersama orang lain sehingga dapat membina interaksi sosial yang saling menghargai (Sipakalebbi)?'],
                    ['category' => 'D', 'text' => 'Apa yang telah kamu lakukan dalam hubungan positif dengan orang lain sehingga dapat membina interaksi sosial yang saling menghargai (Sipakalebbi)?'],
                    ['category' => 'E', 'text' => 'Apakah yang telah kamu lakukan dalam hubungan positif dengan orang lain dapat membina interaksi sosial yang saling menghargai (Sipakalebbi)?'],
                    ['category' => 'P', 'text' => 'Apa yang akan kamu lakukan dalam berhubungan positif dengan orang lain sehingga dapat membina interaksi sosial yang saling menghargai (Sipakalebbi)?'],
                ]
            ],
            [
                'title' => 'AUTONOMY (KEMANDIRIAN)',
                'values' => 'Taro Ada Taro Gau, Getteng',
                'description' => "Taro Ada Taro Gau: keselarasan antara ucapan dan tindakan sebagai bentuk integritas diri.\n\nGetteng: keteguhan pendirian dalam memegang prinsip meskipun menghadapi tekanan sosial.\n\nMakna: kemandirian berbasis integritas, bukan sekadar kebebasan.",
                'order' => 2,
                'questions' => [
                    ['category' => 'W', 'text' => 'Apa yang kamu inginkan berkaitan dengan kemandirianmu sehingga kamu dapat menjaga integritas dirimu (Taro Ada Taro Gau, Getteng)?'],
                    ['category' => 'D', 'text' => 'Apa yang telah kamu lakukan berkaitan dengan kemandirianmu agar dapat menjaga integritas dirimu (Taro Ada Taro Gau, Getteng)?'],
                    ['category' => 'E', 'text' => 'Apakah yang telah kamu lakukan berkaitan dengan kemandirianmu dapat menjaga integritas dirimu (Taro Ada Taro Gau, Getteng)?'],
                    ['category' => 'P', 'text' => 'Apa yang akan kamu lakukan berkaitan dengan kemandirianmu sehingga dapat menjaga integritas dirimu (Taro Ada Taro Gau, Getteng)?'],
                ]
            ],
            [
                'title' => 'ENVIRONMENTAL MASTERY (PENGUASAAN LINGKUNGAN)',
                'values' => 'Tellu Cappa, Sipakatau',
                'description' => "Tellu Cappa: strategi hidup yang terdiri dari tiga kekuatan—komunikasi (cappa lila), keteguhan (cappa badik), dan relasi (cappa pantulu).\n\nSipakatau: menjaga sikap manusiawi dalam interaksi sosial sebagai dasar adaptasi.\n\nMakna: kemampuan mengelola situasi dengan strategi yang tepat dan beretika.",
                'order' => 3,
                'questions' => [
                    ['category' => 'W', 'text' => 'Apa yang kamu inginkan berkaitan dengan penguasaan lingkungan sehingga dapat berinteraksi sosial dengan baik (Tellu Cappa, Sipakatau)?'],
                    ['category' => 'D', 'text' => 'Apa yang telah kamu lakukan berkaitan dengan penguasaan lingkungan agar dapat berinteraksi sosial dengan baik (Tellu Cappa, Sipakatau)?'],
                    ['category' => 'E', 'text' => 'Apakah yang telah kamu lakukan berkaitan dengan penguasaan lingkungan dapat membantumu mampu berinteraksi sosial dengan baik (Tellu Cappa, Sipakatau)?'],
                    ['category' => 'P', 'text' => 'Apa yang akan kamu lakukan berkaitan dengan penguasaan lingkungan sehingga dapat berinteraksi sosial dengan baik (Tellu Cappa, Sipakatau)?'],
                ]
            ],
            [
                'title' => 'PURPOSE IN LIFE (TUJUAN HIDUP)',
                'values' => 'Sipakatau (kontribusi hidup)',
                'description' => "Sipakatau (makna hidup): hidup dipandang bermakna ketika mampu memberi manfaat dan menghargai sesama manusia.\n\nMakna: hidup yang berorientasi pada kontribusi, bukan hanya kepentingan pribadi.",
                'order' => 4,
                'questions' => [
                    ['category' => 'W', 'text' => 'Apa tujuan hidup bermakna bagi diri dan orang lain (sipakatau) yang ingin kamu capai?'],
                    ['category' => 'D', 'text' => 'Apa yang telah kamu lakukan untuk mencapai tujuan hidup bermakna bagi diri dan orang lain (sipakatau)?'],
                    ['category' => 'E', 'text' => 'Apakah yang telah kamu lakukan dapat membantumu mencapai tujuan hidup bermakna bagi diri dan orang lain (sipakatau)?'],
                    ['category' => 'P', 'text' => 'Apa yang akan kamu lakukan agar dapat mencapai tujuan hidup bermakna bagi diri dan orang lain (sipakatau)?'],
                ]
            ],
            [
                'title' => 'PERSONAL GROWTH (PERTUMBUHAN PRIBADI)',
                'values' => 'Resopa Temmangingngi, Getteng',
                'description' => "Resopa Temmangingngi: etos kerja keras dan kesungguhan sebagai jalan menuju keberhasilan.\n\nGetteng: keteguhan untuk tetap konsisten dalam proses pengembangan diri.\n\nMakna: pertumbuhan melalui usaha yang konsisten dan tidak mudah menyerah.",
                'order' => 5,
                'questions' => [
                    ['category' => 'W', 'text' => 'Apa yang kamu inginkan berkaitan dengan perkembangan dirimu sehingga dapat menjaga keteguhan untuk tetap konsisten dalam pengembangan diri tersebut (Resopa Temmangingngi, Getteng)?'],
                    ['category' => 'D', 'text' => 'Apa yang telah kamu lakukan agar dapat mengembangkan dirimu seutuhnya sehingga dapat menjaga keteguhan untuk tetap konsisten dalam proses pengembangan tersebut (Resopa Temmangingngi, Getteng)?'],
                    ['category' => 'E', 'text' => 'Apakah yang telah kamu lakukan dapat mengembangkan dirimu seutuhnya sehingga dapat menjaga keteguhan untuk tetap konsisten dalam pengembangan tersebut (Resopa Temmangingngi, Getteng)?'],
                    ['category' => 'P', 'text' => 'Apa yang akan kamu lakukan agar dapat mengembangkan dirimu seutuhnya sehingga dapat menjaga keteguhan untuk tetap konsisten dalam proses pengembangan tersebut (Resopa Temmangingngi, Getteng)?'],
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
