<?php

namespace App\Http\Livewire;

use Livewire\Component;

class DiskusiProduk extends Component
{
    public $components = 'detail-produk';
    public $message = 'FUCK';

    public function anjingBanget() {
       $this->message = "OOKHE";
    }

    public function render()
    {
        return view('livewire.' . $this->components);
    }
}
