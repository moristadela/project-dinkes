<?php

namespace Database\Seeders;

use App\Models\Bidang;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    public function run(): void
    {
        // User::updateOrCreate(
        //     ['username' => 'admin'],
        //     [
        //         'name' => 'Administrator',
        //         'username' => 'admin',
        //         'password' => Hash::make('admin12345'),
        //         'role' => 'admin',
        //         'bidang_id' => null
        //     ]
        // );
        Bidang::create([
            'nama_bidang' => 'Sekretariat',
        ]);
        Bidang::create([
            'nama_bidang' => 'Pelayanan Kesehatan',
        ]);
        Bidang::create([
            'nama_bidang' => 'Kesehatan Masyarakat',
        ]);
        Bidang::create([
            'nama_bidang' => 'Pencegahan dan Pengendalian Penyakit',
        ]);
        Bidang::create([
            'nama_bidang' => 'Sumber Daya Kesehatan',
        ]);
    }
}
