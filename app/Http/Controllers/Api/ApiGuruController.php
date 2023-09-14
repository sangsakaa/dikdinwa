<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Http;

class ApiGuruController extends Controller
{
    public function getDataGuru()
    {

        $urls = [
            "https://wustho.smedi.my.id/api/siswa",
            "https://ulya.smedi.my.id/api/siswa",
            "https://ula.smedi.my.id/api/siswa",
        ];

        $siswa = [];

        foreach ($urls as $url) {
            $response = Http::get($url);

            if ($response->successful()) {
                $siswa[] = $response->json();
            } else {
                // Handle error for this URL, e.g., log or throw an exception
            }
        }

        return view('guru.data', compact('siswa'));
    }
}
