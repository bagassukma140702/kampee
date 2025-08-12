<x-user-layout>

    <div class="max-w-4xl mx-auto py-10 px-4 sm:px-6 lg:px-8">
        <h1 class="text-3xl font-bold text-gray-900 mb-6">Detail Pemesanan</h1>

        <div class="bg-white rounded-xl shadow-md p-6 space-y-6">
            {{-- Info Paket Wisata --}}
            <div class="flex items-start space-x-6">
                <img src="{{ asset('storage/' . $pemesanan->paket->gambar) }}" alt="{{ $pemesanan->paket->nama }}"
                    class="w-32 h-32 object-cover rounded-lg">
                <div class="flex-1 gap-y-2">
                    <h2 class="text-xl font-semibold text-gray-900">{{ $pemesanan->paket->nama }}</h2>
                    <p class="text-sm text-gray-600">{{ $pemesanan->paket->lokasi }}</p>
                    <p class="text-sm text-gray-600">Durasi : {{ $pemesanan->paket->durasi }}</p>
                </div>
            </div>

            {{-- Rincian Pemesanan --}}
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 text-sm text-gray-700">
                <div>
                    <span class="font-medium">Tanggal Keberangkatan:</span>
                    @php
                        // Konversi tanggal ke bahasa Indonesia
                        setlocale(LC_TIME, 'id_ID.UTF-8');
                        $tanggal = strftime('%A, %d %B %Y', strtotime($pemesanan->tanggal));
                    @endphp
                    <div>{{ $tanggal }}</div>
                </div>
                <div>
                    <span class="font-medium">Jumlah Peserta:</span>
                    <div>{{ $pemesanan->jumlah }} orang</div>
                </div>
                <div>
                    <span class="font-medium">Total Harga:</span>
                    <div class="text-emerald-600 font-semibold">
                        Rp{{ number_format($pemesanan->total_harga, 0, ',', '.') }}</div>
                </div>
                <div>
                    <span class="font-medium">Status:</span>
                    <div class="capitalize">{{ $pemesanan->status }}</div>
                </div>
                <div>
                    <span class="font-medium">Order ID:</span>
                    <div>{{ $pemesanan->order_id }}</div>
                </div>
            </div>

            {{-- Data Pemesan --}}
            <div class="border-t pt-4">
                <h3 class="text-lg font-semibold mb-2">Data Pemesan</h3>
                <p class="text-sm text-gray-700">Nama: {{ $pemesanan->user->name }}</p>
                <p class="text-sm text-gray-700">Email: {{ $pemesanan->user->email }}</p>
            </div>

            {{-- Tombol Aksi --}}
            <div class="flex justify-between items-center gap-2 pt-6 border-t">
                <a href="{{ route('user.pemesanan.index') }}" class="text-sm text-gray-600 hover:underline">←
                    Kembali</a>

                {{-- Contoh Tombol Download e-ticket --}}
                @if ($pemesanan->status === 'paid')
                    <a href="{{ route('user.pemesanan.eticket', $pemesanan->id) }}"
                        class="bg-emerald-600 hover:bg-emerald-700 text-white px-4 py-2 rounded-md text-sm">
                        Download E-ticket
                    </a>
                @else
                    <a href="{{ $waLink }}" target="_blank"
                        class="bg-emerald-600 hover:bg-emerald-700 text-white px-4 py-2 rounded-md text-sm">
                        Chat Admin via WhatsApp
                    </a>
                @endif

            </div>
        </div>
    </div>

</x-user-layout>
