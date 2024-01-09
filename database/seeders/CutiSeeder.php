<?php

namespace Database\Seeders;

use App\Models\Cuti;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CutiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Cuti::create([
            'nomor_induk' => 'IP06001',
            'tgl_cuti' => '2020-08-02',
            'lama_cuti' => 2,
            'keterangan' => 'Acara Keluarga'
        ]);
        Cuti::create([
            'nomor_induk' => 'IP06003',
            'tgl_cuti' => '2020-08-30',
            'lama_cuti' => 2,
            'keterangan' => 'Acara Keluarga'
        ]);
        Cuti::create([
            'nomor_induk' => 'IP06001',
            'tgl_cuti' => '2020-08-18',
            'lama_cuti' => 2,
            'keterangan' => 'Anak Sakit'
        ]);
        Cuti::create([
            'nomor_induk' => 'IP06006',
            'tgl_cuti' => '2020-08-19',
            'lama_cuti' => 1,
            'keterangan' => 'Nenek Sakit'
        ]);
        Cuti::create([
            'nomor_induk' => 'IP06007',
            'tgl_cuti' => '2020-08-23',
            'lama_cuti' => 1,
            'keterangan' => 'Sakit'
        ]);
        Cuti::create([
            'nomor_induk' => 'IP06004',
            'tgl_cuti' => '2020-08-29',
            'lama_cuti' => 5,
            'keterangan' => 'Menikah'
        ]);
    }
}
