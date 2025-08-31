<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Seeder;
use App\Models\Bidang;

class BidangSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
       
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
