<?php

namespace Database\Seeders;

use App\Http\Controllers\KaryawanController;
use App\Models\Karyawan;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Carbon\Carbon;

class KaryawanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $nomorInduk = new KaryawanController;

        Karyawan::create([
            'nomor_induk' => $nomorInduk->generateNomorInduk(),
            'nama' => 'Agus',
            'alamat' => 'Jln Gaja Mada no 12, Surabaya',
            'tgl_lahir' => "1980-01-11",
            'tgl_gabung' => "2005-08-07",
        ]);

        Karyawan::create([
            'nomor_induk' => $nomorInduk->generateNomorInduk(),
            'nama' => 'Amin',
            'alamat' => 'Jln Imam Bonjol no 11, Mojokerto',
            'tgl_lahir' => "1977-09-03",
            'tgl_gabung' => "2005-08-07",
        ]);

        Karyawan::create([
            'nomor_induk' => $nomorInduk->generateNomorInduk(),
            'nama' => 'Yusuf',
            'alamat' => 'Jln A Yani Raya 15 No 14 Malang',
            'tgl_lahir' => "1973-08-09",
            'tgl_gabung' => "2006-08-07",
        ]);

        Karyawan::create([
            'nomor_induk' => $nomorInduk->generateNomorInduk(),
            'nama' => 'Alyssa',
            'alamat' => 'Jln Bungur Sari V no 166, Bandung',
            'tgl_lahir' => "1983-03-18",
            'tgl_gabung' => "2006-09-06",
        ]);
        Karyawan::create([
            'nomor_induk' => $nomorInduk->generateNomorInduk(),
            'nama' => 'Maulana',
            'alamat' => 'Jln Candi Agung, No 78 Gg 5, Jakarta',
            'tgl_lahir' => "1978-11-10",
            'tgl_gabung' => "2006-09-10",
        ]);
        Karyawan::create([
            'nomor_induk' => $nomorInduk->generateNomorInduk(),
            'nama' => 'Agfika',
            'alamat' => 'Jln Nangka, Jakarta Timur',
            'tgl_lahir' => "1979-02-07",
            'tgl_gabung' => "2007-01-02",
        ]);
        Karyawan::create([
            'nomor_induk' => $nomorInduk->generateNomorInduk(),
            'nama' => 'James',
            'alamat' => 'Jln Merpati, 8 Surabaya',
            'tgl_lahir' => "1989-05-18",
            'tgl_gabung' => "2007-04-04",
        ]);
    }
}
