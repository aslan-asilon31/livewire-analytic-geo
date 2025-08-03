<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, viewport-fit=cover">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ isset($title) ? $title.' - '.config('app.name') : config('app.name') }}</title>


        <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" />

    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>
<!-- Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen font-sans antialiased bg-base-200">

    {{-- NAVBAR mobile only --}}
    <x-nav sticky class="lg:hidden">
        <x-slot:brand>
            <x-app-brand />
        </x-slot:brand>
        <x-slot:actions>
            <label for="main-drawer" class="lg:hidden me-3">
                <x-icon name="o-bars-3" class="cursor-pointer" />
            </label>
        </x-slot:actions>
    </x-nav>

    {{-- MAIN --}}
    <x-main>
        {{-- SIDEBAR --}}
        <x-slot:sidebar drawer="main-drawer" collapsible class="bg-base-100 lg:bg-inherit">

            {{-- BRAND --}}
            <x-app-brand class="px-5 pt-4" />

            {{-- MENU --}}
            <x-menu activate-by-route>

                {{-- User --}}
                @if($user = auth()->user())
                    <x-menu-separator />

                    <x-list-item :item="$user" value="name" sub-value="email" no-separator no-hover class="-mx-2 !-my-2 rounded">
                        <x-slot:actions>
                            <x-button icon="o-power" class="btn-circle btn-ghost btn-xs" tooltip-left="logoff" no-wire-navigate link="/logout" />
                        </x-slot:actions>
                    </x-list-item>

                    <x-menu-separator />
                @endif

                    <x-menu-item title="Dashboard" icon="o-sparkles" link="/" />
                    <x-menu-item title="Pendapatan per Wilayah" icon="o-banknotes" link="/pendapatan-per-wilayah" />
                    <x-menu-item title="Tren Penjualan Berdasarkan Waktu" icon="o-chart-bar" link="/penjualan-by-waktu" />
                    <x-menu-item title="Transaksi per Wilayah" icon="o-map" link="/jumlah-transaksi-per-wilayah" />
                    <x-menu-item title="Segmentasi Demografi" icon="o-user-group" link="/segmentasi-demografi" />
                    <x-menu-item title="Produk Terlaris per Wilayah" icon="o-shopping-bag" link="/produk-terlaris" />
                    <x-menu-item title="Perilaku Konsumen" icon="o-user-circle" link="/perilaku-konsumen" />
                    <x-menu-item title="Stok Produk per Wilayah" icon="o-cube" link="/stok-wilayah" />
                    <x-menu-item title="Promo dan Kampanye Wilayah" icon="o-bolt" link="/promo-wilayah" />
                    <x-menu-item title="Lokasi Gudang dan Distribusi" icon="o-truck" link="/gudang-distribusi" />
                    <x-menu-item title="Waktu Pengiriman & Kepuasan" icon="o-clock" link="/pengiriman-dan-kepuasan" />
                    <x-menu-item title="Kepadatan Populasi" icon="o-chart-pie" link="/kepadatan-populasi" />
                    <x-menu-item title="Pertumbuhan Penjualan" icon="o-arrow-trending-up" link="/pertumbuhan-penjualan" />
                    <x-menu-item title="Pengaruh Musim/Cuaca" icon="o-cloud" link="/pengaruh-cuaca" />
                    <x-menu-item title="Persaingan Antar Wilayah" icon="o-adjustments-horizontal" link="/persaingan-wilayah" />
                    <x-menu-item title="Layanan Purna Jual" icon="o-lifebuoy" link="/layanan-purna-jual" />

                <x-menu-sub title="Settings" icon="o-cog-6-tooth">
                    <x-menu-item title="Wifi" icon="o-wifi" link="####" />
                    <x-menu-item title="Archives" icon="o-archive-box" link="####" />
                </x-menu-sub>
            </x-menu>
        </x-slot:sidebar>

        {{-- The `$slot` goes here --}}
        <x-slot:content>
            {{ $slot }}
        </x-slot:content>
    </x-main>

    {{--  TOAST area --}}
    <x-toast />
</body>
</html>
