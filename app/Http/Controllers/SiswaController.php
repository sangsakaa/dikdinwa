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
            ->Orderby('madrasah_diniyah')
            ->Orderby('nama_siswa')
            ->Orderby('tanggal_masuk')
            ->get();
        $ULA = $x->whereIn('madrasah_diniyah', ['Ula'])->countBy('tanggal_masuk');
        $data = $x->countBy('tanggal_masuk');
        return view(
            'siswa.index',
            [
                'dataSiswa' => $dataSiswa,
                'data' => $data,
                'result' => $ULA,

            ]
        );
    }

    public function destroy(Siswa $siswa)
    {
        Siswa::destroy($siswa->id);
        return redirect()->back()->with('error', 'berhasil');
    }
}
