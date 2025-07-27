<?php

namespace Database\Seeders;

use App\Models\Anggota;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class AnggotaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $anggota =

            [
                [
                    'nik' => '3201010101010001',
                    'nama_lengkap' => 'Ahmad Fauzan',
                    'tmpt_lahir' => 'Bandung',
                    'tgl_lahir' => '1995-05-15',
                    'nama_bank' => 'BRI',
                    'no_rek'    =>'12345678921',
                    'jk' => 'Laki-laki',
                    'alamat' => 'Jln. Raya Cibiru No. 123',
                    'no_hp' => '081234567890',
                    'foto' => null,
                    'status' => true,
                    'created_at' => now(),
                ],
            ];

            Anggota::insert($anggota);
    }
}
