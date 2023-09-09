<?php

namespace App\Http\Controllers\Api;

use App\Models\RekapHarian;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class RekapHarianController extends Controller
{
    public function getDataRekap()
    {
        try {
            $urls = [
                'https://wustho.smedi.my.id/api/data-asrama',
                'https://ulya.smedi.my.id/api/data-asrama',
                'https://ula.smedi.my.id/api/data-asrama',
                // Tambahkan URL lainnya di sini jika diperlukan
            ];
            $filteredData = [];

            foreach ($urls as $url) {
                set_time_limit('200');
                 
                $response = Http::get($url);
                $nis = $response->json();

                // Periksa apakah ada data 'siswa' dalam respons
                if (isset($nis['dataAbsensiKelas'])) {
                    $filteredData = array_merge($filteredData, array_filter($nis['dataAbsensiKelas'], function ($item) {
                        // Filter berdasarkan jenjang 'Wustho' atau 'Ulya'
                        return in_array($item['jenjang'], ['Ulya', 'Wustho']);
                    }));
                }
            }
            $progressBar = '<script>NProgress.start();</script>';
            foreach ($filteredData as $index => $item) {
                RekapHarian::create([
                    'jenjang' => $item['jenjang'],
                    'nama_asrama' => $item['nama_asrama'],
                    'nama_siswa' => $item['nama_siswa'],
                    'nama_kelas' => $item['nama_kelas'],
                    'keterangan' => $item['keterangan'],
                    'tgl' => $item['tgl'],
                    'id_sesi_kelas' => $item['id_sesi_kelas'],
                ]);
            }
        } catch (\Exception $e) {
            // Tangani kesalahan umum, seperti masalah koneksi, dengan cara yang sesuai
            // Anda dapat menambahkan kode penanganan kesalahan di sini
            // Misalnya, Anda dapat mencatat kesalahan atau memberi tahu pengguna.
            dd($e->getMessage()); // Ini hanya contoh penanganan kesalahan sederhana
        }

        return redirect()->back();
    }
}
