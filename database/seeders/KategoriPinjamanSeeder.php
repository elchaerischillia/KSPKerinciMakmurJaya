<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class KategoriPinjamanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
            $kategori_pinjaman = [
                [
                    'nama_kategori' => 'IDR 2.010.000',
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'nama_kategori' => 'IDR 3.000.000',
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'nama_kategori' => 'IDR 4.020.000',
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'nama_kategori' => 'IDR 5.010.000',
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'nama_kategori' => 'IDR 6.000.000',
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'nama_kategori' => 'IDR 7.020.000',
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'nama_kategori' => 'IDR 8.010.000',
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'nama_kategori' => 'IDR 9.000.000',
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'nama_kategori' => 'IDR 10.020.000',
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'nama_kategori' => 'IDR 11.010.000',
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'nama_kategori' => 'IDR 12.000.000',
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'nama_kategori' => "IDR 13.020.000",
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'nama_kategori' => "IDR 14.010.000",
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'nama_kategori' => "IDR 15.000.000",
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
            ];

        \App\Models\KategoriPinjaman::insert($kategori_pinjaman);
    }
}
