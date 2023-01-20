<?php

namespace App\Http\Controllers;

use App\Models\Siswa;
use Illuminate\Http\Request;

class SiswaController extends Controller
{
    public function index()
    {

        $dataSiswa = Siswa::query()
            ->Orderby('madrasah_diniyah')
            ->Orderby('nis')
            ->Orderby('nama_siswa')
            ->get();
        $x = Siswa::query()
            ->Orderby('tanggal_masuk')
            ->Orderby('madrasah_diniyah')
            ->Orderby('nama_siswa')
            ->get();
        $ULA = $x->whereIn('madrasah_diniyah', ['Ula'])->countBy('tanggal_masuk');
        $wustho = $x->whereIn('madrasah_diniyah', ['Wustho'])->countBy('tanggal_masuk');
        return view(
            'siswa.index',
            [
                'dataSiswa' => $dataSiswa,
                'Ula' => $ULA,
                'Wustho' => $wustho,

            ]
        );
    }

    public function destroy(Siswa $siswa)
    {
        Siswa::destroy($siswa->id);
        return redirect()->back()->with('error', 'berhasil');
    }
}
