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
            ['image' => 'icons-img/'],
            ['image' => 'https://source.unsplash.com/600x200/?bakery'],
            ['image' => 'https://source.unsplash.com/600x200/?pastry'],
            ['image' => 'https://source.unsplash.com/600x200/?food'],
        ];


        $this->analytics = [
                            ['title' => 'Data Analytics',     'image' => 'icons-img/Data-Analytics.png'],
                            ['title' => 'Data Cloud',         'image' => 'icons-img/Data-Cloud.png'],
                            ['title' => 'Data Collection',    'image' => 'icons-img/Data-Collection.png'],
                            ['title' => 'Data Filtering',     'image' => 'icons-img/Data-Filtering.png'],
                            ['title' => 'Data Mining',        'image' => 'icons-img/Data-Mining.png'],
                            ['title' => 'Data Presentation',  'image' => 'icons-img/Data-Presentation.png'],
                            ['title' => 'Data Protection',    'image' => 'icons-img/Data-Protection.png'],
                            ['title' => 'Data Recovery',      'image' => 'icons-img/Data-Recovery.png'],
                            ['title' => 'Data Research',      'image' => 'icons-img/Data-Research.png'],
                            ['title' => 'Data Scientist',     'image' => 'icons-img/Data-Scientist.png'],
                            ['title' => 'Data Sharing',       'image' => 'icons-img/Data-Sharing.png'],
                            ['title' => 'Data Structure',     'image' => 'icons-img/Data-Structure.png'],
                            ['title' => 'Data Transfer',      'image' => 'icons-img/Data-Transfer.png'],
                            ['title' => 'Data Warehouse',     'image' => 'icons-img/Data-Warehouse.png'],
                            ['title' => 'Database',           'image' => 'icons-img/Database.png'],
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
