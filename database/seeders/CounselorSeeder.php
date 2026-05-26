<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class CounselorSeeder extends Seeder
{
    public function run(): void
    {
        // Delete existing counselors to start fresh
        User::where('role', 'konselor')->delete();

        $counselors = [
            [
                'name' => 'Nur Mega Aris Saputra, S.Pd., M.Pd',
                'email' => 'aris.saputra.fip@um.ac.id',
                'whatsapp_number' => '081231750634',
                'motto' => 'Yakin pada diri, mensyukuri nikmat',
                'description' => "Dosen Bimbingan dan Konseling-Universitas Negeri Malang\nS1 Bimbingan dan Konseling-Universitas Negeri Malang (2017-2021)\nS2 Bimbingan dan Konseling-Universitas Negeri Malang (2021-2022)\nS3 Bimbingan dan Konseling-Universitas Negeri Malang (2023- Sekarang)",
            ],
            [
                'name' => 'Nail Hidaya Afandi, S.Pd., M.Pd',
                'email' => 'nail.hidaya.2301119@students.um.ac.id',
                'whatsapp_number' => '081378516305',
                'motto' => 'Hidup adalah eksperimen',
                'description' => "Mahasiswi S3 Bimbingan dan Konseling Universitas Negeri Malang\nS1 Bimbingan dan Konseling-Universitas Negeri Malang (2017-2021)\nS2 Bimbingan dan Konseling-Universitas Negeri Malang (2021-2022)\nS3 Bimbingan dan Konseling-Universitas Negeri Malang (2023- Sekarang)",
            ],
            [
                'name' => 'Herlin Ika Nafilasari, S.Pd., M.Pd',
                'email' => 'herlin.icha15@gmail.com',
                'whatsapp_number' => '081334130175',
                'motto' => 'Bermakna',
                'description' => "Guru BK di SMA Lab UM\nS1 Bimbingan dan Konseling-Universitas Negeri Surabaya (2016-2020)\nS2 Bimbingan dan Konseling-Universitas Negeri Malang (2021-2023)",
            ],
            [
                'name' => 'Alivia Eka Arianti, S.Pd., M.Pd',
                'email' => 'alivia.eka.2301118@students.um.ac.id',
                'whatsapp_number' => '089678286737',
                'motto' => 'Man Jadda Wajada',
                'description' => "Konselor\nS1 Bimbingan dan Konseling Universitas Ahmad Dahlan (2018-2022)\nS2 Bimbingan dan Konseling Universitas Negeri Malang (2023-2025)",
            ],
            [
                'name' => 'Muh. Nur Alamsyah, S.Pd., M.Pd',
                'email' => 'muh.nur.2301118@students.um.ac.id',
                'whatsapp_number' => '082293122777',
                'motto' => 'Hidup untuk Beribadah dan Berkarya',
                'description' => "Konselor\nS1 Bimbingan dan Konseling-Universitas Negeri Makassar (2018-2023)\nS2 Bimbingan dan Konseling-Universitas Negeri Malang (2023-2025)",
            ],
            [
                'name' => 'M. Khoirudin Jalil, S.Pd., M.Pd',
                'email' => 'm.khoirudin.2301118@students.um.ac.id',
                'whatsapp_number' => '081358991943',
                'motto' => 'Aku Berpikir Maka Aku Hidup',
                'description' => "Mahasiswa S3 Bimbingan dan Konseling Universitas Negeri Malang\nS1 Bimbingan dan Konseling Islam-Universitas Islam Negeri Jember (2018-2022)\nS2 Bimbingan dan Konseling-Universitas Negeri Malang (2023-2024)\nS3 Bimbingan dan Konseling-Universitas Negeri Malang (2024-Sekarang)",
            ]
        ];

        foreach ($counselors as $data) {
            $user = User::create([
                'name' => $data['name'],
                'email' => $data['email'],
                'password' => Hash::make('password'),
                'role' => 'konselor',
            ]);

            $user->counselorProfile()->create([
                'description' => $data['description'],
                'motto' => $data['motto'],
                'photo_path' => null,
                'whatsapp_number' => $data['whatsapp_number'],
            ]);
        }
    }
}
