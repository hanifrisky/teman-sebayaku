<?php

namespace Database\Seeders;

use App\Models\Tribe;
use App\Models\Material;
use App\Models\MaterialQuestion;
use Illuminate\Database\Seeder;

class SasakLombokSelfHelpSeeder extends Seeder
{
    public function run(): void
    {
        // Create or find Suku Sasak-Lombok
        $tribe = Tribe::firstOrCreate(['name' => 'Sasak-Lombok']);

        // Data for Sasak-Lombok Self-Help Materials
        $materials = [
            [
                'title' => 'SELF-ACCEPTANCE (PENERIMAAN DIRI)',
                'values' => 'Nerimak/Ikhlas, Sejati, Tindih',
                'description' => "Nerimak/Ikhlas: sikap menerima dengan kesadaran spiritual, bukan pasrah pasif, tetapi tetap berusaha dengan hati lapang.\n\nSejati: keaslian diri—menjadi diri sendiri tanpa mengikuti tekanan sosial.\n\nTindih: keteguhan dalam menjaga prinsip dan nilai kemanusiaan.\n\nMakna: menerima diri secara utuh, autentik, dan tetap teguh pada nilai diri.",
                'order' => 0,
                'questions' => [
                    ['category' => 'W', 'text' => 'Apa yang kamu inginkan berkaitan dengan penerimaan dirimu secara utuh, otentik, dan tetap teguh pada nilai diri (nerimak/ikhlas, sejati, tindih)?'],
                    ['category' => 'D', 'text' => 'Apa yang telah kamu lakukan agar dapat menerima dirimu secara utuh, otentik, dan tetap teguh pada nilai diri (nerimak/ikhlas, sejati, tindih)?'],
                    ['category' => 'E', 'text' => 'Apakah yang telah kamu lakukan dapat membantumu menerima dirimu secara utuh, otentik, dan tetap teguh pada nilai diri (nerimak/ikhlas, sejati, tindih)?'],
                    ['category' => 'P', 'text' => 'Apa yang akan kamu lakukan agar dapat menerima dirimu secara utuh, otentik, dan tetap teguh pada nilai diri (nerimak/ikhlas, sejati, tindih)?'],
                ]
            ],
            [
                'title' => 'POSITIVE RELATIONS (HUBUNGAN POSITIF)',
                'values' => 'Besiru/Begawe',
                'description' => "Besiru/Begawe: tradisi gotong royong dalam masyarakat Sasak yang menekankan kerja sama, kebersamaan, dan saling membantu.\n\nMakna: hubungan sosial yang kolaboratif dan saling mendukung.",
                'order' => 1,
                'questions' => [
                    ['category' => 'W', 'text' => 'Apa yang kamu inginkan berkaitan dengan hubungan positif bersama orang lain sehingga dapat berhubungan sosial yang kolaboratif dan saling mendukung (besiru/begawe)?'],
                    ['category' => 'D', 'text' => 'Apa yang telah kamu lakukan dalam hubungan positif dengan orang lain sehingga dapat berhubungan sosial yang kolaboratif dan saling mendukung (besiru/begawe)?'],
                    ['category' => 'E', 'text' => 'Apakah yang telah kamu lakukan dalam berhubungan positif dengan orang lain dapat membantumu berhubungan sosial yang kolaboratif dan saling mendukung (besiru/begawe)?'],
                    ['category' => 'P', 'text' => 'Apa yang akan kamu lakukan dalam berhubungan positif dengan orang lain agar dapat berhubungan sosial yang kolaboratif dan saling mendukung (besiru/begawe)?'],
                ]
            ],
            [
                'title' => 'AUTONOMY (KEMANDIRIAN)',
                'values' => 'Tindih',
                'description' => "Tindih: keteguhan dalam memegang prinsip dan nilai, sehingga individu mampu berdiri sendiri dan tidak mudah terpengaruh.\n\nMakna: kemandirian yang berlandaskan prinsip yang kuat.",
                'order' => 2,
                'questions' => [
                    ['category' => 'W', 'text' => 'Apa yang kamu inginkan berkaitan dengan kemandirianmu sehingga mampu berdiri sendiri dan tidak mudah terpengaruh orang lain (tindih)?'],
                    ['category' => 'D', 'text' => 'Apa yang telah kamu lakukan berkaitan dengan kemandirianmu agar mampu berdiri sendiri dan tidak mudah terpengaruh orang lain (tindih)?'],
                    ['category' => 'E', 'text' => 'Apakah yang telah kamu lakukan berkaitan dengan kemandirianmu dapat membantumu mampu berdiri sendiri dan tidak mudah terpengaruh orang lain (tindih)?'],
                    ['category' => 'P', 'text' => 'Apa yang akan kamu lakukan berkaitan dengan kemandirianmu agar mampu berdiri sendiri dan tidak mudah terpengaruh orang lain (tindih)?'],
                ]
            ],
            [
                'title' => 'ENVIRONMENTAL MASTERY (PENGUASAAN LINGKUNGAN)',
                'values' => 'Awig-awig',
                'description' => "Awig-awig: aturan adat yang mengatur kehidupan sosial masyarakat Sasak, menjadi pedoman dalam bertindak dan berinteraksi.\n\nMakna: kemampuan menyesuaikan diri dengan aturan sosial secara bijak.",
                'order' => 3,
                'questions' => [
                    ['category' => 'W', 'text' => 'Apa yang kamu inginkan berkaitan dengan penguasaan lingkungan sehingga dapat menyesuaikan diri dengan aturan sosial secara bijaksana (awig-awig)?'],
                    ['category' => 'D', 'text' => 'Apa yang telah kamu lakukan berkaitan dengan penguasaan lingkungan agar dapat menyesuaikan diri dengan aturan sosial secara bijaksana (awig-awig)?'],
                    ['category' => 'E', 'text' => 'Apakah yang telah kamu lakukan berkaitan dengan penguasaan lingkungan dapat membantumu mampu menyesuaikan diri dengan aturan sosial secara bijaksana (awig-awig)?'],
                    ['category' => 'P', 'text' => 'Apa yang akan kamu lakukan berkaitan dengan penguasaan lingkungan agar mampu menyesuaikan diri dengan aturan sosial secara bijaksana (awig-awig)?'],
                ]
            ],
            [
                'title' => 'PURPOSE IN LIFE (TUJUAN HIDUP)',
                'values' => 'Nerimak/Ikhlas (makna hidup spiritual)',
                'description' => "Nerimak/Ikhlas (dimensi makna hidup): memberikan ketenangan batin karena hidup dijalani dengan kesadaran spiritual dan penerimaan terhadap proses kehidupan.\n\nMakna: hidup yang bermakna, tenang, dan terarah secara spiritual.",
                'order' => 4,
                'questions' => [
                    ['category' => 'W', 'text' => 'Apa tujuan hidup bermakna, tenang, dan terarah secara spiritual (nerimak/ikhlas) yang ingin kamu capai?'],
                    ['category' => 'D', 'text' => 'Apa yang telah kamu lakukan untuk mencapai tujuan hidup bermakna, tenang, dan terarah secara spiritual (nerimak/ikhlas)?'],
                    ['category' => 'E', 'text' => 'Apakah yang telah kamu lakukan dapat membantumu mencapai tujuan hidup bermakna, tenang, dan terarah secara spiritual (nerimak/ikhlas)?'],
                    ['category' => 'P', 'text' => 'Apa yang akan kamu lakukan agar dapat mencapai tujuan hidup bermakna, tenang, dan terarah secara spiritual (nerimak/ikhlas)?'],
                ]
            ],
            [
                'title' => 'PERSONAL GROWTH (PERTUMBUHAN PRIBADI)',
                'values' => 'Tatas, Tuhu, Trasna',
                'description' => "Tatas: keteraturan dan kedisiplinan dalam menjalani hidup.\n\nTuhu: kejujuran dan kesungguhan dalam berproses.\n\nTrasna: kasih sayang sebagai dasar dalam berinteraksi dan berkembang.\n\nMakna: pertumbuhan melalui disiplin, kejujuran, dan kepedulian.",
                'order' => 5,
                'questions' => [
                    ['category' => 'W', 'text' => 'Apa yang kamu inginkan berkaitan dengan perkembangan dirimu sehingga dapat berkembang melalui kedisiplinan, kejujuran, dan kepedulian (tatas, tuhu, trasna)?'],
                    ['category' => 'D', 'text' => 'Apa yang telah kamu lakukan agar dapat mengembangkan dirimu melalui kedisiplinan, kejujuran, dan kepedulian (tatas, tuhu, trasna)?'],
                    ['category' => 'E', 'text' => 'Apakah yang telah kamu lakukan dapat membantumu mengembangkan dirimu melalui kedisiplinan, kejujuran, dan kepedulian (tatas, tuhu, trasna)?'],
                    ['category' => 'P', 'text' => 'Apa yang akan kamu lakukan agar dapat mengembangkan dirimu melalui kedisiplinan, kejujuran, dan kepedulian (tatas, tuhu, trasna)?'],
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
