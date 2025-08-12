<x-admin-layout>
    <x-slot name="header">
        <div class="">
            <h1 class="text-3xl font-bold text-gray-900">Admin Dashboard</h1>
            <p class="text-gray-600 mt-2">Kelola tour dan pemesanan</p>
        </div>
    </x-slot>

    @php
        function formatPrice($price)
        {
            return 'Rp ' . number_format($price, 0, ',', '.');
        }
    @endphp

    <div x-data="{
        isAddTourOpen: false,
        isEditTourOpen: false,
        currentTour: null
    }" x-cloak class="space-y-6 mx-auto px-4 sm:px-6 lg:px-8 max-w-7xl">

        <!-- Header and Add Tour Button -->
        <div class="flex justify-between items-center">
            <h2 class="text-xl font-bold text-gray-900">Kelola Paket Tour</h2>
            <a href="{{ route('admin.paket-wisata.create') }}"
                class="bg-emerald-600 hover:bg-emerald-700 text-white px-4 py-2 rounded-md flex items-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd"
                        d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z"
                        clip-rule="evenodd" />
                </svg>
                Tambah Tour Baru
            </a>
        </div>

        <!-- Tours Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach ($tours as $tour)
                <div class="bg-white rounded-xl shadow-md hover:shadow-lg transition-shadow overflow-hidden">
                    <img src="{{ filter_var($tour->gambar, FILTER_VALIDATE_URL) ? $tour->gambar : asset('storage/' . $tour->gambar) }}"
                        alt="{{ $tour->nama }}" class="w-full h-48 object-cover">

                    <div class="p-4">
                        <div class="flex justify-between items-start">
                            <h3 class="font-semibold text-gray-900 text-xl mb-2 ">
                                {{ $tour->nama }}
                            </h3>
                            <span
                                class="px-2 py-1 text-xs rounded-full 
                                {{ $tour->status === 'active' ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-800' }}">
                                {{ ucfirst($tour->status) }}
                            </span>
                        </div>

                        @php
                            $target = $tour->target_peserta;
                            $target = in_array($target, ['umum', 'orang', '']) ? 'orang' : $target;
                        @endphp

                        <p class="text-gray-600 text-sm mb-2">{{ $tour->lokasi }}</p>
                        <p class="text-gray-600 text-sm mb-2">Durasi : {{ $tour->durasi }}</p>
                        <p class="text-lg font-bold text-emerald-600 mb-4">
                            {{ formatPrice($tour->harga_jual) }} <span
                                class="text-sm font-normal text-gray-600">/{{ $target }}</span>
                        </p>
                        <div class="flex space-x-2">
                            <!-- View Button -->
                            <a href="{{ route('admin.paket-wisata.show', $tour->id) }}"
                                class="flex-1 px-3 py-1 border border-gray-300 rounded-md text-sm flex items-center justify-center hover:bg-gray-100 text-gray-700 hover:text-gray-900">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 mr-2" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M2.458 12C3.732 7.943 7.523 5 12 5s8.268 2.943 9.542 7c-1.274 4.057-5.065 7-9.542 7s-8.268-2.943-9.542-7z" />
                                </svg>
                                Lihat
                            </a>

                            <!-- Edit Button -->
                            <a href="{{ route('admin.paket-wisata.edit', $tour->id) }}"
                                class="flex-1 px-3 py-1 border border-gray-300 rounded-md text-sm flex items-center justify-center hover:bg-gray-100 text-gray-700 hover:text-gray-900">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 mr-2" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5M18.5 2.5a2.121 2.121 0 113 3L12 15l-4 1 1-4 9.5-9.5z" />
                                </svg>
                                Edit
                            </a>

                            <!-- Delete Button -->
                            <x-confirm-delete-button :action="route('admin.paket-wisata.destroy', $tour->id)" method="DELETE" title="Hapus Paket Wisata"
                                message="Apakah kamu yakin ingin menghapus paket ini? Aksi ini tidak bisa dibatalkan."
                                button-text="Ya, Hapus" button-color="red">
                                <x-slot:trigger>
                                    <button type="button"
                                        class="px-3 py-1.5 border border-gray-300 rounded-md text-sm flex items-center justify-center text-red-600 hover:bg-red-100">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6M9 7V4a1 1 0 011-1h4a1 1 0 011 1v3m-7 0h8" />
                                        </svg>
                                    </button>
                                </x-slot:trigger>
                            </x-confirm-delete-button>


                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</x-admin-layout>
