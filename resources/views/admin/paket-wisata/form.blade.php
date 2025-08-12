<x-admin-layout>
    <x-slot name="header">
        <h2 class="text-3xl font-semibold text-gray-900">
            {{ isset($paketWisata) && $paketWisata->exists ? 'Edit Paket Wisata' : 'Tambah Paket Wisata Baru' }}
        </h2>
        <p class="text-gray-600 mt-1">
            {{ isset($paketWisata) && $paketWisata->exists
                ? 'Perbarui informasi paket wisata yang sudah ada.'
                : 'Masukkan data lengkap untuk menambahkan paket wisata baru.' }}
        </p>
    </x-slot>

    <div class="max-w-7xl mx-auto px-4 sm:px-6">
        <div class="bg-white rounded-xl shadow-md overflow-hidden">
            <div class="">
                <form
                    action="{{ isset($paketWisata) ? route('admin.paket-wisata.update', $paketWisata->id) : route('admin.paket-wisata.store') }}"
                    method="POST" enctype="multipart/form-data" class="space-y-6">
                    @csrf
                    @if (isset($paketWisata))
                        @method('PUT')
                    @endif

                    <!-- Informasi Dasar -->
                    <div class=" rounded-lg p-6">
                        <h3 class="text-lg font-semibold text-gray-800 mb-4 pb-2 border-b border-gray-200">Informasi
                            Dasar</h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label for="nama" class="block text-sm font-medium text-gray-700 mb-2">Judul
                                    Tour</label>
                                <input type="text" name="nama" id="nama" required
                                    value="{{ old('nama', $paketWisata->nama ?? '') }}"
                                    class="w-full rounded-md border-gray-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500 text-sm">
                            </div>
                            <div>
                                <label for="lokasi"
                                    class="block text-sm font-medium text-gray-700 mb-2">Lokasi</label>
                                <input type="text" name="lokasi" id="lokasi" required
                                    value="{{ old('lokasi', $paketWisata->lokasi ?? '') }}"
                                    class="w-full rounded-md border-gray-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500 text-sm">
                            </div>
                            <div>
                                <label for="durasi"
                                    class="block text-sm font-medium text-gray-700 mb-2">Durasi</label>
                                <input type="text" name="durasi" id="durasi" required
                                    value="{{ old('durasi', $paketWisata->durasi ?? '') }}"
                                    class="w-full rounded-md border-gray-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500 text-sm"
                                    placeholder="Contoh: 2D1N / 6 jam">
                            </div>
                            <div>
                                <label for="tipe_harga" class="block text-sm font-medium text-gray-700 mb-2">Tipe
                                    Harga</label>
                                <select name="tipe_harga" id="tipe_harga" required
                                    class="w-full rounded-md border-gray-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500 text-sm">
                                    <option value="" disabled
                                        {{ old('tipe_harga', $paketWisata->tipe_harga ?? '') == '' ? 'selected' : '' }}>
                                        Pilih tipe harga</option>
                                    <option value="per_orang"
                                        {{ old('tipe_harga', $paketWisata->tipe_harga ?? '') == 'per_orang' ? 'selected' : '' }}>
                                        Per Orang</option>
                                    <option value="per_pasangan"
                                        {{ old('tipe_harga', $paketWisata->tipe_harga ?? '') == 'per_pasangan' ? 'selected' : '' }}>
                                        Per Pasangan</option>
                                    <option value="per_paket"
                                        {{ old('tipe_harga', $paketWisata->tipe_harga ?? '') == 'per_paket' ? 'selected' : '' }}>
                                        Per Paket</option>
                                </select>
                            </div>
                            <div>
                                <label for="jumlah_orang" class="block text-sm font-medium text-gray-700 mb-2">Jumlah
                                    Orang</label>
                                <input type="number" name="jumlah_orang" id="jumlah_orang"
                                    value="{{ old('jumlah_orang', $paketWisata->jumlah_orang ?? '') }}"
                                    class="w-full rounded-md border-gray-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500 text-sm"
                                    placeholder="Boleh dikosongkan jika fleksibel">
                            </div>
                            <div>
                                <label for="minimal_peserta"
                                    class="block text-sm font-medium text-gray-700 mb-2">Minimal Peserta</label>
                                <input type="number" name="minimal_peserta" id="minimal_peserta"
                                    value="{{ old('minimal_peserta', $paketWisata->minimal_peserta ?? '') }}"
                                    class="w-full rounded-md border-gray-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500 text-sm"
                                    placeholder="Contoh: 10">
                            </div>
                            <div>
                                <label for="target_peserta" class="block text-sm font-medium text-gray-700 mb-2">Target
                                    Peserta</label>
                                <input type="text" name="target_peserta" id="target_peserta"
                                    value="{{ old('target_peserta', $paketWisata->target_peserta ?? '') }}"
                                    class="w-full rounded-md border-gray-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500 text-sm"
                                    placeholder="Contoh: siswa, pasangan, umum">
                            </div>
                            <div>
                                <label for="margin" class="block text-sm font-medium text-gray-700 mb-2">Margin
                                    (%)</label>
                                <input type="number" name="margin" id="margin" min="0" max="100"
                                    required value="{{ old('margin', $paketWisata->margin ?? '') }}"
                                    class="w-full rounded-md border-gray-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500 text-sm"
                                    placeholder="Contoh: 35">
                            </div>
                        </div>
                    </div>

                    <!-- Deskripsi & Gambar -->
                    <div class=" rounded-lg p-6">
                        <h3 class="text-lg font-semibold text-gray-800 mb-4 pb-2 border-b border-gray-200">Deskripsi &
                            Gambar</h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label for="deskripsi"
                                    class="block text-sm font-medium text-gray-700 mb-2">Deskripsi</label>
                                <textarea name="deskripsi" id="deskripsi" rows="5" required
                                    class="w-full rounded-md border-gray-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500 text-sm">{{ old('deskripsi', $paketWisata->deskripsi ?? '') }}</textarea>
                            </div>
                            <div x-data="{
                                fileName: '{{ basename($paketWisata->gambar ?? '') }}',
                                updateName(e) {
                                    this.fileName = e.target.files[0]?.name || this.fileName;
                                }
                            }">
                                <label for="gambar" class="block text-sm font-medium text-gray-700 mb-2">Gambar
                                    Utama</label>

                                <div
                                    class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-md">
                                    <div class="space-y-1 text-center">
                                        <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor"
                                            fill="none" viewBox="0 0 48 48" aria-hidden="true">
                                            <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4
                        m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172
                        a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round"
                                                stroke-linejoin="round" />
                                        </svg>

                                        <div class="flex justify-center text-sm text-gray-600">
                                            <label for="gambar"
                                                class="relative cursor-pointer bg-white rounded-md font-medium text-emerald-600 hover:text-emerald-500 focus-within:outline-none">
                                                <span>Upload file</span>
                                                <input id="gambar" name="gambar" type="file" class="sr-only"
                                                    accept="image/*" @change="updateName"
                                                    {{ request()->routeIs('admin.paket-wisata.create') ? 'required' : '' }}>
                                            </label>
                                        </div>

                                        <template x-if="fileName">
                                            <p class="text-sm text-gray-700 mt-2 font-medium" x-text="fileName"></p>
                                        </template>
                                        <p class="text-xs text-gray-500">PNG, JPG, GIF hingga 5MB</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Komponen Fasilitas -->
                    <div class="rounded-lg p-6">
                        <h3 class="text-lg font-semibold text-gray-800 mb-4 pb-2 border-b border-gray-200">
                            Fasilitas & Kegiatan
                        </h3>

                        @php
                            // Ambil data fasilitas lama dari old() atau fallback ke relasi fasilitas dari model
                            $fasilitasData =
                                old('fasilitas') ??
                                (isset($paketWisata)
                                    ? $paketWisata->fasilitas
                                        ->map(function ($item) {
                                            return ['nama' => $item->nama];
                                        })
                                        ->toArray()
                                    : []);

                            // Fallback minimal 1 item kosong jika kosong
                            if (empty($fasilitasData)) {
                                $fasilitasData[] = ['nama' => ''];
                            }
                        @endphp

                        <div x-data="{ fasilitasList: @js($fasilitasData) }">
                            <template x-for="(item, index) in fasilitasList" :key="index">
                                <div class="flex items-center gap-4 mb-4">
                                    <input type="text" :name="`fasilitas[${index}][nama]`" x-model="item.nama"
                                        placeholder="Nama fasilitas"
                                        class="w-full rounded-md border-gray-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500 text-sm"
                                        required>
                                    <button type="button" @click="fasilitasList.splice(index, 1)"
                                        class="text-red-600 hover:text-red-800 text-sm"
                                        x-show="fasilitasList.length > 1">
                                        Hapus
                                    </button>
                                </div>
                            </template>

                            <button type="button" @click="fasilitasList.push({ nama: '' })"
                                class="mt-2 inline-flex items-center px-3 py-1.5 border border-transparent text-xs font-medium rounded text-emerald-700 bg-emerald-100 hover:bg-emerald-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-emerald-500">
                                <svg xmlns="http://www.w3.org/2000/svg" class="-ml-0.5 mr-1.5 h-4 w-4" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 4v16m8-8H4" />
                                </svg>
                                Tambah Fasilitas
                            </button>
                        </div>
                    </div>

                    <!-- Komponen Biaya -->
                    <div class="rounded-lg p-6">
                        <h3 class="text-lg font-semibold text-gray-800 mb-4 pb-2 border-b border-gray-200">
                            Komponen Biaya
                        </h3>

                        @php
                            // Ambil data biaya lama dari old() atau fallback ke relasi biaya dari model
                            $biayaData =
                                old('biaya') ??
                                (isset($paketWisata)
                                    ? $paketWisata->biaya
                                        ->map(function ($item) {
                                            return ['nama' => $item->nama, 'jumlah' => $item->jumlah];
                                        })
                                        ->toArray()
                                    : []);

                            // Fallback minimal 1 item kosong jika kosong
                            if (empty($biayaData)) {
                                $biayaData[] = ['nama' => '', 'jumlah' => 0];
                            }
                        @endphp

                        <div x-data="{ biayaList: @js($biayaData) }">
                            <template x-for="(biaya, index) in biayaList" :key="index">
                                <div class="grid grid-cols-12 gap-4 mb-4">
                                    <div class="col-span-6 md:col-span-5">
                                        <input type="text" :name="`biaya[${index}][nama]`" x-model="biaya.nama"
                                            placeholder="Nama komponen" required
                                            class="w-full rounded-md border-gray-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500 text-sm">
                                    </div>
                                    <div class="col-span-4 md:col-span-5">
                                        <div class="relative rounded-md shadow-sm">
                                            <div
                                                class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                                <span class="text-gray-500 sm:text-sm">Rp</span>
                                            </div>
                                            <input type="number" :name="`biaya[${index}][jumlah]`"
                                                x-model="biaya.jumlah" placeholder="Jumlah" min="0" required
                                                class="block w-full pl-10 rounded-md border-gray-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500 text-sm">
                                        </div>
                                    </div>
                                    <div class="col-span-2 flex items-center">
                                        <button type="button" @click="biayaList.splice(index, 1)"
                                            class="text-red-600 hover:text-red-800 text-sm"
                                            x-show="biayaList.length > 1">
                                            Hapus
                                        </button>
                                    </div>
                                </div>
                            </template>

                            <button type="button" @click="biayaList.push({ nama: '', jumlah: 0 })"
                                class="mt-2 inline-flex items-center px-3 py-1.5 border border-transparent text-xs font-medium rounded text-emerald-700 bg-emerald-100 hover:bg-emerald-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-emerald-500">
                                <svg xmlns="http://www.w3.org/2000/svg" class="-ml-0.5 mr-1.5 h-4 w-4" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 4v16m8-8H4" />
                                </svg>
                                Tambah komponen biaya
                            </button>
                        </div>
                    </div>

                    <!-- Error Form Validation -->
                    @if ($errors->any())
                        <div class="rounded-md bg-red-50 p-4">
                            <div class="flex">
                                <div class="flex-shrink-0">
                                    <svg class="h-5 w-5 text-red-400" xmlns="http://www.w3.org/2000/svg"
                                        viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd"
                                            d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z"
                                            clip-rule="evenodd" />
                                    </svg>
                                </div>
                                <div class="ml-3">
                                    <h3 class="text-sm font-medium text-red-800">Terdapat {{ $errors->count() }}
                                        kesalahan dalam pengisian form</h3>
                                    <div class="mt-2 text-sm text-red-700">
                                        <ul class="list-disc pl-5 space-y-1">
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif

                    <!-- Form Actions -->
                    <div class="flex justify-end space-x-4 p-6 border-t border-gray-200">
                        <a href="{{ route('admin.paket-wisata.index') }}"
                            class="inline-flex items-center px-4 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover: focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-emerald-500">
                            Batal
                        </a>
                        <button type="submit"
                            class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-emerald-600 hover:bg-emerald-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-emerald-500">
                            Simpan Paket Wisata
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-admin-layout>
