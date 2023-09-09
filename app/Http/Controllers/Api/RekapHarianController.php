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
            // Truncate tabel RekapHarian sebelum melakukan sync
            RekapHarian::truncate();

            $urls = [
                'https://wustho.smedi.my.id/api/data-asrama',
                'https://ulya.smedi.my.id/api/data-asrama',
                'https://ula.smedi.my.id/api/data-asrama',
                // Tambahkan URL lainnya di sini jika diperlukan
            ];
            $filteredData = [];

            $maxRetries = 3; // Maksimal percobaan
            $retryDelaySeconds = 5; // Waktu penundaan antara percobaan

            foreach ($urls as $url) {
                $retry = 0;
                $success = false;

                while (!$success && $retry < $maxRetries) {
                    try {
                        // set_time_limit(200);
                        $response = Http::timeout(30)->retry($maxRetries, $retryDelaySeconds)->get($url);
                        $nis = $response->json();
                        $success = true;
                    } catch (\Exception $e) {
                        // Tangani kesalahan, misalnya mencetak pesan kesalahan dan menunggu beberapa detik sebelum mencoba lagi
                        // Anda juga dapat membatasi jumlah percobaan retry yang dilakukan
                        $retry++;
                        sleep($retryDelaySeconds);
                    }
                }

                if (!$success) {
                    // Penanganan jika permintaan gagal setelah sejumlah percobaan
                    // Misalnya, Anda dapat mencatat pesan kesalahan atau memberi tahu pengguna.
                    dd("Permintaan ke URL $url gagal setelah $maxRetries percobaan.");
                }

                // Lanjutkan pemrosesan data setelah permintaan berhasil
                if (isset($nis['dataAbsensiKelas'])) {
                    foreach ($nis['dataAbsensiKelas'] as $item) {
                        // Filter berdasarkan jenjang 'Wustho' atau 'Ulya'
                        if (in_array($item['jenjang'], ['Ulya', 'Wustho'])) {
                            $filteredData[] = $item;
                        }
                    }
                }
            }

            $progressBar = '<script>NProgress.start();</script>';

            // Bagi data menjadi batch-batch seukuran 1000
            $batches = array_chunk($filteredData, 1000);

            foreach ($batches as $batch) {
                RekapHarian::upsert(
                    $batch,
                    ['id_sesi_kelas'], // Kolom untuk dicocokkan
                    [
                        'jenjang',
                        'nama_asrama',
                        'nama_siswa',
                        'nama_kelas',
                        'keterangan',
                        'tgl',
                        'id_sesi_kelas',
                    ]
                );
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
