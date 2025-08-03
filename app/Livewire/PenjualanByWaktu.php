<?php

namespace App\Livewire;

use Livewire\Component;

class PenjualanByWaktu extends Component
{
    public $locations;

    public function mount()
    {
        $bulan = ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'];
        $this->locations = [

            // wilayah medan
            ['city' => 'Medan', 'latitude' => 3.5952, 'longitude' => 98.6722, 'sales' => 1500000, 
                'transactions' => 120,
                'monthly_transactions' => $this->generateMonthlyData($bulan)
            ],

            // wilayah jakarta
            ['city' => 'Cabang Jakarta - Umeda', 'latitude' => -6.136240, 'longitude' => 106.788331, 'sales' => 2500000, 
                'transactions' => 75,
                'monthly_transactions' => $this->generateMonthlyData($bulan)
            ],

            ['city' => 'Cabang Jakarta - KBN', 'latitude' => -6.136246, 'longitude' => 106.788422, 'sales' => 2500000, 
                'transactions' => 80,
                'monthly_transactions' => $this->generateMonthlyData($bulan)
            ],

            ['city' => 'Cabang Jakarta - 05', 'latitude' => -6.148773, 'longitude' => 106.778389, 'sales' => 2500000,
                'transactions' => 130,
                'monthly_transactions' => $this->generateMonthlyData($bulan)
            ],

            ['city' => 'Cabang Jakarta - 89', 'latitude' => -6.147866, 'longitude' => 106.774144, 'sales' => 2500000, 
                'transactions' => 90,
                'monthly_transactions' => $this->generateMonthlyData($bulan)
            ],


            // wilayah bandung
            ['city' => 'Bandung', 'latitude' => -6.9175, 'longitude' => 107.6191, 'sales' => 1800000, 
                'transactions' => 90,
                'monthly_transactions' => $this->generateMonthlyData($bulan)
            ],

            // wilayah semarang
            ['city' => 'Semarang', 'latitude' => -7.0051, 'longitude' => 110.4381, 'sales' => 1300000, 
                'transactions' => 90,
                'monthly_transactions' => $this->generateMonthlyData($bulan)
            ],

            // wilayah surabaya
            ['city' => 'Surabaya', 'latitude' => -7.2504, 'longitude' => 112.7688, 'sales' => 2200000,
                'transactions' => 90,
                'monthly_transactions' => $this->generateMonthlyData($bulan)
            ],
        ];
    }

    private function generateMonthlyData(array $bulan)
    {
        $data = [];

        foreach ($bulan as $b) {
            // Kamu bisa ganti logic di sini jika punya data asli
            $data[$b] = rand(5, 25); // contoh: 5–25 transaksi per bulan
        }

        return $data;
    }


    public function render()
    {
        return view('livewire.penjualan-bywaktu', [
            'locations' => $this->locations
        ]);
    }
}
