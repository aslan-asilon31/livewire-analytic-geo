<div>
  <h2 class="text-xl font-bold mb-4">Rute dari Umeda ke Customer Cempaka Putih</h2>

  <ul class="mb-4 space-y-1">
    @foreach ($routeDistances as $route => $distance)
    <li>
      <strong>{{ $route }}</strong>: {{ number_format($distance, 2) }} km
      @if ($fastestRoute === $route)
      <span class="text-green-600 font-semibold">← Rute tercepat</span>
      @endif
    </li>
    @endforeach
  </ul>

  <div id="map" style="height: 500px;" class="rounded shadow"></div>

  <script>
    document.addEventListener('livewire:load', function() {
      const map = L.map('map').setView([-6.1745, 106.8227], 13);

      L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; OpenStreetMap contributors',
      }).addTo(map);

      const routes = @json($routes);
      const fastestRoute = @json($fastestRoute);

      const colors = {
        'Kota Tua': 'red',
        'Thamrin': 'blue',
        'Tanah Abang': 'orange',
      };

      for (const [routeName, coordinates] of Object.entries(routes)) {
        const latlngs = coordinates.map(p => [p.lat, p.lng]);

        L.polyline(latlngs, {
          color: colors[routeName] || 'black',
          weight: 5,
          opacity: routeName === fastestRoute ? 1 : 0.5,
          dashArray: routeName === fastestRoute ? null : '4,8',
        }).addTo(map);

        if (routeName === 'Kota Tua') {
          L.marker(latlngs[0]).addTo(map).bindPopup('Umeda (Start)').openPopup();
          L.marker(latlngs[latlngs.length - 1]).addTo(map).bindPopup('Customer Cempaka Putih (Tujuan)');
        }
      }
    });
  </script>
</div>