<div>

    <!-- Header -->
    <x-header title="Pendapatan per Wilayah" separator progress-indicator>
        <x-slot:middle class="!justify-end">
            {{-- <x-input placeholder="Search..." wire:model.live.debounce="search" clearable icon="o-magnifying-glass" /> --}}
        </x-slot:middle>
    </x-header>

    <!-- Tombol Zoom ke Wilayah -->
    <div class="mb-4 space-x-2">
        <button onclick="zoomTo('Jakarta')" class="px-4 py-2 bg-blue-500 text-white rounded">Jakarta</button>
        <button onclick="zoomTo('Medan')" class="px-4 py-2 bg-green-500 text-white rounded">Medan</button>
        <button onclick="zoomTo('Bandung')" class="px-4 py-2 bg-purple-500 text-white rounded">Bandung</button>
        <button onclick="zoomTo('Semarang')" class="px-4 py-2 bg-yellow-500 text-white rounded">Semarang</button>
        <button onclick="zoomTo('Surabaya')" class="px-4 py-2 bg-red-500 text-white rounded">Surabaya</button>
    </div>

    <div class="mb-6">
    <h3 class="font-semibold mb-2 text-gray-700">Lihat Detail Cabang</h3>
        <div class="space-x-2">
            <button onclick="openCabangDetail('Medan')" class="px-4 py-2 bg-gray-700 text-white rounded">Medan</button>
            <button onclick="openCabangDetail('Cabang Jakarta - Umeda')" class="px-4 py-2 bg-blue-700 text-white rounded">Jakarta - Umeda</button>
            <button onclick="openCabangDetail('Cabang Jakarta - KBN')" class="px-4 py-2 bg-blue-600 text-white rounded">Jakarta - KBN</button>
            <button onclick="openCabangDetail('Cabang Jakarta - 05')" class="px-4 py-2 bg-blue-500 text-white rounded">Jakarta - 05</button>
            <button onclick="openCabangDetail('Cabang Jakarta - 89')" class="px-4 py-2 bg-blue-400 text-white rounded">Jakarta - 89</button>
            <button onclick="openCabangDetail('Bandung')" class="px-4 py-2 bg-purple-700 text-white rounded">Bandung</button>
            <button onclick="openCabangDetail('Semarang')" class="px-4 py-2 bg-yellow-600 text-white rounded">Semarang</button>
            <button onclick="openCabangDetail('Surabaya')" class="px-4 py-2 bg-red-600 text-white rounded">Surabaya</button>
        </div>
    </div>

    <!-- Peta Lokasi -->
    <div id="map" style="height: 500px;"></div>

    <!-- Chart: Pendapatan per Wilayah -->
    <div class="mt-6">
        <h2 class="text-lg font-semibold mb-2">Pendapatan per Wilayah</h2>
        <canvas id="pendapatanPerWilayah" height="200"></canvas>
    </div>

    <!-- Chart: Transaksi Tiap Bulan per Cabang -->
    <div class="mt-6">
        <h2 class="text-lg font-semibold mb-2">Transaksi Tiap Bulan per Cabang</h2>
        <canvas id="chartTransaksiBulanan" height="200"></canvas>
    </div>

    <!-- Informasi Cabang -->
    <div id="deskripsi" class="p-4 bg-gray-100 rounded shadow mt-6">
        <h2 class="text-lg font-semibold mb-2">Informasi Cabang</h2>
        <p>
            Berikut adalah data cabang yang tersebar di berbagai kota besar di Indonesia. Setiap marker pada peta
            menunjukkan lokasi cabang dengan jumlah transaksi yang ditampilkan langsung di atasnya.
            Gunakan tombol di atas untuk melihat lebih dekat ke masing-masing wilayah.
        </p>
    </div>

    <!-- Chart: Jumlah Transaksi per Wilayah -->
    <div class="mt-6">
        <h2 class="text-lg font-semibold mb-2">Jumlah Transaksi per Wilayah</h2>
        <canvas id="transaksiPerWilayah" height="200"></canvas>
    </div>

    <!-- Chart: Pendapatan Bulanan -->
    <div class="mt-6">
        <h2 class="text-lg font-semibold mb-2">Pendapatan Tiap Bulan</h2>
        <canvas id="pendapatanBulanan" height="200"></canvas>
    </div>

    <!-- Leaflet CSS -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" />

    <!-- Leaflet & Chart.js JS -->
    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>

    <!-- Custom Script -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const map = L.map('map').setView([0, 120], 5);

            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '&copy; OpenStreetMap contributors'
            }).addTo(map);

            const locations = @json($locations);
            const cityCoordinates = {};

            locations.forEach(loc => {
                L.marker([loc.latitude, loc.longitude]).addTo(map)
                    .bindTooltip(`
                        <strong>${loc.city}</strong><br>
                        🧾 ${loc.transactions} transaksi
                    `, {
                        permanent: true,
                        direction: 'top',
                        offset: [0, -10],
                        className: 'custom-tooltip'
                    });

                // Koordinat utama
                if (loc.city.includes('Jakarta') && !cityCoordinates['Jakarta']) {
                    cityCoordinates['Jakarta'] = [loc.latitude, loc.longitude];
                } else if (loc.city.includes('Medan')) {
                    cityCoordinates['Medan'] = [loc.latitude, loc.longitude];
                } else if (loc.city.includes('Bandung')) {
                    cityCoordinates['Bandung'] = [loc.latitude, loc.longitude];
                } else if (loc.city.includes('Semarang')) {
                    cityCoordinates['Semarang'] = [loc.latitude, loc.longitude];
                } else if (loc.city.includes('Surabaya')) {
                    cityCoordinates['Surabaya'] = [loc.latitude, loc.longitude];
                }
            });

            // Zoom ke wilayah tertentu
            window.zoomTo = function (city) {
                if (cityCoordinates[city]) {
                    map.setView(cityCoordinates[city], 12);
                } else {
                    alert("Wilayah tidak ditemukan");
                }
            };

            // Chart: Jumlah Transaksi per Wilayah
            const ctxTransaksi = document.getElementById('transaksiPerWilayah').getContext('2d');
            new Chart(ctxTransaksi, {
                type: 'bar',
                data: {
                    labels: locations.map(l => l.city),
                    datasets: [{
                        label: 'Jumlah Transaksi',
                        data: locations.map(l => l.transactions),
                        backgroundColor: 'rgba(54, 162, 235, 0.6)',
                        borderColor: 'rgba(0,0,0,0.2)',
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true,
                            ticks: { stepSize: 50 }
                        }
                    }
                }
            });

            // Chart: Pendapatan per Wilayah
            const ctxPendapatan = document.getElementById('pendapatanPerWilayah').getContext('2d');
            new Chart(ctxPendapatan, {
                type: 'bar',
                data: {
                    labels: locations.map(loc => loc.city),
                    datasets: [{
                        label: 'Pendapatan (Rp)',
                        data: locations.map(loc => loc.sales),
                        backgroundColor: 'rgba(54, 162, 235, 0.3)',
                        borderColor: 'rgba(54, 162, 235, 1)',
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        y: { beginAtZero: true }
                    }
                }
            });

            // Chart: Pendapatan Bulanan (dummy)
            const ctxBulanan = document.getElementById('pendapatanBulanan').getContext('2d');
            new Chart(ctxBulanan, {
                type: 'line',
                data: {
                    labels: ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu'],
                    datasets: [{
                        label: 'Pendapatan Bulanan (Rp)',
                        data: [12000000, 13500000, 14200000, 13000000, 15000000, 16500000, 17200000, 18000000],
                        backgroundColor: 'rgba(255, 99, 132, 0.5)',
                        borderColor: 'rgba(255, 99, 132, 1)',
                        borderWidth: 2
                    }]
                },
                options: {
                    responsive: true,
                    scales: {
                        y: {
                            beginAtZero: true,
                            ticks: {
                                callback: function (value) {
                                    return 'Rp ' + value.toLocaleString();
                                }
                            }
                        }
                    }
                }
            });

            // Chart: Transaksi Bulanan per Cabang (gunakan data dari PHP jika tersedia)
            const ctxTransaksiBulanan = document.getElementById('chartTransaksiBulanan').getContext('2d');

            const months = ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'];
            const datasets = locations.map(loc => ({
                label: loc.city,
                data: Object.values(loc.monthly_transactions || {}),
                backgroundColor: 'rgba(' + Math.floor(Math.random()*255) + ',' + Math.floor(Math.random()*255) + ',' + Math.floor(Math.random()*255) + ',0.4)',
                borderColor: 'rgba(0,0,0,0.1)',
                borderWidth: 1
            }));

            new Chart(ctxTransaksiBulanan, {
                type: 'bar',
                data: {
                    labels: months,
                    datasets: datasets
                },
                options: {
                    responsive: true,
                    scales: {
                        y: { beginAtZero: true }
                    }
                }
            });

        });
    </script>

    <!-- Custom Tooltip Style -->
    <style>
        .custom-tooltip {
            background: #ffffff;
            border: 1px solid #ccc;
            padding: 6px 10px;
            font-size: 13px;
            color: #333;
            border-radius: 4px;
        }
    </style>


<script>
    function openCabangDetail(cabang) {
        alert('cek');   
        const encodedCabang = encodeURIComponent(cabang);
        window.open(`/detail-cabang/${encodedCabang}`, '_blank');
    }
</script>
</div>
