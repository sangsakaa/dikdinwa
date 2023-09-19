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
            ->orderByRaw("FIELD(madrasah_diniyah, 'Ula', 'Wustho', 'Ulya')")
            ->get();
        $dataSiswaMadin = Siswa::query()
            ->whereIn('madrasah_diniyah', ['Ulya', 'Wustho', 'Ula'])
            ->groupBy('madrasah_diniyah')
            ->select('madrasah_diniyah',  DB::raw('count(*) as total'))
            ->orderByRaw("FIELD(madrasah_diniyah, 'Ula', 'Wustho', 'Ulya')")
            ->get();
        // $tgl = $request->tgl ? Carbon::parse($request->tgl) : now();
        $startDate = Carbon::now()->subWeek()->startOfWeek();
        $rekapHarian = RekapHarian::query()
            ->whereIn('keterangan', ['alfa', 'izin', 'sakit'])
            ->whereMonth('tgl', now()->month) // Filter berdasarkan bulan saat ini
        ->orderByRaw("FIELD(jenjang, 'Ula', 'Wustho', 'Ulya')")
            ->groupBy('jenjang', 'tgl') // Mengelompokkan berdasarkan jenjang dan tgl
        ->select(
            'jenjang',
            'tgl',
            DB::raw('SUM(CASE WHEN keterangan = "sakit" THEN 1 ELSE 0 END) AS jumlah_sakit'),
            DB::raw('SUM(CASE WHEN keterangan = "izin" THEN 1 ELSE 0 END) AS jumlah_izin'),
            DB::raw('SUM(CASE WHEN keterangan = "alfa" THEN 1 ELSE 0 END) AS jumlah_alfa')
        )
            ->where('tgl', '>=', $startDate)
            ->orderby('jenjang')
            ->orderby('tgl')
        ->get();
        // dd($rekapHarian);
        $rekapBulan = RekapHarian::query()
            ->whereIn('keterangan', ['alfa', 'izin', 'sakit'])
            ->whereIn('jenjang', ['Wustho', 'Ulya', 'Ula'])
            ->whereYear('tgl', now()->year) // Filter berdasarkan tahun saat ini
            ->whereMonth('tgl', now()->month) // Filter berdasarkan bulan saat ini
            ->orderByRaw("FIELD(jenjang, 'Ula', 'Wustho', 'Ulya')")
        ->select(
            'jenjang',
            DB::raw('YEAR(tgl) AS tahun'),
            DB::raw('MONTH(tgl) AS bulan'),
            DB::raw('SUM(CASE WHEN keterangan = "sakit" THEN 1 ELSE 0 END) AS jumlah_sakit'),
            DB::raw('SUM(CASE WHEN keterangan = "izin" THEN 1 ELSE 0 END) AS jumlah_izin'),
            DB::raw('SUM(CASE WHEN keterangan = "alfa" THEN 1 ELSE 0 END) AS jumlah_alfa')
        )
            ->groupBy('jenjang', DB::raw('YEAR(tgl)'), DB::raw('MONTH(tgl)'))
        ->get();

        // dd($rekapBulan);
        $asramaTerbanyaAlfa = RekapHarian::query()
        ->whereIn('keterangan', ['alfa', 'izin', 'sakit'])
            ->whereMonth('tgl', now()->month) // Filter berdasarkan bulan saat ini
            // ->orderByRaw("FIELD(jenjang, 'Ula', 'Wustho', 'Ulya')")
            ->groupBy('jenjang', 'nama_asrama') // Mengelompokkan berdasarkan jenjang dan tgl
            ->select(
                'nama_asrama',
                'jenjang',
                DB::raw('SUM(CASE WHEN keterangan = "sakit" THEN 1 ELSE 0 END) AS jumlah_sakit'),
                DB::raw('SUM(CASE WHEN keterangan = "izin" THEN 1 ELSE 0 END) AS jumlah_izin'),
                DB::raw('SUM(CASE WHEN keterangan = "alfa" THEN 1 ELSE 0 END) AS jumlah_alfa')
            )

            ->where('tgl', '>=', $startDate)
            ->orderby('jenjang')
            ->orderby('tgl')
            ->get();


        return view('dashboard', [
            'dataSiswa' => $dataSiswa,
            'dataSiswaMadin' => $dataSiswaMadin,
            'rekapHarian' => $rekapHarian,
            'rekapBulan' => $rekapBulan,
            'asramaTerbanyaAlfa' => $asramaTerbanyaAlfa
        ]);
        
    }
    
}
