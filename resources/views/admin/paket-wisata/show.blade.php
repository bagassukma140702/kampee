<x-admin-layout>
    @php
        $isUrl = Str::startsWith($paketWisata->gambar, ['http://', 'https://']);
    @endphp

    <div class="max-w-7xl mx-auto px-4 sm:px-6 py-8">
        <!-- Header Actions -->
        <div class="flex flex-col-reverse sm:flex-row justify-between items-center gap-4 mb-6">
            <a href="{{ route('admin.paket-wisata.index') }}"
                class="inline-flex items-center text-sm text-gray-600 hover:text-gray-900 hover:underline">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
                Kembali ke daftar paket wisata
            </a>
            <div class="flex items-center gap-3">
                <a href="{{ route('admin.paket-wisata.edit', $paketWisata->id) }}"
                    class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 mr-2" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5M18.5 2.5a2.121 2.121 0 013 3L12 15l-4 1 1-4 9.5-9.5z" />
                    </svg>
                    Edit
                </a>

                <x-confirm-delete-button :action="route('admin.paket-wisata.destroy', $paketWisata->id)" method="DELETE" title="Hapus Paket Wisata"
                    message="Apakah kamu yakin ingin menghapus paket ini? Aksi ini tidak bisa dibatalkan."
                    button-text="Ya, Hapus" button-color="red">
                    <x-slot:trigger>
                        <button type="button"
                            class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6M9 7V4a1 1 0 011-1h4a1 1 0 011 1v3m-7 0h8" />
                            </svg>
                            Hapus
                        </button>
                    </x-slot:trigger>
                </x-confirm-delete-button>
            </div>
        </div>

        <!-- Main Content -->
        <div class="bg-white rounded-xl shadow-md overflow-hidden mb-8">
            <div class="p-6">
                <div class="flex flex-col md:flex-row gap-8 items-start">
                    <!-- Image -->
                    <img src="{{ $isUrl ? $paketWisata->gambar : asset('storage/' . $paketWisata->gambar) }}"
                        alt="{{ $paketWisata->nama }}" class="w-auto h-80 object-cover rounded-md shadow-sm">

                    <!-- Details -->
                    <div class="flex-1 space-y-4">
                        <div>
                            <h1 class="text-2xl font-bold text-gray-900">{{ $paketWisata->nama }}</h1>
                            <div class="flex items-center mt-1 text-gray-600">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                                <span class="text-sm">{{ $paketWisata->lokasi }}</span>
                            </div>
                            <div class="flex items-center mt-1 text-gray-600">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                    xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1">
                                    <path d="M12 8V12L14.5 13.5" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round" />
                                    <circle cx="12" cy="12" r="9" stroke="currentColor"
                                        stroke-width="2" />
                                </svg>
                                <span class="text-sm">Durasi: {{ $paketWisata->durasi }}</span>
                            </div>
                        </div>

                        @php
                            $target = $paketWisata->target_peserta;
                            $target = in_array($target, ['umum', 'orang', '']) ? 'orang' : $target;
                        @endphp

                        <p class="text-lg font-semibold text-emerald-600 mt-2">
                            Rp{{ number_format($paketWisata->harga_jual, 0, ',', '.') }}
                            <span class="text-sm font-normal text-gray-500">/{{ $target }}</span>
                        </p>

                        {{-- Info tambahan berdasarkan jumlah_orang --}}
                        @if (in_array($paketWisata->tipe_harga, ['per_paket', 'per_pasangan']) && $paketWisata->jumlah_orang)
                            <p class="text-sm text-gray-600">
                                Termasuk untuk <span>{{ $paketWisata->jumlah_orang }}</span> orang.
                            </p>
                        @endif

                        <div class="pt-2 border-t border-gray-100 mt-4">
                            <h4 class="text-sm font-medium text-gray-500 mb-2">Deskripsi Paket:</h4>
                            <p class="text-sm text-gray-600 leading-relaxed">
                                {!! nl2br(e($paketWisata->deskripsi)) !!}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Komponen Biaya -->
        <div class="bg-white rounded-xl shadow-md overflow-hidden mb-8">
            <div class="px-6 py-5 border-b border-gray-100">
                <h4 class="text-lg font-semibold text-gray-800">Rincian Biaya Paket</h4>
            </div>
            <div class="p-6">
                @if ($paketWisata->biaya->isNotEmpty())
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200 text-sm">
                            <thead class="">
                                <tr>
                                    <th class="text-left px-4 py-2 font-medium text-gray-700">Komponen</th>
                                    <th class="text-right px-4 py-2 font-medium text-gray-700">Jumlah (Rp)</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-100">
                                @foreach ($paketWisata->biaya as $item)
                                    <tr>
                                        <td class="px-4 py-2 text-gray-800">{{ $item->nama }}</td>
                                        <td class="px-4 py-2 text-right text-gray-600">
                                            Rp{{ number_format($item->jumlah, 0, ',', '.') }}</td>
                                    </tr>
                                @endforeach
                                <tr class="font-semibold">
                                    <td class="px-4 py-2 text-gray-800">Total Biaya Modal</td>
                                    <td class="px-4 py-2 text-right text-emerald-600">
                                        Rp{{ number_format($paketWisata->harga_modal, 0, ',', '.') }}
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <p class="text-sm text-gray-500 mt-3">Margin: <strong>{{ $paketWisata->margin }}%</strong></p>
                @else
                    <p class="text-sm text-gray-500 italic">Belum ada rincian biaya ditambahkan.</p>
                @endif
            </div>
        </div>

        <!-- Fasilitas Section -->
        <div class="bg-white rounded-xl shadow-md overflow-hidden mb-8">
            <div class="px-6 py-5 border-b border-gray-100">
                <h4 class="text-lg font-semibold text-gray-800">Fasilitas & Kegiatan</h4>
            </div>

            <div class="p-6">
                @if ($paketWisata->fasilitas->isNotEmpty())
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
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
                    <p class="text-sm text-gray-500 italic">Tidak ada fasilitas terdaftar.</p>
                @endif
            </div>
        </div>

        <!-- Stats Cards -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
            <div class="bg-white rounded-xl shadow-md p-6">
                <p class="text-sm font-medium text-gray-500 mb-1">Total Pemesanan</p>
                <p class="text-2xl font-semibold text-gray-900">{{ $paketWisata->bookings->count() }}</p>
            </div>
            <div class="bg-white rounded-xl shadow-md p-6">
                <p class="text-sm font-medium text-gray-500 mb-1">Pemesanan (Paid)</p>
                <p class="text-2xl font-semibold text-gray-900">{{ $paketWisata->bookings_paid_count }}</p>
            </div>
            <div class="bg-white rounded-xl shadow-md p-6">
                <p class="text-sm font-medium text-gray-500 mb-1">Total Pendapatan</p>
                <p class="text-2xl font-semibold text-emerald-600">
                    Rp{{ number_format($paketWisata->bookings_paid_sum_total_harga, 0, ',', '.') }}
                </p>
            </div>
        </div>

        <!-- Booking History -->
        <div class="bg-white rounded-xl shadow-md overflow-hidden">
            <div class="px-6 py-5 border-b border-gray-100">
                <h4 class="text-lg font-semibold text-gray-800">Riwayat Pemesanan Terbaru</h4>
            </div>
            <div class="divide-y">
                @forelse($paketWisata->bookings as $booking)
                    <a href="{{ route('admin.pemesanan.show', $booking->id) }}" class="p-6 block hover:bg-gray-50">
                        <div class="flex flex-col sm:flex-row justify-between gap-4">
                            <div>
                                <p class="font-medium text-gray-900">{{ $booking->user->name ?? 'Unknown user' }}</p>
                                <div class="mt-1 flex items-center">
                                    <span class="text-sm text-gray-500 mr-2">Status:</span>
                                    <span
                                        class="capitalize px-2 py-1 text-xs rounded-full font-medium 
                                    {{ match ($booking->status) {
                                        'paid' => 'bg-green-100 text-green-800',
                                        'pending' => 'bg-yellow-100 text-yellow-800',
                                        'failed' => 'bg-red-100 text-red-800',
                                        'canceled' => 'bg-red-100 text-red-800',
                                        default => 'bg-gray-100 text-gray-800',
                                    } }}">
                                        {{ ucfirst($booking->status) }}
                                    </span>
                                </div>
                            </div>
                            <div class="text-right">
                                <p class="text-sm text-gray-500">Total:</p>
                                <p class="font-semibold text-emerald-600">
                                    Rp{{ number_format($booking->total_harga, 0, ',', '.') }}
                                </p>
                            </div>
                        </div>
                    </a>
                @empty
                    <div class="p-6">
                        <p class="text-sm text-gray-500 italic">Belum ada pemesanan</p>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
</x-admin-layout>
