<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RekapHarian extends Model
{
    use HasFactory;
    protected $table = "rekap_harian";
    protected $fillable = [
        'jenjang',
        // 'nis',
        // 'nama_siswa',
        // 'madrasah_diniyah',
        // 'jenis_kelamin',
        // 'tanggal_masuk',
        // 'nama_lembaga',
        // 'tempat_lahir',
        // 'tanggal_lahir',
        // 'kota_asal',
        // 'nama_asrama'

    ];
}
