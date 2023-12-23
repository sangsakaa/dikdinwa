<?php

namespace App\Http\Livewire;

use Livewire\Component;

class ShowEditSiswa extends Component
{
    public $showModal = false;
    public $siswa;

    public function mount($siswa)
    {
        $this->siswa = $siswa;
    }

    public function render()
    {

        return view(
            'livewire.show-edit-siswa',
            [
                'siswa' => $this->siswa,
            ]
        );
    }
    public function toggleModal()
    {
        $this->showModal = !$this->showModal;
    }
}
