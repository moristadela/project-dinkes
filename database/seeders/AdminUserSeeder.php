<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    public function run(): void
    {
       User::updateOrCreate(
            ['username' => 'admin'],
            [
                'name' => 'Administrator',
                'username' => 'admin',
                'password' => Hash::make('admin12345'),
                'role' => 'admin',
                'bidang_id' => null
            ]
        );
       
        User::create([
            'bidang_id' => '1',
            'name' => 'Sub Bagian Umum dan Kepegawaian',
            'username' => 'subbagumpeg',
            'password' => Hash::make('umpeg12345'),
            'role' => 'user',
        ]);

        User::create([
            'bidang_id' => '1',
            'name' => 'Sub Bagian Program',
            'username' => 'subbagpro',
            'password' => Hash::make('pro12345'),
            'role' => 'user',
        ]);

        User::create([
            'bidang_id' => '1',
            'name' => 'Sub Bagian Keuangan',
            'username' => 'subbagkeu',
            'password' => Hash::make('keu12345'),
            'role' => 'user',
        ]);

        User::create([
            'bidang_id' => '2',
            'name' => 'Seksi Pelayanan Kesehatan Primer dan Kesehatan Tradisional',
            'username' => 'yankeskestrad',
            'password' => Hash::make('kestrad12345'),
            'role' => 'user',
        ]);

        User::create([
            'bidang_id' => '2',
            'name' => 'Seksi Standarisasi Pelayanan dan Jaminan Kesehatan',
            'username' => 'yankesjamkes',
            'password' => Hash::make('jamkes12345'),
            'role' => 'user',
        ]);

        User::create([
            'bidang_id' => '2',
            'name' => 'Seksi Pelayanan Kesehatan Rujukan',
            'username' => 'yankesru',
            'password' => Hash::make('rujukan12345'),
            'role' => 'user',
        ]);

        User::create([
            'bidang_id' => '3',
            'name' => 'Seksi Kesehatan Keluarga dan Gizi',
            'username' => 'kesgazi',
            'password' => Hash::make('kesgazi123'),
            'role' => 'user',
        ]);

        User::create([
            'bidang_id' => '3',
            'name' => ' Seksi Promosi Kesehatan dan Pemberdayaan Masyarakat',
            'username' => 'promkespm',
            'password' => Hash::make('promkes12345'),
            'role' => 'user',
        ]);

        User::create([
            'bidang_id' => '3',
            'name' => 'Seksi Kesehatan Lingkungan, Kesehatan Kerja dan Olahraga',
            'username' => 'keslingjaor',
            'password' => Hash::make('kesling12345'),
            'role' => 'user',
        ]);

        User::create([
            'bidang_id' => '4',
            'name' => 'Seksi Surveilans dan Imunisasi',
            'username' => 'surveimun',
            'password' => Hash::make('survei12345'),
            'role' => 'user',
        ]);

        User::create([
            'bidang_id' => '4',
            'name' => 'Seksi Pencegahan dan Pengendalian Penyakit Menular',
            'username' => 'p2pm',
            'password' => Hash::make('p2pm12345'),
            'role' => 'user',
        ]);

        User::create([
            'bidang_id' => '4',
            'name' => 'Seksi Pencegahan dan Pengendalian Penyakit Tidak Menular dan Kesehatan Jiwa',
            'username' => 'p2ptmkeswa',
            'password' => Hash::make('keswa12345'),
            'role' => 'user',
        ]);

        User::create([
            'bidang_id' => '5',
            'name' => 'Seksi Manajemen Informasi Kesehatan',
            'username' => 'mik',
            'password' => Hash::make('mik12345'),
            'role' => 'user',
        ]);

        User::create([
            'bidang_id' => '5',
            'name' => 'Seksi Sumber Daya Manusia Kesehatan',
            'username' => 'sdmk',
            'password' => Hash::make('sdmk12345'),
            'role' => 'user',
        ]);

        User::create([
            'bidang_id' => '5',
            'name' => 'Seksi Farmasi, Makanan Minuman dan Perbekalan Kesehatan',
            'username' => 'farmaminperbekes',
            'password' => Hash::make('farmamin12345'),
            'role' => 'user',
        ]);
    }
}
