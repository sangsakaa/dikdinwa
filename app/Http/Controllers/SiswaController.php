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
            // ->whereIn('madrasah_diniyah', ['Ulya', 'Wustho', 'Ula'])
            ->orderby('madrasah_diniyah')
            
            ->orderby('nis')
            ->get();
        

        

        
        return view(
            'siswa.index',
            [
                'dataSiswa' => $dataSiswa,
                
                

            ]
        );
    }

    public function destroy()
    {
        DB::table('siswa')->truncate();
        return redirect()->back()->with('error', 'berhasil');
    }
}
