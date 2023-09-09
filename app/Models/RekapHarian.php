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
        'nama_siswa',
        'nama_asrama',
        'nama_kelas',
        'tgl',
        'keterangan',
        'id_sesi_kelas'

    ];
}
