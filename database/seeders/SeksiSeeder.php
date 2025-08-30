<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Seeder;

class SeksiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // User::create([
        //     'bidang_id' => '1',
        //     'name' => 'Seksi Kepegawaian',
        //     'username' => 'Subbagumpeg',
        //     'password' => Hash::make('admin12345'),
        //     'role' => 'user',
        // ]);

        User::create([
            'bidang_id' => '1',
            'name' => 'Seksi Kepegawaian',
            'username' => 'subbagumpeg',
            'password' => Hash::make('admin12345'),
            'role' => 'user',
        ]);
    }
}
