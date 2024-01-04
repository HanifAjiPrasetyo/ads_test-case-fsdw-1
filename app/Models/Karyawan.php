<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Karyawan extends Model
{
    use HasFactory;
    protected $table = 'karyawans';
    protected $fillable = ['nomor_induk', 'nama', 'tgl_lahir', 'alamat', 'tgl_lahir', 'tgl_gabung'];

    public function cutis()
    {
        return $this->hasMany(Cuti::class, 'nomor_induk', 'nomor_induk');
    }
}
