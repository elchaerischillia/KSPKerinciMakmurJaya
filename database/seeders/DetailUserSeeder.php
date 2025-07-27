<?php

namespace Database\Seeders;

use App\Models\DetailUser;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DetailUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $detail_user = [
            [
                'user_id'       => 1,
                'tmpt_lahir'    => '-',
                'tgl_lahir'     => '-',
                'jk'            => 'Laki-laki',
                'no_hp'         => '082256745678',
                'alamat'        => '-',
                'foto'          => null,
                'status'        => true,
            ],

            [
                'user_id'       => 2,
                'tmpt_lahir'    => '-',
                'tgl_lahir'     => '-',
                'jk'            => 'Perempuan',
                'no_hp'         => '081256745678',
                'alamat'        => '-',
                'foto'          => null,
                'status'        => true,
            ],

            [
                'user_id'       => 3,
                'tmpt_lahir'    => '-',
                'tgl_lahir'     => '-',
                'jk'            => 'Laki-laki',
                'no_hp'         => '082256745671',
                'alamat'        => '-',
                'foto'          => null,
                'status'        => true,
            ],

        ];

        DetailUser::insert($detail_user);
    }
}
