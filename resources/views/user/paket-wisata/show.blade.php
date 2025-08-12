<x-user-layout>
    @php
        function formatPrice($price)
        {
            return 'Rp ' . number_format($price, 0, ',', '.');
        }
    @endphp

    <div class="min-h-screen bg-gray-50 py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Back Link -->
            <div class="mb-6">
                <a href="{{ route('user.paket-wisata.index') }}"
                    class="text-sm text-gray-600 hover:underline flex items-center">
                    <svg class="h-4 w-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                    </svg>
                    Kembali ke Daftar Tour
                </a>
            </div>

            <!-- Title & Location -->
            <div class="mb-6">
                <h1 class="text-3xl font-bold text-gray-900 mb-2">{{ $paketWisata->nama }}</h1>
                <div class="flex items-center text-sm text-gray-600">
                    <svg class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                    </svg>
                    {{ $paketWisata->lokasi }}
                </div>
            </div>

            <!-- Image & Info -->
            <div class="flex flex-col lg:flex-row gap-8 mb-10">
                <div class="flex-shrink-0 w-full lg:w-2/3">
                    <img src="{{ filter_var($paketWisata->gambar, FILTER_VALIDATE_URL) ? $paketWisata->gambar : asset('storage/' . $paketWisata->gambar) }}"
                        alt="{{ $paketWisata->nama }}" class="w-full h-full object-cover rounded-lg shadow-md">
                </div>
            </div>

            <div class="flex flex-col lg:flex-row gap-8 mb-10">
                <div class="bg-white border border-gray-200 rounded-lg shadow-sm p-6 w-full lg:w-1/3">
                    <div class="text-2xl font-bold text-gray-900 mb-1">
                        {{ formatPrice($paketWisata->harga_jual) }}
                    </div>
                    <div class="text-sm text-gray-500 mb-4">
                        @if (in_array($paketWisata->target_peserta, ['umum', 'orang', '']))
                            per orang
                        @else
                            per {{ $paketWisata->target_peserta }}
                        @endif
                    </div>

                    <p class="flex justify-between items-center text-sm text-gray-900 mb-2">
                        Durasi
                        <span class="font-normal">{{ $paketWisata->durasi }}</span>
                    </p>

                    @if (in_array($paketWisata->tipe_harga, ['per_paket', 'per_pasangan']) && $paketWisata->jumlah_orang)
                        <p class="text-sm text-gray-600 mb-2">
                            Termasuk untuk <span class="font-medium">{{ $paketWisata->jumlah_orang }}</span> orang.
                        </p>
                    @endif

                    <a href="{{ route('user.pemesanan.form', $paketWisata->id) }}">
                        <button
                            class="w-full bg-emerald-600 hover:bg-emerald-700 text-white text-base font-semibold py-3 rounded-md transition">
                            Pesan Sekarang
                        </button>
                    </a>

                    <p class="text-center text-gray-500 text-xs mt-4">
                        
                    </p>
                </div>
            </div>

            <!-- Deskripsi -->
            <div class="mb-10">
                <h2 class="text-xl font-semibold text-gray-900 mb-3">Deskripsi</h2>
                <div class="text-gray-700 text-sm leading-relaxed">
                    {!! nl2br(e($paketWisata->deskripsi)) !!}
                </div>
            </div>

            <!-- Fasilitas -->
            <div class="mb-10">
                <h2 class="text-xl font-semibold text-gray-900 mb-3">Fasilitas & Kegiatan</h2>
                @if ($paketWisata->fasilitas->isNotEmpty())
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                        @foreach ($paketWisata->fasilitas as $item)
                            <div class="flex items-start">
                                <svg class="h-5 w-5 text-emerald-500 mr-2 mt-0.5 flex-shrink-0" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M5 13l4 4L19 7" />
                                </svg>
                                <span class="text-sm text-gray-700">{{ $item->nama }}</span>
                            </div>
                        @endforeach
                    </div>
                @else
                    <p class="text-sm text-gray-500 italic">Tidak ada fasilitas tersedia.</p>
                @endif
            </div>
        </div>
    </div>
</x-user-layout>
