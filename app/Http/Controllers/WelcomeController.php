<?php

namespace App\Http\Controllers;

use App\Models\Siswa;

use App\Models\RekapHarian;
use Illuminate\Support\Carbon;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Carbon\Exceptions\InvalidFormatException;


class WelcomeController extends Controller
{
    public function index()
    {
        $dataSiswa = Siswa::query()
            ->whereIn('madrasah_diniyah', ['Ulya', 'Wustho', 'Ula'])
            ->groupBy('madrasah_diniyah', 'jenis_kelamin')
            ->select('madrasah_diniyah', 'jenis_kelamin',  DB::raw('count(*) as total'))
            ->get();
        $dataSiswaMadin = Siswa::query()
            ->whereIn('madrasah_diniyah', ['Ulya', 'Wustho', 'Ula'])
            ->groupBy('madrasah_diniyah')
            ->select('madrasah_diniyah',  DB::raw('count(*) as total'))
            ->get();
        // $tgl = $request->tgl ? Carbon::parse($request->tgl) : now();
        $rekapHarian = RekapHarian::query()
        ->whereIn('keterangan', ['alfa', 'izin', 'sakit', 'hadir'])
        ->orderByRaw("FIELD(jenjang, 'Ula', 'Wustho', 'Ulya')")
        ->groupBy('jenjang')
        ->where('tgl', date('Y-m-d'))
        ->select(
            'jenjang',
            DB::raw('SUM(CASE WHEN keterangan = "sakit" THEN 1 ELSE 0 END) AS jumlah_sakit'),
            DB::raw('SUM(CASE WHEN keterangan = "izin" THEN 1 ELSE 0 END) AS jumlah_izin'),
            DB::raw('SUM(CASE WHEN keterangan = "alfa" THEN 1 ELSE 0 END) AS jumlah_alfa')
        )
        ->get();
        // dd($rekapHarian);


        return view('dashboard', [
            'dataSiswa' => $dataSiswa,
            'dataSiswaMadin' => $dataSiswaMadin,
            'rekapHarian' => $rekapHarian
        ]);
        
    }
    
}
