<x-user-layout>

    <div class="min-h-screen bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">

            {{-- Header --}}
            <div class="mb-8">
                <a href="{{ route('user.paket-wisata.show', $tour->id) }}"
                    class="inline-flex items-center text-gray-500 hover:text-gray-900 mb-4">
                    <svg class="h-4 w-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                    </svg>
                    Kembali ke Detail Tour
                </a>
                <h1 class="text-3xl font-bold text-gray-900">Formulir Pemesanan</h1>
                <p class="text-gray-600 mt-2">Lengkapi data berikut untuk melanjutkan pemesanan</p>
            </div>

            <form action="{{ route('user.pemesanan.store') }}" method="POST">
                @csrf

                <input type="hidden" name="tour_id" value="{{ $tour->id }}">
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                    {{-- Form Pemesanan --}}
                    <div class="space-y-6">

                        {{-- Detail Pemesanan --}}
                        <div class="bg-white border rounded-xl p-6 shadow-sm">
                            <h2 class="text-lg font-semibold flex items-center mb-4">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-emerald-600"
                                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round">
                                    <rect x="3" y="4" width="18" height="18" rx="2" ry="2">
                                    </rect>
                                    <line x1="16" y1="2" x2="16" y2="6"></line>
                                    <line x1="8" y1="2" x2="8" y2="6"></line>
                                    <line x1="3" y1="10" x2="21" y2="10"></line>
                                </svg>
                                Detail Pemesanan
                            </h2>

                            {{-- Tanggal Keberangkatan --}}
                            <div class="mb-4">
                                <label for="date" class="block text-sm font-medium text-gray-700">Tanggal
                                    Keberangkatan *</label>
                                <input type="date" name="date" id="date"
                                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-emerald-500 focus:border-emerald-500">
                            </div>

                            {{-- Jumlah Peserta --}}
                            <div class="mb-4">
                                <label for="participants" class="block text-sm font-medium text-gray-700">Jumlah Peserta
                                    *</label>
                                <select name="participants" id="participants"
                                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-emerald-500 focus:border-emerald-500">
                                    <option value="">Pilih jumlah</option>
                                    @for ($i = 1; $i <= 10; $i++)
                                        <option value="{{ $i }}"
                                            {{ old('participants') == $i ? 'selected' : '' }}>
                                            {{ $i }} orang
                                        </option>
                                    @endfor
                                </select>
                            </div>

                            {{-- Nomor HP --}}
                            <div class="mb-4">
                                <label for="customer_phone" class="block text-sm font-medium text-gray-700">Nomor HP
                                    *</label>
                                <input type="tel" name="customer_phone" id="customer_phone"
                                    value="{{ old('customer_phone', Auth::user()->phone ?? '') }}"
                                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-emerald-500 focus:border-emerald-500"
                                    placeholder="08xxxxxxxxxx" required>
                            </div>

                        </div>

                        {{-- Data Pemesan --}}
                        <div class="bg-white border rounded-xl p-6 shadow-sm">
                            <h2 class="text-lg font-semibold flex items-center mb-4">
                                <svg class="mr-2 h-5 w-5 text-emerald-600" xmlns="http://www.w3.org/2000/svg"
                                    width="24" height="24" viewBox="0 0 24 24" fill="none"
                                    stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round">
                                    <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2" />
                                    <circle cx="12" cy="7" r="4" />
                                </svg>
                                Data Pemesan
                            </h2>

                            {{-- Nama --}}
                            <div class="mb-4">
                                <label for="customer_name" class="block text-sm font-medium text-gray-700">Nama Lengkap
                                    *</label>
                                <input type="text" name="customer_name" id="customer_name"
                                    value="{{ old('customer_name', Auth::user()->name) }}"
                                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm text-gray-800 bg-gray-100"
                                    readonly>
                            </div>

                            {{-- Email --}}
                            <div class="mb-4">
                                <label for="customer_email" class="block text-sm font-medium text-gray-700">Email
                                    *</label>
                                <input type="email" name="customer_email" id="customer_email"
                                    value="{{ old('customer_email', Auth::user()->email) }}"
                                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm text-gray-800 bg-gray-100"
                                    readonly>
                            </div>
                        </div>
                    </div>

                    {{-- Ringkasan Pemesanan --}}
                    <div class="space-y-6">
                        <div class="bg-white border rounded-xl p-6 shadow-sm">
                            <h2 class="text-lg font-semibold mb-4">Ringkasan Pesanan</h2>

                            {{-- Info Tour --}}
                            <div class="flex items-start space-x-4">
                                <img src="{{ asset('storage/' . $tour->gambar) }}" alt="{{ $tour->nama }}"
                                    class="w-20 h-20 object-cover rounded-lg">
                                <div class="flex-1">
                                    <h3 class="font-semibold text-gray-900">{{ $tour->nama }}</h3>
                                    <p class="text-sm text-gray-600">{{ $tour->lokasi }}</p>
                                </div>
                            </div>

                            {{-- Detail --}}
                            <div class="border-t mt-4 pt-4 space-y-2 text-sm text-gray-600">
                                <div class="flex justify-between">
                                    <span>Tanggal</span>
                                    <span id="selectedDateText">
                                        {{ old('date') ? \Carbon\Carbon::parse(old('date'))->translatedFormat('d F Y') : '-' }}
                                    </span>
                                </div>
                                @php
                                    $target = $tour->target_peserta;
                                    $target = in_array($target, ['umum', 'orang', '']) ? 'orang' : $target;
                                @endphp
                                <div class="flex
                                        justify-between">
                                    <span>Jumlah Peserta</span>
                                    <span id="selectedParticipantsText">{{ old('participants', '-') }}</span>
                                </div>
                                <div class="flex justify-between">
                                    <span>Harga per {{ $target }}</span>
                                    <span>Rp{{ number_format($tour->harga_jual, 0, ',', '.') }}</span>
                                </div>
                            </div>

                            {{-- Total --}}
                            @php
                                $total = old('participants') ? old('participants') * $tour->harga : 0;
                            @endphp
                            <div class="border-t mt-4 pt-4 flex justify-between font-bold text-lg">
                                <span>Total</span>
                                <span id="totalHargaText"
                                    class="text-emerald-600">Rp{{ number_format($total, 0, ',', '.') }}</span>
                            </div>
                        </div>

                        {{-- Info Pembayaran --}}
                        <div class="bg-white border rounded-xl p-6 shadow-sm">
                            <h2 class="text-lg font-semibold mb-4 flex items-center">
                                <svg class="h-5 w-5 mr-2 text-emerald-600" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 14l-2-2m0 0l2-2m-2 2h12" />
                                </svg>
                                Pembayaran
                            </h2>

                            <p class="text-sm text-gray-600 mb-3">
                                Setelah melakukan pemesanan, silakan <strong>hubungi admin melalui WhatsApp</strong>
                                pada halaman detail pemesanan untuk konfirmasi dan instruksi pembayaran lebih lanjut.
                            </p>

                            <div class="mt-4 text-xs text-gray-500">
                                Pembayaran diterima melalui Bank Transfer, E-Wallet, dan Kartu Kredit.
                            </div>
                        </div>

                        {{-- Tombol Submit --}}
                        <button id="submitBtn" type="submit"
                            class="w-full bg-emerald-600 hover:bg-emerald-700 text-white text-lg font-semibold py-4 rounded-md disabled:opacity-50"
                            disabled>
                            Konfirmasi Pemesanan
                        </button>

                        <p class="text-center text-sm text-gray-500">
                            Dengan melanjutkan, Anda menyetujui <a href="#" class="underline">syarat dan
                                ketentuan</a> kami.
                        </p>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            console.log("Debug: Script loaded");

            // === Elemen yang Dibutuhkan ===
            const dateInput = document.getElementById('date'); // Input tanggal
            const participantsInput = document.getElementById('participants');
            const phoneInput = document.getElementById('customer_phone');
            const selectedDateText = document.getElementById('selectedDateText');
            const totalSpan = document.getElementById('totalHargaText');
            const totalOrang = document.getElementById('selectedParticipantsText');
            const hargaPerOrang = {{ $tour->harga_jual ?? 0 }};

            // === Fungsi Update Total ===
            function updateTotal() {
                const jumlah = parseInt(participantsInput.value) || 0;
                const total = jumlah * hargaPerOrang;
                totalSpan.textContent = `Rp${total.toLocaleString('id-ID')}`;
                totalOrang.textContent = jumlah ? `${jumlah} {{ $target }}` : '-';
            }

            // === Fungsi Format Tanggal ===
            function formatSelectedDate(dateString) {
                if (!dateString) return '-';

                const date = new Date(dateString);
                return new Intl.DateTimeFormat('id-ID', {
                    weekday: 'long',
                    day: 'numeric',
                    month: 'long',
                    year: 'numeric'
                }).format(date);
            }

            // === Event Listeners ===
            // 1. Tanggal berubah
            dateInput.addEventListener('change', function() {
                selectedDateText.textContent = formatSelectedDate(this.value);
                checkFormValidity();
            });

            // 2. Jumlah peserta berubah
            participantsInput.addEventListener('change', updateTotal);

            // 3. Nomor telepon berubah
            phoneInput.addEventListener('input', checkFormValidity);

            // 4. Validasi form
            function checkFormValidity() {
                const isFormValid = dateInput.value && participantsInput.value && phoneInput.value.trim();
                document.getElementById('submitBtn').disabled = !isFormValid;
            }

            // Inisialisasi awal
            updateTotal();
            checkFormValidity();
        });
    </script>
</x-user-layout>
