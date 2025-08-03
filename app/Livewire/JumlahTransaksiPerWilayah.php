<?php

namespace App\Livewire;
use Livewire\Component;
class JumlahTransaksiPerWilayah extends Component
{
    public $locations = [];
    public function mount()
    {
        // Data dummy lokasi dan jumlah transaksi
        $this->locations = [
            ['city' => 'Medan', 'latitude' => 3.5952, 'longitude' => 98.6722, 'transactions' => 120],
            ['city' => 'Jakarta', 'latitude' => -6.2088, 'longitude' => 106.8456, 'transactions' => 250],
            ['city' => 'Bandung', 'latitude' => -6.9175, 'longitude' => 107.6191, 'transactions' => 180],
            ['city' => 'Semarang', 'latitude' => -7.0051, 'longitude' => 110.4381, 'transactions' => 130],
            ['city' => 'Surabaya', 'latitude' => -7.2504, 'longitude' => 112.7688, 'transactions' => 220],
        ];
    }
    public function render()
    {
        return view('livewire.jumlah-transaksi-per-wilayah', [
            'locations' => $this->locations,
        ]);
    }
}