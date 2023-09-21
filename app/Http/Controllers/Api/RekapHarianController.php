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

            foreach ($urls as $url) {
                try {
                    // Gunakan cURL untuk mengambil data dari URL
                    $ch = curl_init();
                    curl_setopt($ch, CURLOPT_URL, $url);
                    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                    $data = curl_exec($ch);

                    if (curl_errno($ch)) {
                        throw new \Exception("Curl error: " . curl_error($ch));
                    }

                    curl_close($ch);

                    $nis = json_decode($data, true);

                    // Lanjutkan pemrosesan data setelah permintaan berhasil
                    if (isset($nis['dataAbsensiKelas'])) {
                        foreach ($nis['dataAbsensiKelas'] as $item) {
                            // Filter berdasarkan jenjang 'Wustho' atau 'Ulya'
                            if (in_array($item['jenjang'], ['Ulya', 'Wustho', 'Ula'])) {
                                $filteredData[] = $item;
                            }
                        }
                    }
                } catch (\Exception $e) {
                    // Tangani kesalahan, misalnya mencetak pesan kesalahan
                    dd("Error: " . $e->getMessage());
                }
            }

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
            dd("Error: " . $e->getMessage()); // Ini hanya contoh penanganan kesalahan sederhana
        }

        return redirect()->back();
    }
}
