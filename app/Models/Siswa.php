<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Siswa extends Model
{
    use HasFactory;
    protected $table = "siswa";
    protected $fillable = [
        'nis',
        'nama_siswa',
        'madrasah_diniyah',
        'jenis_kelamin',
        'agama',
        'tanggal_masuk',
        'nama_lembaga'
    ];
}
