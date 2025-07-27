<?php

namespace Database\Seeders;

use App\Models\KategoriSimpan;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class KategoriSimpanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $kategori_simpan = [
            [
                'nama_kategori' => 'Simpan Wajib',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_kategori' => 'Simpan Sukarela',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_kategori' => 'Tabungan',
                'created_at' => now(),
                'updated_at' => now(),
            ],

        ];

        KategoriSimpan::insert($kategori_simpan);
    }
}
