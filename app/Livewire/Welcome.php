<?php

namespace App\Livewire;

use Illuminate\Support\Collection;
use Livewire\Component;
use Mary\Traits\Toast;

class Welcome extends Component
{
    use Toast;

    public string $search = '';
    public bool $drawer = false;
    public array $sortBy = ['column' => 'name', 'direction' => 'asc'];

    // Data dummy penjualan produk dan wilayah
    public function salesData(): Collection
    {
        return collect([
            ['id' => 1, 'city' => 'Medan', 'latitude' => '3.5952', 'longitude' => '98.6722', 'sales' => 1500000, 'product' => 'Roti Coklat Premium'],
            ['id' => 2, 'city' => 'Jakarta', 'latitude' => '-6.2088', 'longitude' => '106.8456', 'sales' => 2500000, 'product' => 'Roti Keju Truffle'],
            ['id' => 3, 'city' => 'Bandung', 'latitude' => '-6.9175', 'longitude' => '107.6191', 'sales' => 1800000, 'product' => 'Roti Sosis Mozzarella'],
            ['id' => 4, 'city' => 'Semarang', 'latitude' => '-7.0051', 'longitude' => '110.4381', 'sales' => 1300000, 'product' => 'Roti Almond Butter'],
            ['id' => 5, 'city' => 'Surabaya', 'latitude' => '-7.2504', 'longitude' => '112.7688', 'sales' => 2200000, 'product' => 'Roti Blueberry Cream'],
        ])
        ->sortBy([array_values($this->sortBy)])
        ->when($this->search, function (Collection $collection) {
            return $collection->filter(fn(array $item) => str($item['city'])->contains($this->search, true));
        });
    }

    // Table headers for the view
    public function headers(): array
    {
        return [
            ['key' => 'id', 'label' => '#', 'class' => 'w-1'],
            ['key' => 'city', 'label' => 'City', 'class' => 'w-64'],
            ['key' => 'sales', 'label' => 'Sales (Rp)', 'class' => 'w-32'],
            ['key' => 'product', 'label' => 'Product', 'class' => 'w-64'],
            ['key' => 'action', 'label' => 'Action', 'class' => 'w-24'],
        ];
    }

    // Delete action
    public function delete($id): void
    {
        $this->warning("Will delete #$id", 'It is fake.', position: 'toast-bottom');
    }

    public function render()
    {
        return view('livewire.welcome', [
            'sales' => $this->salesData(),
            'headers' => $this->headers()
        ]);
    }
}
