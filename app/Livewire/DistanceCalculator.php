<?php

namespace App\Livewire;

use Livewire\Component;

class DistanceCalculator extends Component
{
    public $routes = [];
    public $routeDistances = [];
    public $fastestRoute = null;

    public function mount()
    {
        // Dummy rute (koordinat real-world untuk simulasi)
        $this->routes = [
            'Kota Tua' => [
                ['lat' => -6.136240, 'lng' => 106.788331], // Umeda
                ['lat' => -6.133400, 'lng' => 106.812400], // via Kota Tua
                ['lat' => -6.176655, 'lng' => 106.865036], // Cempaka Putih
            ],
            'Thamrin' => [
                ['lat' => -6.136240, 'lng' => 106.788331], // Umeda
                ['lat' => -6.190600, 'lng' => 106.822200], // via Thamrin
                ['lat' => -6.176655, 'lng' => 106.865036], // Cempaka Putih
            ],
            'Tanah Abang' => [
                ['lat' => -6.136240, 'lng' => 106.788331], // Umeda
                ['lat' => -6.182800, 'lng' => 106.815800], // via Tanah Abang
                ['lat' => -6.176655, 'lng' => 106.865036], // Cempaka Putih
            ],
        ];

        // Hitung jarak setiap rute
        foreach ($this->routes as $routeName => $points) {
            $this->routeDistances[$routeName] = $this->calculateRouteDistance($points);
        }

        // Tentukan rute tercepat (jarak terpendek)
        asort($this->routeDistances);
        $this->fastestRoute = array_key_first($this->routeDistances);
    }

    /**
     * Hitung total jarak rute berdasarkan array titik koordinat
     */
    private function calculateRouteDistance(array $points): float
    {
        $distance = 0;

        for ($i = 0; $i < count($points) - 1; $i++) {
            $distance += $this->haversine(
                $points[$i]['lat'],
                $points[$i]['lng'],
                $points[$i + 1]['lat'],
                $points[$i + 1]['lng']
            );
        }

        return $distance;
    }

    /**
     * Rumus Haversine (jarak antara dua titik koordinat bumi dalam kilometer)
     */
    private function haversine($lat1, $lon1, $lat2, $lon2): float
    {
        $earthRadius = 6371; // Kilometer

        $dLat = deg2rad($lat2 - $lat1);
        $dLon = deg2rad($lon2 - $lon1);

        $a = sin($dLat / 2) ** 2 +
            cos(deg2rad($lat1)) * cos(deg2rad($lat2)) *
            sin($dLon / 2) ** 2;

        $c = 2 * atan2(sqrt($a), sqrt(1 - $a));

        return $earthRadius * $c;
    }

    public function render()
    {
        return view('livewire.rute-umeda', [
            'routes' => $this->routes,
            'routeDistances' => $this->routeDistances,
            'fastestRoute' => $this->fastestRoute,
        ]);
    }
}
