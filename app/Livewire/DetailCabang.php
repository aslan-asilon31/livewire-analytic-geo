<?php

namespace App\Livewire;

use Livewire\Component;

class DetailCabang extends Component
{
    public $cabang;
    public $data;

    public function mount($cabang)
    {
        $this->cabang = urldecode($cabang);
        

        $bulan = ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'];

        // Dummy data berdasarkan nama cabang
        $this->data = [
            'nama' => $this->cabang,
            'deskripsi' => "Ini adalah cabang $this->cabang yang terletak di lokasi strategis.",
            'monthly' => $this->generateMonthlyData($bulan),
            'bulan' => $bulan,

            'harian' => rand(3, 15),
            'mingguan' => rand(20, 70),
            'bulanan' => rand(100, 250),
            'tahunan' => rand(1000, 3000),

        ];


    }

    private function generateMonthlyData($bulan)
    {
        $result = [];
        foreach ($bulan as $b) {
            $result[] = rand(5, 30);
        }
        return $result;
    }

    public function render()
    {
        return view('livewire.detail-cabang');
    }
}
