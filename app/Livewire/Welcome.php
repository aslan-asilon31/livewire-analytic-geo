<?php

namespace App\Livewire;

use Illuminate\Support\Collection;
use Livewire\Component;
use Mary\Traits\Toast;

class Welcome extends Component
{
    use Toast;
    public array $slides = [];
    public array $analytics = [];

    public function mount()
    {
        $this->slides = [
            ['image' => 'slider-analytic/slider-analytic1.png'],
            ['image' => 'slider-analytic/slider-analytic2.png'],
            ['image' => 'slider-analytic/slider-analytic3.png'],
            ['image' => 'slider-analytic/slider-analytic4.png'],
        ];


        $this->analytics = [
            ['title' => 'Pendapatan Per Wilayah',     'image' => 'icons-img/Data-Analytics.png'],
            ['title' => 'Tren Penjualan Berdasarkan Waktu',         'image' => 'icons-img/Data-Cloud.png'],
            ['title' => 'Waktu Pengiriman & Dwelling Time',     'image' => 'icons-img/Data-Scientist.png'],
            ['title' => 'Transaksi per Wilayah',    'image' => 'icons-img/Data-Collection.png'],
            ['title' => 'Segmentasi Demografi',     'image' => 'icons-img/Data-Filtering.png'],
            ['title' => 'Produk Terlaris per Wilayah',        'image' => 'icons-img/Data-Mining.png'],
            ['title' => 'Perilaku Konsumen',  'image' => 'icons-img/Data-Presentation.png'],
            ['title' => 'Stok Produk per Wilayah',    'image' => 'icons-img/Data-Protection.png'],
            ['title' => 'Promo dan Kampanye Wilayah',      'image' => 'icons-img/Data-Recovery.png'],
            ['title' => 'Lokasi Gudang dan Distribusi',      'image' => 'icons-img/Data-Research.png'],
            ['title' => 'Kepadatan Populasi',       'image' => 'icons-img/Data-Sharing.png'],
            ['title' => 'Pertumbuhan Penjualan',     'image' => 'icons-img/Data-Structure.png'],
            ['title' => 'Pengaruh Musim/Cuaca',      'image' => 'icons-img/Data-Transfer.png'],
            ['title' => 'Persaingan Antar Wilayah',     'image' => 'icons-img/Data-Warehouse.png'],
            ['title' => 'Layanan Purna Jual',           'image' => 'icons-img/Database.png'],
            ['title' => 'Growth Report',      'image' => 'icons-img/Growth-Report.png'],
            ['title' => 'Market Analysis',    'image' => 'icons-img/Market-Analysis.png'],
            ['title' => 'Market Research',    'image' => 'icons-img/Market-Research.png'],
            ['title' => 'Secure Backup',      'image' => 'icons-img/Secure-Backup.png'],
            ['title' => 'Statistics',         'image' => 'icons-img/Statistics.png'],
        ];
    }

    public function render()
    {
        return view('livewire.welcome');
    }
}
