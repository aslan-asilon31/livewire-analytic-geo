<div>
  <!-- HEADER -->
  <x-header title="Pendapatan per Wilayah" separator progress-indicator>
    <x-slot:middle class="!justify-end">
      {{-- <x-input placeholder="Search..." wire:model.live.debounce="search" clearable icon="o-magnifying-glass" /> --}}
    </x-slot:middle>
  </x-header>
  <div class="mb-4 space-x-2">
    <button onclick="zoomTo('Jakarta')" class="px-4 py-2 bg-blue-500 text-white rounded">Jakarta</button>
    <button onclick="zoomTo('Medan')" class="px-4 py-2 bg-green-500 text-white rounded">Medan</button>
    <button onclick="zoomTo('Bandung')" class="px-4 py-2 bg-purple-500 text-white rounded">Bandung</button>
    <button onclick="zoomTo('Semarang')" class="px-4 py-2 bg-yellow-500 text-white rounded">Semarang</button>
    <button onclick="zoomTo('Surabaya')" class="px-4 py-2 bg-red-500 text-white rounded">Surabaya</button>
  </div>

  <!-- Peta -->
  <div id="map" style="height: 500px;"></div>

  <!-- Grafik Pendapatan per Wilayah -->
  <div class="mt-4">
    <canvas id="pendapatanPerWilayah"></canvas>
  </div>


  <!-- Deskripsi Cabang -->
  <div id="deskripsi" class="p-4 bg-gray-100 rounded shadow mb-6">
    <h2 class="text-lg font-semibold mb-2">Informasi Cabang</h2>
    <p>
      Berikut adalah data cabang yang tersebar di berbagai kota besar di Indonesia. Setiap marker pada peta
      menunjukkan lokasi cabang dengan jumlah transaksi yang ditampilkan langsung di atasnya.
      Gunakan tombol di atas untuk melihat lebih dekat ke masing-masing wilayah.
    </p>
  </div>

  <!-- Chart Transaksi per Wilayah -->
  <canvas id="transaksiPerWilayah" height="200" class="mb-6"></canvas>

  <!-- Chart Pendapatan Bulanan -->
  <div>
    <h2 class="text-lg font-semibold mb-2">Pendapatan Tiap Bulan</h2>
    <canvas id="pendapatanBulanan" height="200"></canvas>
  </div>

  <hr>
  <br>

  <div id="map1" style="height: 500px;"></div>

  <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" />

  <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>

  <script>
    document.addEventListener('DOMContentLoaded', function() {
      var map = L.map('map').setView([0, 120], 5);

      L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; OpenStreetMap contributors'
      }).addTo(map);

      var locations = @json($locations);
      var cityCoordinates = {};

      // Tampilkan marker + tooltip tetap
      locations.forEach(function(loc) {
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

        // Simpan koordinat utama per kota
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

      // Tombol Zoom
      window.zoomTo = function(city) {
        if (cityCoordinates[city]) {
          map.setView(cityCoordinates[city], 12);
        } else {
          alert("Wilayah tidak ditemukan");
        }
      };

      // Chart: Jumlah Transaksi per Wilayah
      var ctx1 = document.getElementById('transaksiPerWilayah').getContext('2d');
      new Chart(ctx1, {
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
              ticks: {
                stepSize: 50
              }
            }
          }
        }
      });

      // Dummy data pendapatan bulanan (bisa diganti dari Livewire juga)
      const pendapatanBulananData = {
        labels: ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu'],
        datasets: [{
          label: 'Pendapatan Bulanan (Rp)',
          data: [12000000, 13500000, 14200000, 13000000, 15000000, 16500000, 17200000, 18000000],
          backgroundColor: 'rgba(255, 99, 132, 0.5)',
          borderColor: 'rgba(255, 99, 132, 1)',
          borderWidth: 2
        }]
      };

      // Chart: Pendapatan Bulanan
      const ctx2 = document.getElementById('pendapatanBulanan').getContext('2d');
      new Chart(ctx2, {
        type: 'line',
        data: pendapatanBulananData,
        options: {
          responsive: true,
          scales: {
            y: {
              beginAtZero: true,
              ticks: {
                callback: function(value) {
                  return 'Rp ' + value.toLocaleString();
                }
              }
            }
          }
        }
      });
    });
  </script>


  <script>
    // ===========================================================

    // Inisialisasi map1
    var map1 = L.map('map1').setView([0, 120], 5); // Set lokasi peta Indonesia (latitude, longitude)

    // Menambahkan Tile Layer (peta dasar)
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
      attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
    }).addTo(map1);

    // Data Lokasi dan Penjualan
    var locations1 = @json($locations); // Mengambil data dari Livewire

    // Menambahkan marker untuk setiap lokasi
    locations1.forEach(function(location1) {
      L.marker([location1.latitude, location1.longitude])
        .addTo(map1)
        .bindPopup("<b>" + location1.city + "</b><br>Sales: Rp " + location1.sales.toLocaleString())
        .openPopup();
    });

    // Grafik Chart.js untuk Pendapatan per Wilayah
    var ctx = document.getElementById('pendapatanPerWilayah').getContext('2d');
    var pendapatanPerWilayah = new Chart(ctx, {
      type: 'bar',
      data: {
        labels: locations.map(location => location.city), // Nama kota
        datasets: [{
          label: 'Pendapatan (Rp)',
          data: locations.map(location => location.sales), // Pendapatan
          backgroundColor: 'rgba(54, 162, 235, 0.2)',
          borderColor: 'rgba(54, 162, 235, 1)',
          borderWidth: 1
        }]
      },
      options: {
        scales: {
          y: {
            beginAtZero: true
          }
        }
      }
    });
  </script>



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


</div>
</div>
