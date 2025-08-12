<x-user-layout>

    <div class="min-h-screen bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
            <!-- Header -->
            <div class="mb-8">
                <h1 class="text-3xl font-bold text-gray-900">Dashboard Saya</h1>
                <p class="text-gray-600 mt-2">Kelola semua pemesanan wisata Anda</p>
            </div>

            <!-- Stats Cards -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                <div class="bg-white p-6 rounded-xl shadow-md">
                    <p class="text-sm text-gray-600">Total Pemesanan</p>
                    <p class="text-2xl font-bold text-gray-900">{{ $stats['total'] }}</p>
                </div>
                <div class="bg-white p-6 rounded-xl shadow-md">
                    <p class="text-sm text-gray-600">Dikonfirmasi</p>
                    <p class="text-2xl font-bold text-green-600">{{ $stats['confirmed'] }}</p>
                </div>
                <div class="bg-white p-6 rounded-xl shadow-md">
                    <p class="text-sm text-gray-600">Menunggu</p>
                    <p class="text-2xl font-bold text-yellow-600">{{ $stats['pending'] }}</p>
                </div>
                <div class="bg-white p-6 rounded-xl shadow-md">
                    <p class="text-sm text-gray-600">Total Belanja</p>
                    <p class="text-2xl font-bold text-emerald-600">Rp{{ number_format($stats['spent'], 0, ',', '.') }}
                    </p>
                </div>
            </div>

            <div class="flex items-center justify-between">
                <!-- Riwayat Pemesanan -->
                <h2 class="text-xl font-bold text-gray-900 mb-4">Riwayat Pemesanan</h2>

                <form method="GET" class="mb-6 w-[220px] sm:w-[300px]">
                    <label for="status" class="text-sm font-medium text-gray-700">Filter Status:</label>
                    <select name="status" id="status" onchange="this.form.submit()"
                        class="w-[200px] ml-2 py-2 px-3 border border-gray-300 rounded-md focus:ring-0 focus:border-emerald-500">
                        <option value="">Semua</option>
                        <option value="paid" {{ request('status') === 'paid' ? 'selected' : '' }}>Dikonfirmasi
                        </option>
                        <option value="pending" {{ request('status') === 'pending' ? 'selected' : '' }}>Menunggu
                        </option>
                        <option value="failed" {{ request('status') === 'failed' ? 'selected' : '' }}>Gagal</option>
                        <option value="canceled" {{ request('status') === 'canceled' ? 'selected' : '' }}>Dibatalkan
                        </option>
                    </select>
                </form>

            </div>

            @if ($pemesanan->isEmpty())
                <div class="bg-white p-12 text-center shadow-md rounded-xl">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 mx-auto mb-4 text-gray-400"
                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round">
                        <rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect>
                        <line x1="16" y1="2" x2="16" y2="6">
                        </line>
                        <line x1="8" y1="2" x2="8" y2="6">
                        </line>
                        <line x1="3" y1="10" x2="21" y2="10">
                        </line>
                    </svg>
                    <h3 class="text-lg font-medium text-gray-900 mb-2">Belum ada pemesanan</h3>
                    <p class="text-gray-500 mb-6">Mulai jelajahi paket wisata menarik kami</p>
                    <a href="{{ route('user.paket-wisata.index') }}"
                        class="bg-emerald-600 hover:bg-emerald-700 text-white px-4 py-2 rounded-md font-medium">
                        Jelajahi Paket Wisata
                    </a>
                </div>
            @else
                <div class="space-y-6">
                    @foreach ($pemesanan as $item)
                        <div class="bg-white p-6 rounded-xl shadow-md">
                            <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-6">
                                <div class="flex items-start gap-4">
                                    <img src="{{ filter_var($item->paket->gambar, FILTER_VALIDATE_URL) ? $item->paket->gambar : asset('storage/' . $item->paket->gambar) }}"
                                        alt="{{ $item->paket->nama }}" alt="{{ $item->paket->nama }}"
                                        class="w-20 h-20 object-cover rounded-lg">
                                    <div class="flex-1">
                                        <h3 class="text-lg font-semibold text-gray-900">{{ $item->paket->nama }}</h3>
                                        <div class="text-sm text-gray-600 space-y-1 mt-1">
                                            <div class="flex items-center gap-2">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none"
                                                    viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7z" />
                                                    <circle cx="12" cy="9" r="2.5" stroke="currentColor"
                                                        stroke-width="2" fill="none" />
                                                </svg>
                                                <p>{{ $item->paket->lokasi }}</p>
                                            </div>
                                            <div class="flex item-center gap-2">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4"
                                                    viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                    <rect x="3" y="4" width="18" height="18" rx="2"
                                                        ry="2"></rect>
                                                    <line x1="16" y1="2" x2="16"
                                                        y2="6">
                                                    </line>
                                                    <line x1="8" y1="2" x2="8"
                                                        y2="6">
                                                    </line>
                                                    <line x1="3" y1="10" x2="21"
                                                        y2="10">
                                                    </line>
                                                </svg>
                                                @php
                                                    // Konversi tanggal ke bahasa Indonesia
                                                    setlocale(LC_TIME, 'id_ID.UTF-8');
                                                    $tanggal = strftime('%A, %d %B %Y', strtotime($item->tanggal));
                                                @endphp
                                                <p>{{ $tanggal }}
                                                </p>
                                            </div>
                                            <div class="flex items-center gap-2">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 "
                                                    viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                    <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                                                    <circle cx="9" cy="7" r="4"></circle>
                                                    <path d="M23 21v-2a4 4 0 0 0-3-3.87"></path>
                                                    <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                                                </svg>
                                                <p>{{ $item->jumlah }} peserta</p>
                                            </div>
                                            <div class="flex items-center gap-2">
                                                <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M12 8V12L14.5 13.5" stroke="currentColor"
                                                        stroke-width="2" stroke-linecap="round"
                                                        stroke-linejoin="round" />
                                                    <circle cx="12" cy="12" r="9" stroke="currentColor"
                                                        stroke-width="2" />
                                                </svg>
                                                <p>Dipesan pada
                                                    {{ \Carbon\Carbon::parse($item->created_at)->translatedFormat('d F Y') }}
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="text-right space-y-2">
                                    <div class="text-2xl font-bold text-gray-900">
                                        Rp{{ number_format($item->total_harga, 0, ',', '.') }}</div>
                                    <div class="text-sm text-gray-500">ID: {{ $item->order_id }}</div>
                                    <span
                                        class="inline-block px-3 py-1 text-xs rounded-full font-medium 
                                    {{ $item->status === 'paid'
                                        ? 'bg-green-100 text-green-700'
                                        : ($item->status === 'pending'
                                            ? 'bg-yellow-100 text-yellow-700'
                                            : 'bg-red-100 text-red-700') }}">
                                        {{ ucfirst($item->status) }}
                                    </span>
                                    <div class="flex items-center gap-2 md:block space-x-2 mt-2">

                                        <a href="{{ route('user.pemesanan.show', $item->id) }}"
                                            class="inline-flex items-center px-3 py-1 border text-sm rounded-md text-gray-700 hover:bg-gray-100">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 mr-2"
                                                fill="none" viewBox="0 0 24 24" stroke="currentColor"
                                                stroke-width="2">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M2.458 12C3.732 7.943 7.523 5 12 5s8.268 2.943 9.542 7c-1.274 4.057-5.065 7-9.542 7s-8.268-2.943-9.542-7z" />
                                            </svg>
                                            Detail
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </div>


</x-user-layout>
