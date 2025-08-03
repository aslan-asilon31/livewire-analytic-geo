<div>
    <!-- HEADER -->
    <x-header title="Peta Penjualan" separator progress-indicator>
        <x-slot:middle class="!justify-end">
            <x-input placeholder="Search..." wire:model.live.debounce="search" clearable icon="o-magnifying-glass" />
        </x-slot:middle>
    </x-header>

    <!-- Peta -->
    <div id="map" style="height: 500px;"></div>

    <script>
        // Inisialisasi peta
        var map = L.map('map').setView([0, 120], 5); // Set lokasi peta Indonesia (latitude, longitude)

        // Menambahkan Tile Layer (peta dasar)
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
        }).addTo(map);

        // Titik lokasi
        var locations = [
            { city: 'Medan', lat: 3.5952, lon: 98.6722, sales: 1500000 },
            { city: 'Jakarta', lat: -6.2088, lon: 106.8456, sales: 2500000 },
            { city: 'Bandung', lat: -6.9175, lon: 107.6191, sales: 1800000 },
            { city: 'Semarang', lat: -7.0051, lon: 110.4381, sales: 1300000 },
            { city: 'Surabaya', lat: -7.2504, lon: 112.7688, sales: 2200000 }
        ];

        // Menambahkan marker untuk setiap lokasi
        locations.forEach(function(location) {
            L.marker([location.lat, location.lon])
                .addTo(map)
                .bindPopup("<b>" + location.city + "</b><br>Sales: Rp " + location.sales.toLocaleString())
                .openPopup();
        });
    </script>
</div>
