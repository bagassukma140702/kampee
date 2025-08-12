<x-user-layout>

    @php
        if (!function_exists('formatPrice')) {
            function formatPrice($amount)
            {
                return 'Rp ' . number_format($amount, 0, ',', '.');
            }
        }
    @endphp

    <div x-data="{ showFilters: false }" class="min-h-screen bg-gray-50">
        <!-- Results -->
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
            <div class="flex items-center justify-between mb-6">
                <h1 class="text-2xl font-bold text-gray-900">
                    Paket Wisata
                </h1>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-12">
                @foreach ($tours as $tour)
                    @php
                        $target = $tour->target_peserta;
                        $target = in_array($target, ['umum', 'orang', '']) ? 'orang' : $target;
                    @endphp
                    <a href="{{ route('user.paket-wisata.show', $tour->id) }}"
                        class="block bg-white rounded-xl shadow-sm hover:shadow-md transition-all border overflow-hidden group">
                        <div class="relative">
                            <img src="{{ filter_var($tour->gambar, FILTER_VALIDATE_URL) ? $tour->gambar : asset('storage/' . $tour->gambar) }}"
                                alt="{{ $tour->nama }}"
                                class="w-full aspect-[4/4] object-cover group-hover:scale-105 transition-transform duration-300">
                            <p class="absolute top-3 right-3 bg-white text-gray-900 px-2 py-1 rounded-full text-sm ">
                                {{ $target }}
                            </p>
                        </div>
                        <div class="p-4 space-y-2">
                            <h3
                                class="text-xl font-semibold text-gray-900 group-hover:text-emerald-600 transition-colors">
                                {{ $tour->nama }}</h3>
                            <p class="text-sm text-gray-500 flex items-center gap-1">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7z" />
                                    <circle cx="12" cy="9" r="2.5" stroke="currentColor" stroke-width="2"
                                        fill="none" />
                                </svg>
                                {{ $tour->lokasi }}
                            </p>
                            <p class="text-sm text-gray-500 flex items-center gap-1">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                    xmlns="http://www.w3.org/2000/svg" class="h-4 w-4">
                                    <path d="M12 8V12L14.5 13.5" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round" />
                                    <circle cx="12" cy="12" r="9" stroke="currentColor"
                                        stroke-width="2" />
                                </svg>
                                Durasi: {{ $tour->durasi }}
                            </p>
                            <div>
                                <p class="text-gray-900 font-bold text-end text-xl tracking-tight">
                                    {{ formatPrice($tour->harga_jual) }}
                                </p>
                                <p class="text-sm text-gray-500 font-normal text-end">per {{ $target }}</p>
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>

        </div>
    </div>

</x-user-layout>
