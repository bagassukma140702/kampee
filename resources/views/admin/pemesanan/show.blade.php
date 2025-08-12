<x-admin-layout>
    @php
        // Inisialisasi variabel $target
        $target = $pemesanan->paket->target_peserta;
        $target = in_array($target, ['umum', 'orang', '']) ? 'orang' : $target;

        // Konversi tanggal ke bahasa Indonesia
        setlocale(LC_TIME, 'id_ID.UTF-8');
        $tanggal = strftime('%A, %d %B %Y', strtotime($pemesanan->tanggal));
    @endphp

    <!-- Header -->
    <x-slot name="header">
        <h2 class="text-3xl font-semibold text-gray-900">Detail Pemesanan</h2>
        <p class="text-gray-600 mt-1">Informasi lengkap pemesanan dan paket wisata</p>
    </x-slot>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 py-8 space-y-8">
        <!-- Informasi Paket Wisata -->
        <div class="bg-white rounded-xl shadow-md overflow-hidden">
            <div class="p-6 md:p-8">
                <div class="flex flex-col md:flex-row gap-8 items-start w-full">
                    <img src="{{ asset('storage/' . $pemesanan->paket->gambar) }}" alt="{{ $pemesanan->paket->nama }}"
                        class="w-full md:w-auto h-80 object-cover rounded-md shadow-sm">
                    <div class="flex-1 space-y-4">
                        <div>
                            <h1 class="text-2xl font-bold text-gray-900">{{ $pemesanan->paket->nama }}</h1>
                            <div class="flex items-center mt-1 text-gray-600">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                                <span class="text-sm">{{ $pemesanan->paket->lokasi }}</span>
                            </div>
                            <div class="flex items-center mt-1 text-gray-600">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                    xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1">
                                    <path d="M12 8V12L14.5 13.5" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round" />
                                    <circle cx="12" cy="12" r="9" stroke="currentColor"
                                        stroke-width="2" />
                                </svg>
                                <span class="text-sm">Durasi: {{ $pemesanan->paket->durasi }}</span>
                            </div>
                        </div>

                        <p class="text-lg font-semibold text-emerald-600 mt-2">
                            Rp{{ number_format($pemesanan->paket->harga_jual, 0, ',', '.') }} <span
                                class="text-sm font-normal text-gray-500">/{{ $target }}</span>
                        </p>

                        {{-- Info tambahan berdasarkan jumlah_orang --}}
                        @if (in_array($pemesanan->paket->tipe_harga, ['per_paket', 'per_pasangan']) && $pemesanan->paket->jumlah_orang)
                            <p class="text-sm text-gray-600">
                                Termasuk untuk <span>{{ $pemesanan->paket->jumlah_orang }}</span> orang.
                            </p>
                        @endif

                        <div class="pt-2 border-t border-gray-100 mt-4">
                            <h4 class="text-sm font-medium text-gray-500 mb-2">Deskripsi Paket:</h4>
                            <p class="text-sm text-gray-600">
                                {{ $pemesanan->paket->deskripsi ?? 'Tidak ada deskripsi tersedia' }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Grid Informasi -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- Rincian Pemesanan -->
            <div class="bg-white rounded-xl shadow-md overflow-hidden">
                <div class="px-6 py-5 border-b border-gray-100">
                    <h4 class="text-lg font-semibold text-gray-800">Detail Pemesanan</h4>
                </div>
                <div class="p-6">
                    <div class="space-y-4">
                        <div class="flex justify-between">
                            <span class="text-sm font-medium text-gray-600">Tanggal Keberangkatan:</span>
                            <span class="text-sm text-gray-800">{{ $tanggal }}</span>
                        </div>

                        <div class="flex justify-between">
                            <span class="text-sm font-medium text-gray-600">Jumlah Peserta:</span>
                            <span class="text-sm text-gray-800">{{ $pemesanan->jumlah }}
                                {{ $target }}</span>
                        </div>

                        <div class="flex justify-between">
                            <span class="text-sm font-medium text-gray-600">Total Harga:</span>
                            <span
                                class="text-sm font-semibold text-emerald-600">Rp{{ number_format($pemesanan->total_harga, 0, ',', '.') }}</span>
                        </div>

                        <div class="flex justify-between items-center gap-2">
                            <span class="text-sm font-medium text-gray-600">Status:</span>

                            <form action="{{ route('admin.booking.updateStatus', $pemesanan->id) }}" method="POST"
                                class="flex items-center gap-2">
                                @csrf
                                @method('PATCH')

                                <select name="status"
                                    class="text-xs rounded-md px-6 py-1 border-gray-300 focus:ring-emerald-500 focus:border-emerald-500">
                                    @foreach (['pending', 'paid', 'failed', 'canceled'] as $statusOption)
                                        <option value="{{ $statusOption }}" @selected($pemesanan->status === $statusOption)>
                                            {{ ucfirst($statusOption) }}
                                        </option>
                                    @endforeach
                                </select>

                                <button type="submit"
                                    class="bg-emerald-600 hover:bg-emerald-700 text-white text-xs px-3 py-1 rounded">
                                    Ubah
                                </button>
                            </form>

                        </div>

                        <div class="flex justify-between">
                            <span class="text-sm font-medium text-gray-600">Order ID:</span>
                            <span class="text-sm font-mono text-gray-800">{{ $pemesanan->order_id }}</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Informasi Pemesan -->
            <div class="bg-white rounded-xl shadow-md overflow-hidden">
                <div class="px-6 py-5 border-b border-gray-100">
                    <h4 class="text-lg font-semibold text-gray-800">Data Pemesan</h4>
                </div>
                <div class="p-6">
                    <div class="space-y-4">
                        <div class="flex justify-between">
                            <p class="text-sm font-medium text-gray-600 mb-1">Nama Lengkap</p>
                            <p class="text-sm text-gray-800">{{ $pemesanan->user->name }}</p>
                        </div>
                        <div class="flex justify-between">
                            <p class="text-sm font-medium text-gray-600 mb-1">Email</p>
                            <p class="text-sm text-gray-800">{{ $pemesanan->user->email }}</p>
                        </div>
                        <div class="flex justify-between">
                            <p class="text-sm font-medium text-gray-600 mb-1">Nomor Telepon</p>
                            <p class="text-sm text-gray-800">{{ $pemesanan->no_hp ?? '-' }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Fasilitas -->
        <div class="bg-white rounded-xl shadow-md overflow-hidden">
            <div class="px-6 py-5 border-b border-gray-100">
                <h4 class="text-lg font-semibold text-gray-800">Fasilitas & Kegiatan</h4>
            </div>
            <div class="p-6">
                @if ($pemesanan->paket->fasilitas->isNotEmpty())
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                        @foreach ($pemesanan->paket->fasilitas as $fasilitas)
                            <div class="flex items-start">
                                <svg class="h-5 w-5 text-emerald-500 mr-2 mt-0.5 flex-shrink-0" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M5 13l4 4L19 7" />
                                </svg>
                                <span class="text-sm text-gray-700">{{ $fasilitas->nama }}</span>
                            </div>
                        @endforeach
                    </div>
                @else
                    <p class="text-sm text-gray-500 italic">Tidak ada fasilitas terdaftar.</p>
                @endif
            </div>
        </div>

        <!-- Aksi Admin -->
        <div class="flex flex-col-reverse sm:flex-row justify-between items-center gap-4 pt-2">
            <a href="{{ route('admin.pemesanan.index') }}"
                class="inline-flex items-center text-sm text-gray-600 hover:text-gray-900 hover:underline">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
                Kembali ke daftar pemesanan
            </a>
            @if ($pemesanan->status === 'paid')
                <div class="flex gap-3">
                    <a href="{{ route('pemesanan.eticket', $pemesanan->id) }}"
                        class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-emerald-600 hover:bg-emerald-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-emerald-500">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                        </svg>
                        Download E-ticket
                    </a>
                </div>
            @endif
        </div>
    </div>
</x-admin-layout>
