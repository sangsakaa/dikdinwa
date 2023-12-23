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
        'nama_lembaga',
        'tempat_lahir',
        'tanggal_lahir',
        'kota_asal',
        'nama_asrama',
        'nama_kelas'    
    ];
    public static function search($search)
    {
        return empty($search) ? static::query() : static::query()
            ->Orwhere('nis', 'like', '%' . $search . '%')
            ->OrWhere('nama_siswa', 'like', '%' . $search . '%');
    }
}
