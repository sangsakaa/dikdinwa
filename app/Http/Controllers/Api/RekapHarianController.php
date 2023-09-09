<?php

namespace App\Http\Controllers\Api;

use App\Models\RekapHarian;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class RekapHarianController extends Controller
{
    public function getData()
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
                $response = Http::get($url);
                $nis = $response->json();

                // Periksa apakah ada data 'siswa' dalam respons
                if (isset($nis['siswa'])) {
                    $filteredData = array_merge($filteredData, array_filter($nis['siswa'], function ($item) {
                        return $item['nama_lembaga'] == 'Wahidiyah';
                    }));
                }
            }
            // Initialize the progress bar
            $progressBar = '<script>NProgress.start();</script>';

            foreach ($filteredData as $index => $item) {
                // dd($item);

                if (!RekapHarian::where('nis', $item['nis'])->exists()) {
                    if (Validator::make($item, [
                        'nis' => 'unique:siswa',
                    ])->passes()) {
                        RekapHarian::updateOrCreate(
                            ['nis' => $item['nis']], // Kunci pencarian
                            [ // Data yang akan diperbarui atau dibuat jika tidak ada yang sesuai
                                'tempat_lahir' => $item['tempat_lahir'],
                                'nama_siswa' => $item['nama_siswa'],
                                'jenis_kelamin' => $item['jenis_kelamin'],
                                'madrasah_diniyah' => $item['madrasah_diniyah'],
                                'agama' => $item['agama'],
                                'tanggal_masuk' => $item['tanggal_masuk'],
                                'kota_asal' => $item['kota_asal'],
                                'nama_lembaga' => $item['nama_lembaga'],
                                'tanggal_lahir' => $item['tanggal_lahir'],
                                // Tambahkan kolom-kolom lain sesuai kebutuhan
                            ]
                        );
                    } else {
                        // Handle validation failure
                        // Anda dapat menggunakan message bag untuk mendapatkan error validasi dan bertindak sesuai
                        $errors = Validator::make($item, [
                            'nis' => 'unique:siswa',
                        ])->errors();
                        // Anda dapat menambahkan pesan ke sesi untuk ditampilkan kepada pengguna atau mencatat error
                        Session::flash('error', 'Validasi gagal untuk item: ' . json_encode($item) . ' dengan error: ' . json_encode($errors));
                    }
                }

                // Calculate the progress percentage
                $progress = ($index + 1) / count($filteredData) * 100;
                // Update the progress bar
                $progressBar .= "<script>NProgress.set($progress);</script>";
            }

            // Finish the progress bar
            $progressBar = '<script>NProgress.done();</script>';

            return redirect()->back()->with('progressBar', $progressBar);
        } catch (\Exception $e) {
            // Handle network error
            Session::flash('error', 'An error occurred while fetching data from the API: ' . $e->getMessage());

            return redirect()->back();
        }
    }
}
