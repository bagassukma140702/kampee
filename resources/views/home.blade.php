<x-user-layout>
    @php
        function formatPrice($price)
        {
            return 'Rp ' . number_format($price, 0, ',', '.');
        }
    @endphp

    <div class="min-h-screen">
        <!-- Hero Section -->
        <section class="relative bg-gradient-to-r from-emerald-600 to-teal-600 text-white">
            <div class="absolute inset-0 bg-black/20"></div>
            <div class="absolute inset-0 bg-cover bg-center opacity-30"
                style="background-image: url('https://images.unsplash.com/photo-1469474968028-56623f02e42e?w=1200')">
            </div>
            <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-24 lg:py-32">
                <div class="text-center mb-12">
                    <div class="bg-white px-4 py-1 rounded-full inline-block mb-4">
                        <p class="text-sm text-emerald-600">
                            Experience Nature, Feel The Culture</p>
                    </div>
                    <h1 class="text-3xl md:text-6xl font-bold mb-6 leading-tight max-w-4xl mx-auto">
                        <span class="text-emerald-200">Wisata Alam & Budaya di Jantung Sukolilo</span>
                    </h1>
                    <p class="text-lg md:text-xl text-emerald-100 mb-8 max-w-5xl mx-auto">
                        Rasakan sensasi menginap dan berpetualang di kawasan Air Terjun Tadah Udan dengan kenyamanan
                        modern, suasana alami yang asri, dan kegiatan seru bernuansa lokal. </p>
                </div>
            </div>
        </section>

        <!-- About -->
        <section class="py-20 bg-gray-50">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex flex-col sm:flex-row justify-between gap-12 items-center">
                    <div class="h-64 sm:h-80 rounded-xl overflow-hidden w-full sm:w-1/2">
                        <img src="{{ asset('air-terjun.jpg') }}" alt="himalaya" class="">
                    </div>
                    <div class="w-full sm:w-1/2"></div>
                    <div class="w-full sm:w-1/2">
                        <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">
                            Tentang Kampee
                        </h2>
                        <p class="text-justify   text-gray-600">
                            Wisata Tadah Udan di Kecamatan Sukolilo Kabupaten Pati Jawa Tengah ini akan
                            menawarkan
                            pengalaman menginap dan beraktivitas di kawasan Air Terjun Tadah Udan dengan konsep ramah
                            lingkungan, kenyamanan modern, dan petualangan alam. Terletak di sekitar kawasan Air Terjun
                            Tadah Udan yang masih asri, wisata ini menawarkan fasilitas, antara lain tenda penginapan,
                            tempat makan, area bermain, trekking alam, hingga restoran lokal, dan ada banyak kegiatan
                            yang bisa dilakukan seperti trekking air terjun, memilah sampah organik dan anorganik, BBQ,
                            menikmati kuliner lokal, menikmati keindahan alam sekitar hingga live musik. Dengan tagline
                            wisata baru yaitu “ Experience Nature, Feel The Culture”
                        </p>
                    </div>
                </div>
            </div>
        </section>


        <!-- Galery Section -->
        <section class="py-16 bg-gray-50">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center mb-12">
                    <h2 class="text-3xl font-bold text-gray-900 mb-4">Galeri Petualangan Kami</h2>
                    <p class="text-lg text-gray-600 max-w-2xl mx-auto">
                        Jelajahi momen-momen indah dari perjalanan para traveler sebelumnya
                    </p>
                </div>

                <!-- Slider Container -->
                <div class="relative">
                    <!-- Slider Controls -->
                    <button onclick="scrollSlider(-1)"
                        class="absolute left-0 top-1/2 -translate-y-1/2 z-10 bg-white/80 hover:bg-white text-emerald-600 p-3 rounded-full shadow-md ml-2 transition-all">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                        </svg>
                    </button>

                    <button onclick="scrollSlider(1)"
                        class="absolute right-0 top-1/2 -translate-y-1/2 z-10 bg-white/80 hover:bg-white text-emerald-600 p-3 rounded-full shadow-md mr-2 transition-all">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                        </svg>
                    </button>

                    <!-- Slider Track -->
                    <div id="slider"
                        class="flex overflow-x-auto snap-x snap-mandatory scroll-smooth space-x-6 pb-6 -mx-4 px-4 hide-scrollbar">

                        <div class="flex-shrink-0 w-full md:w-1/2 snap-center">
                            <div class="relative h-64 rounded-xl overflow-hidden shadow-lg">
                                <img src="{{ asset('storage/paket_wisata/sunset.jpg') }}" alt="Sunset"
                                    class="w-full h-auto object-cover">
                                <div
                                    class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent flex items-end p-6">
                                    <div>
                                        <h3 class="text-white font-semibold text-lg">Sunset</h3>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="flex-shrink-0 w-full md:w-1/2 snap-center">
                            <div class="relative h-64 rounded-xl overflow-hidden shadow-lg">
                                <img src="{{ asset('storage/paket_wisata/eksplor.jpg') }}" alt="Eksplor"
                                    class="w-full h-auto object-cover">
                                <div
                                    class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent flex items-end p-6">
                                    <div>
                                        <h3 class="text-white font-semibold text-lg">Eksplor</h3>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="flex-shrink-0 w-full md:w-1/2 snap-center">
                            <div class="relative h-64 rounded-xl overflow-hidden shadow-lg">
                                <img src="{{ asset('storage/paket_wisata/petualang.jpg') }}" alt="Petualangan"
                                    class="w-full h-auto object-cover">
                                <div
                                    class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent flex items-end p-6">
                                    <div>
                                        <h3 class="text-white font-semibold text-lg">Petualangan</h3>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="flex-shrink-0 w-full md:w-1/2 snap-center">
                            <div class="relative h-64 rounded-xl overflow-hidden shadow-lg">
                                <img src="{{ asset('storage/paket_wisata/sekolah.jpg') }}" alt="Wisata Sekolah"
                                    class="w-full h-auto object-cover">
                                <div
                                    class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent flex items-end p-6">
                                    <div>
                                        <h3 class="text-white font-semibold text-lg">Wisata Sekolah</h3>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="flex-shrink-0 w-full md:w-1/2 snap-center">
                            <div class="relative h-64 rounded-xl overflow-hidden shadow-lg">
                                <img src="{{ asset('storage/paket_wisata/romantis.jpg') }}" alt="Couple"
                                    class="w-full h-auto object-cover">
                                <div
                                    class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent flex items-end p-6">
                                    <div>
                                        <h3 class="text-white font-semibold text-lg">Couple</h3>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="text-center mt-12">
                    <a href="{{ route('user.paket-wisata.index') }}"
                        class="inline-flex items-center px-6 py-3 border border-transparent text-base font-medium rounded-md shadow-sm text-white bg-emerald-600 hover:bg-emerald-700 transition-colors duration-200">
                        Lihat Semua Paket Wisata
                        <svg xmlns="http://www.w3.org/2000/svg" class="ml-2 h-5 w-5" viewBox="0 0 20 20"
                            fill="currentColor">
                            <path fill-rule="evenodd"
                                d="M10.293 5.293a1 1 0 011.414 0l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414-1.414L12.586 11H5a1 1 0 110-2h7.586l-2.293-2.293a1 1 0 010-1.414z"
                                clip-rule="evenodd" />
                        </svg>
                    </a>
                </div>
            </div>
        </section>
    </div>

    @push('styles')
        <style>
            .bg-black\/20 {
                background-color: rgba(0, 0, 0, 0.2);
            }
        </style>
    @endpush

    <script>
        function scrollSlider(direction) {
            const slider = document.getElementById('slider');
            const scrollAmount = 300; // Sesuaikan dengan lebar slide + margin
            slider.scrollBy({
                left: direction * scrollAmount,
                behavior: 'smooth'
            });
        }
    </script>

</x-user-layout>
