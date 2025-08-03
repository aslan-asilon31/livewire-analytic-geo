<div id="map" style="height: 500px;"></div>

@push('scripts')
<script>
    // Inisialisasi peta
    var map = L.map('map').setView([-2.5, 118], 5);  // Koordinat pusat Indonesia

    // Tile Layer (peta dasar)
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
    }).addTo(map);

    // Menambahkan marker untuk setiap lokasi transaksi
    @foreach($locations as $location)
        L.marker([{{ $location['latitude'] }}, {{ $location['longitude'] }}])
            .addTo(map)
            .bindPopup('<strong>{{ $location['city'] }}</strong><br>Jumlah Transaksi: {{ $location['transactions'] }}');
    @endforeach
</script>
@endpush
