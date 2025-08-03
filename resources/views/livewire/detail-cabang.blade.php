<div class="p-6 max-w-4xl mx-auto">
    <h1 class="text-2xl font-bold mb-4">Detail Cabang: {{ $data['nama'] }}</h1>
    
    <p class="mb-4 text-gray-700">
        {{ $data['deskripsi'] }}
    </p>


    <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-6">
    <div class="p-4 bg-blue-100 rounded text-center">
        <div class="text-sm text-gray-600">Hari Ini</div>
        <div class="text-2xl font-bold text-blue-700">{{ $data['harian'] }}</div>
    </div>
    <div class="p-4 bg-green-100 rounded text-center">
        <div class="text-sm text-gray-600">Minggu Ini</div>
        <div class="text-2xl font-bold text-green-700">{{ $data['mingguan'] }}</div>
    </div>
    <div class="p-4 bg-yellow-100 rounded text-center">
        <div class="text-sm text-gray-600">Bulan Ini</div>
        <div class="text-2xl font-bold text-yellow-700">{{ $data['bulanan'] }}</div>
    </div>
    <div class="p-4 bg-purple-100 rounded text-center">
        <div class="text-sm text-gray-600">Tahun Ini</div>
        <div class="text-2xl font-bold text-purple-700">{{ $data['tahunan'] }}</div>
    </div>
</div>


    {{-- <h2 class="text-lg font-semibold mb-2">Transaksi Bulanan</h2>
    <canvas id="transaksiCabangChart" height="200"></canvas> --}}


    <label for="filter" class="block text-sm font-medium text-gray-700 mb-1">Filter Transaksi</label>
   <select id="filter" onchange="updateChart(this.value)">
  <option value="harian">Hari Ini</option>
  <option value="mingguan">Minggu Ini</option>
  <option value="bulanan" selected>Bulan Ini</option>
  <option value="tahunan">Tahun Ini</option>
</select>

<canvas id="transaksiCabangChart" height="200"></canvas>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function () {
  const ctx = document.getElementById('transaksiCabangChart').getContext('2d');

  // Buat data dummy minggu dan bulan sesuai kebutuhan
  // Kamu bisa buat random data atau dari backend juga kalau ada
  const dataSets = {
    harian: { 
      labels: ['Hari Ini'], 
      data: [{{ $data['harian'] }}] // total harian
    },
    mingguan: { 
      labels: ['Sen', 'Sel', 'Rab', 'Kam', 'Jum', 'Sab', 'Min'], 
      data: Array(7).fill().map(() => Math.floor(Math.random() * 20 + 1)) // dummy minggu, bisa disesuaikan
    },
    bulanan: { 
      labels: ['Minggu 1', 'Minggu 2', 'Minggu 3', 'Minggu 4'], 
      data: Array(4).fill().map(() => Math.floor(Math.random() * 60 + 10)) // dummy 4 minggu
    },
    tahunan: { 
      labels: @json($data['bulan']), 
      data: @json($data['monthly']) 
    }
  };

  window.transaksiChart = new Chart(ctx, {
    type: 'bar',
    data: {
      labels: dataSets.bulanan.labels,
      datasets: [{
        label: 'Transaksi',
        data: dataSets.bulanan.data,
        backgroundColor: 'rgba(75, 192, 192, 0.5)',
        borderColor: 'rgba(75, 192, 192, 1)',
        borderWidth: 1
      }]
    },
    options: {
      responsive: true,
      scales: { y: { beginAtZero: true } }
    }
  });

  window.updateChart = function(filter) {
    transaksiChart.data.labels = dataSets[filter].labels;
    transaksiChart.data.datasets[0].data = dataSets[filter].data;
    transaksiChart.update();
  }
});

</script>


</div>
