<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Client\ConnectionException;

class ApiTestingController extends Controller
{
    private $token = null;
    private function getToken()
    {
        $response = Http::post('http://sia-uniwa.ddns.net:8100/ws/live2.php', [
            'act' => 'GetToken',
            'username' => env('PDDIKTI_USERNAME'),
            'password' => env('PDDIKTI_PASSWORD')
        ]);
        $this->token = $response['data']['token'];
    }
    private function getMahasiswa()
    {
        if (!$this->token) $this->getToken();
        $response = Http::post('http://sia-uniwa.ddns.net:8100/ws/live2.php', [
            'act' => 'GetListMahasiswa',
            'token' => $this->token,
            // 'filter' => "nama_status_mahasiswa = 'AKTIF'",
            // 'order' =>  'nama_program_studi,id_periode,nama_mahasiswa',
            'limit' => 0
        ]);
        
        $hapusNimNull = function ($data) {
            return $data['nim'] != null;
        };
        return array_filter($response['data'], $hapusNimNull);
    }
    public function index()
    {
        try {
            $data = $this->getMahasiswa();
        } catch (ConnectionException $ex) {
            return view('siswa.getData', ['listMahasiswa' => [], 'total' => 0])->with('error', 'tidak terhubung dengan server');
        }
        dd($data);

        $total = count($data);

        return view('siswa.getData', ['listMahasiswa' => $data, 'total' => $total]);
    
        
    }
}
