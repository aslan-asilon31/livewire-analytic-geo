<?php

namespace App\Livewire;

use Livewire\Component;

class PendapatanPerWilayah extends Component
{
    public $locations;

    public function mount()
    {
        // Data Dummy Pendapatan per Wilayah
        $this->locations = [

            // wilayah medan
            ['city' => 'Medan', 'latitude' => 3.5952, 'longitude' => 98.6722, 'sales' => 1500000, 'transactions' => 120],

            // wilayah jakarta
            ['city' => 'Cabang Jakarta - Umeda', 'latitude' => -6.136240, 'longitude' => 106.788331, 'sales' => 2500000, 'transactions' => 189],
            ['city' => 'Cabang Jakarta - KBN', 'latitude' => -6.136246, 'longitude' => 106.788422, 'sales' => 2500000, 'transactions' => 189],
            ['city' => 'Cabang Jakarta - 05', 'latitude' => -6.148773, 'longitude' => 106.778389, 'sales' => 2500000, 'transactions' => 189],
            ['city' => 'Cabang Jakarta - 89', 'latitude' => -6.147866, 'longitude' => 106.774144, 'sales' => 2500000, 'transactions' => 189],

            // wilayah bandung
            ['city' => 'Bandung', 'latitude' => -6.9175, 'longitude' => 107.6191, 'sales' => 1800000, 'transactions' => 194],

            // wilayah semarang
            ['city' => 'Semarang', 'latitude' => -7.0051, 'longitude' => 110.4381, 'sales' => 1300000, 'transactions' => 99],

            // wilayah surabaya
            ['city' => 'Surabaya', 'latitude' => -7.2504, 'longitude' => 112.7688, 'sales' => 2200000, 'transactions' => 65],
        ];
    }

    public function render()
    {
        return view('livewire.pendapatan-perwilayah', [
            'locations' => $this->locations
        ]);
    }
}
