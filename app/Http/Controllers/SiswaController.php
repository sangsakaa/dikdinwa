<?php

namespace App\Http\Controllers;

use App\Models\Siswa;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;

class SiswaController extends Controller
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

        

        
        return view(
            'siswa.index',
            [
                'dataSiswa' => $dataSiswa,
                'dataSiswaMadin' => $dataSiswaMadin,
                

            ]
        );
    }

    public function destroy()
    {
        DB::table('siswa')->truncate();
        return redirect()->back()->with('error', 'berhasil');
    }
}
