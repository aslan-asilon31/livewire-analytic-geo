<div class="p-6">

    <h1 class="text-2xl font-bold mb-6">Analytic Bussiness By AslanAsilon</h1>

    {{-- Top Grid: 1 row, 2 columns --}}
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
        {{-- Left Column --}}
        <div class="bg-white border rounded-lg p-4 shadow">
            <x-carousel :slides="$slides" autoplay class="!h-32" />
        </div>

        {{-- Right Column: 2 rows --}}
        <div class="grid grid-rows-2 gap-4">
            <div class="bg-white border rounded-lg p-4 shadow">
                <img src="{{ asset('decoration/decoration1.png') }}" alt="" srcset="">
            </div>
            <div class="bg-white border rounded-lg p-4 shadow">
                <img src="{{ asset('decoration/decoration2.png') }}" alt="" srcset="">
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-3 lg:grid-cols-4 gap-6">
        

        @foreach($analytics as $item)
            <div class="bg-white border rounded-lg shadow p-4 flex flex-col items-center text-center hover:shadow-md transition-shadow">
                <img src="{{ asset($item['image']) }}" alt="{{ $item['title'] }}" class="h-16 mb-3">
                <h2 class="text-md font-semibold text-gray-800">{{ $item['title'] }}</h2>
            </div>
        @endforeach
    </div>
</div>
