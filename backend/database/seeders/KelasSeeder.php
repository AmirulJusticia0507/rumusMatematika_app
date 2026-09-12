<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KelasSeeder extends Seeder
{
    public function run()
    {
        $kelas = [
            ['nama' => 'Kelas 1 SD'],
            ['nama' => 'Kelas 2 SD'],
            ['nama' => 'Kelas 3 SD'],
            ['nama' => 'Kelas 4 SD'],
            ['nama' => 'Kelas 5 SD'],
            ['nama' => 'Kelas 6 SD'],
            ['nama' => 'Kelas 7 SMP'],
            ['nama' => 'Kelas 8 SMP'],
            ['nama' => 'Kelas 9 SMP'],
            ['nama' => 'Kelas 10 SMA'],
            ['nama' => 'Kelas 11 SMA'],
            ['nama' => 'Kelas 12 SMA'],
        ];

        DB::table('kelas')->insert($kelas);
    }
}
