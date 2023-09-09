<?php

namespace App\Http\Controllers;

use App\Models\Siswa;
use App\Models\RekapHarian;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Carbon\Exceptions\InvalidFormatException;

class SiswaController extends Controller
{
    public function index()
    {

        $dataSiswa = Siswa::query()
            // ->whereIn('madrasah_diniyah', ['Ulya', 'Wustho', 'Ula'])
            ->orderby('madrasah_diniyah')
            ->orderby('nis');
        if (request('cari')) {
            $dataSiswa->where('nama_siswa', 'like', '%' . request('cari') . '%');
            $dataSiswa->Orwhere('nis', 'like', '%' . request('cari') . '%');
        }
        return view(
            'siswa.index',
            [
                'dataSiswa' => $dataSiswa->paginate(10),
            ]
        );
    }

    public function destroy()
    {
        DB::table('siswa')->truncate();
        return redirect()->back()->with('error', 'berhasil');
    }
    public function RekapHarian(Request $request)
    {
        try {
            $tgl = $request->tgl ? Carbon::parse($request->tgl) : now();
        } catch (InvalidFormatException $ex) {
            $tgl = now();
        }
        $rekapHarian = RekapHarian::query()
            ->where('rekap_harian.tgl', $tgl->toDateString())
            ->whereIn('keterangan', ['alfa', 'izin', 'sakit'])
            ->get();

        return view('siswa.rekapHarian', compact('rekapHarian', 'tgl'));
    }
}
