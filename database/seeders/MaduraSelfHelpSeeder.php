<?php

namespace Database\Seeders;

use App\Models\Tribe;
use App\Models\Material;
use App\Models\MaterialQuestion;
use Illuminate\Database\Seeder;

class MaduraSelfHelpSeeder extends Seeder
{
    public function run(): void
    {
        // Create or find Suku Madura
        $tribe = Tribe::firstOrCreate(['name' => 'Madura']);

        // Data for Madura Self-Help Materials
        $materials = [
            [
                'title' => 'SELF-ACCEPTANCE (PENERIMAAN DIRI)',
                'values' => 'Ajhina Diri, Bhuppa’-Bhabhu’-Ghuru-Rato',
                'description' => "Ajhina Diri (Harga Diri)\nAjhina diri merupakan nilai inti dalam budaya Madura yang menekankan pentingnya menjaga kehormatan dan martabat diri. Dalam konteks self-help, nilai ini mendorong remaja untuk menerima diri secara utuh tanpa merasa rendah atau inferior, serta membangun keyakinan bahwa setiap individu memiliki nilai dan kehormatan yang harus dijaga.\n\nBhuppa’-Bhabhu’-Ghuru-Rato (Hierarki Penghormatan)\nNilai ini menempatkan orang tua, guru, dan pemimpin sebagai figur utama dalam pembentukan identitas diri. Dalam konteks penerimaan diri, nilai ini membantu remaja memahami bahwa dirinya merupakan bagian dari sistem nilai yang lebih besar, sehingga membangun identitas diri yang stabil dan bermakna.",
                'order' => 0,
                'questions' => [
                    ['category' => 'W', 'text' => 'Apa yang kamu inginkan berkaitan dengan penerimaan dirimu seutuhnya sehingga kamu dapat menjaga harga dirimu (ajhina diri-mu)?'],
                    ['category' => 'D', 'text' => 'Apa yang telah kamu lakukan agar dapat menerima dirimu seutuhnya sehingga dapat menjaga harga dirimu (ajhina diri-mu)?'],
                    ['category' => 'E', 'text' => 'Apakah yang telah kamu lakukan dapat membantumu untuk menerima dirimu seutuhnya sehingga kamu dapat menjaga harga dirimu (ajhina diri-mu)?'],
                    ['category' => 'P', 'text' => 'Apa yang akan kamu lakukan agar dapat menerima dirimu seutuhnya sehingga kamu dapat menjaga harga dirimu (ajhina diri-mu)?'],
                ]
            ],
            [
                'title' => 'POSITIVE RELATIONS (HUBUNGAN POSITIF)',
                'values' => 'Taretan, Bhuppa’-Bhabhu’-Ghuru-Rato',
                'description' => "Taretan (Persaudaraan Sosial)\nTaretan mencerminkan konsep persaudaraan luas dalam masyarakat Madura, di mana orang lain diperlakukan seperti keluarga sendiri. Nilai ini menjadi dasar bagi remaja untuk membangun hubungan sosial yang hangat, penuh kepedulian, dan saling mendukung.",
                'order' => 1,
                'questions' => [
                    ['category' => 'W', 'text' => 'Apa yang kamu inginkan berkaitan dengan hubungan positif bersama orang lain sehingga dapat membina persaudaraan sosial (taretan) yang baik?'],
                    ['category' => 'D', 'text' => 'Apa yang telah kamu lakukan dalam berhubungan positif dengan orang lain agar dapat membina persaudaraan sosial (taretan) yang baik?'],
                    ['category' => 'E', 'text' => 'Apakah yang telah kamu lakukan dalam berhubungan positif dengan orang lain dapat membina persaudaraan sosial (taretan) yang baik?'],
                    ['category' => 'P', 'text' => 'Apa yang akan kamu lakukan dalam berhubungan positif dengan orang lain sehingga dapat membina persaudaraan sosial (taretan) yang baik?'],
                ]
            ],
            [
                'title' => 'AUTONOMY (KEMANDIRIAN)',
                'values' => 'Ajhina Diri',
                'description' => "Ajhina Diri (Integritas Diri)\nPada dimensi otonomi, ajhina diri berfungsi sebagai pengendali internal yang mendorong individu untuk bertindak sesuai prinsip dan menjaga kehormatan diri. Remaja tidak hanya bebas memilih, tetapi juga bertanggung jawab atas pilihan tersebut.",
                'order' => 2,
                'questions' => [
                    ['category' => 'W', 'text' => 'Apa yang kamu inginkan berkaitan dengan kemandirianmu sehingga kamu dapat menjaga integritas dirimu (ajhina diri)?'],
                    ['category' => 'D', 'text' => 'Apa yang telah kamu lakukan berkaitan dengan kemandirianmu agar dapat menjaga integritas dirimu (ajhina diri)?'],
                    ['category' => 'E', 'text' => 'Apakah yang telah kamu lakukan berkaitan dengan kemandirianmu dapat membantumu menjaga integritas dirimu (ajhina diri)?'],
                    ['category' => 'P', 'text' => 'Apa yang akan kamu lakukan berkaitan dengan kemandirianmu sehingga dapat menjaga integritas dirimu (ajhina diri)?'],
                ]
            ],
            [
                'title' => 'ENVIRONMENTAL MASTERY (PENGUASAAN LINGKUNGAN)',
                'values' => 'Bhuppa’-Bhabhu’-Ghuru-Rato',
                'description' => "Bhuppa’-Bhabhu’-Ghuru-Rato (Norma Sosial)\nNilai ini berfungsi sebagai pedoman dalam berinteraksi dengan lingkungan sosial. Remaja belajar memahami aturan, peran sosial, dan batasan yang ada, sehingga mampu menyesuaikan diri secara efektif tanpa kehilangan identitas diri.",
                'order' => 3,
                'questions' => [
                    ['category' => 'W', 'text' => 'Apa yang kamu inginkan berkaitan dengan penguasaan lingkungan sehingga dapat berinteraksi dengan lingkungan sosial yang baik (Bhuppa’-Bhabhu’-Ghuru-Rato)?'],
                    ['category' => 'D', 'text' => 'Apa yang telah kamu lakukan berkaitan dengan penguasaan lingkungan agar dapat berinteraksi dengan lingkungan sosial yang baik (Bhuppa’-Bhabhu’-Ghuru-Rato)?'],
                    ['category' => 'E', 'text' => 'Apakah yang telah kamu lakukan berkaitan dengan penguasaan lingkungan dapat membantumu mampu berinteraksi dengan lingkungan sosial yang baik (Bhuppa’-Bhabhu’-Ghuru-Rato)?'],
                    ['category' => 'P', 'text' => 'Apa yang akan kamu lakukan berkaitan dengan penguasaan lingkungan agar dapat berinteraksi dengan lingkungan sosial yang baik (Bhuppa’-Bhabhu’-Ghuru-Rato)?'],
                ]
            ],
            [
                'title' => 'PURPOSE IN LIFE (TUJUAN HIDUP)',
                'values' => 'Abhantal Syahadat, Asapo’ Iman, Payung Allah',
                'description' => "Abhantal Syahadat, Asapo’ Iman, Payung Allah (Spiritual Grounding)\nNilai ini menggambarkan fondasi kehidupan yang berlandaskan keimanan. Dalam konteks self-help, nilai ini memberikan arah hidup yang jelas, rasa aman eksistensial, dan keyakinan bahwa hidup memiliki tujuan yang lebih tinggi.",
                'order' => 4,
                'questions' => [
                    ['category' => 'W', 'text' => 'Apa tujuan hidup yang sesuai dengan keimananmu yang ingin kamu capai (abhantal syahadat, asapo’ iman, payung Allah)?'],
                    ['category' => 'D', 'text' => 'Apa yang telah kamu lakukan untuk mencapai tujuan hidup yang sesuai dengan keimananmu (abhantal syahadat, asapo’ iman, payung Allah)?'],
                    ['category' => 'E', 'text' => 'Apakah yang telah kamu lakukan dapat membantumu mencapai tujuan hidup yang sesuai dengan keimananmu (abhantal syahadat, asapo’ iman, payung Allah)?'],
                    ['category' => 'P', 'text' => 'Apa yang akan kamu lakukan agar dapat mencapai tujuan hidup yang sesuai dengan keimananmu (abhantal syahadat, asapo’ iman, payung Allah)?'],
                ]
            ],
            [
                'title' => 'PERSONAL GROWTH (PERTUMBUHAN PRIBADI)',
                'values' => 'Ajhina Diri',
                'description' => "Ajhina Diri (Pengembangan Diri Bermartabat)\nDalam konteks pertumbuhan pribadi, ajhina diri mendorong individu untuk terus berkembang tanpa kehilangan jati diri. Remaja berusaha menjadi lebih baik bukan karena tekanan sosial, tetapi karena kesadaran menjaga kualitas diri dan kehormatan pribadi.",
                'order' => 5,
                'questions' => [
                    ['category' => 'W', 'text' => 'Apa yang kamu inginkan berkaitan dengan perkembangan dirimu sehingga kamu dapat menjaga jati dirimu (ajhina diri-mu)?'],
                    ['category' => 'D', 'text' => 'Apa yang telah kamu lakukan agar dapat mengembangkan dirimu seutuhnya sehingga dapat menjaga jati dirimu (ajhina diri-mu)?'],
                    ['category' => 'E', 'text' => 'Apakah yang telah kamu lakukan dapat mengembangkan dirimu seutuhnya sehingga dapat menjaga jati dirimu (ajhina diri-mu)?'],
                    ['category' => 'P', 'text' => 'Apa yang akan kamu lakukan agar dapat mengembangkan dirimu seutuhnya sehingga dapat menjaga jati dirimu (ajhina diri-mu)?'],
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
