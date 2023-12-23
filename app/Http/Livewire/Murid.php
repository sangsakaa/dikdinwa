<?php

namespace App\Http\Livewire;

use App\Models\Siswa;
use Livewire\Component;

class Murid extends Component
{
    public $search = '';
    public $kelas = '';
    public $perPage = 10;
    public $jenjang = 'Ula';
    public function render()
    {
        $kelas = Siswa::query()
            ->where('madrasah_diniyah', $this->jenjang)->get();
        $mapkelas = $kelas->map(function ($item, $key) {
            return [
                'madrasah_diniyah' => $item['madrasah_diniyah'],
                'nama_kelas' => $item['nama_kelas'],
                // tambahkan properti lain yang Anda butuhkan
            ];
        })->unique()->sort();
        $dataSiswa = Siswa::search($this->search)
            ->orderByRaw("FIELD(madrasah_diniyah, 'Ula', 'Wustho', 'Ulya')")
            ->orderby('nama_kelas')
            ->orderby('nama_siswa')
            ->orderby('nis')
            ->when($this->jenjang, function ($query, $jenjang) {
                return $query->where('madrasah_diniyah', $jenjang);
            })
            ->when($this->kelas, function ($query, $kelas) {
                return $query->where('nama_kelas', $kelas);
            })
            ->when($this->jenjang && $this->kelas, function ($query) {
                // Apply both filters when both madrasah_diniyah and nama_kelas are selected
                return $query->where('madrasah_diniyah', $this->jenjang)
                    ->where('nama_kelas', $this->kelas);
            })
            ->paginate($this->perPage);



        // dd($dataSiswa);
        return view('livewire.murid', ['dataSiswa' => $dataSiswa, 'mapkelas' => $mapkelas]);
    }
}
