<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Sekolah;
use App\Models\Jurusan;

class SekolahJurusanSeeder extends Seeder
{
    public function run(): void
    {
        // Data Sekolah
        $sekolahList = [
            'SMKN 1 Mejayan',
            'SMKN 1 Geger',
            'SMKN 5 Madiun',
            'SMKN 4 Jiwan'
        ];

        foreach ($sekolahList as $sekolah) {
            Sekolah::firstOrCreate([
                'nama_sekolah' => $sekolah
            ]);
        }

        // Data Jurusan
        $jurusanList = [
            ['nama_jurusan' => 'Teknik Komputer dan Jaringan (TKJ)'],
            ['nama_jurusan' => 'Rekayasa Perangkat Lunak (RPL)'],
            ['nama_jurusan' => 'Otomatisasi Tata Kelola Perkantoran (OTKP)']
        ];

        foreach ($jurusanList as $jurusan) {
            Jurusan::create($jurusan);
        }
    }
}
