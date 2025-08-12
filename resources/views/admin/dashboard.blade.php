<x-admin-layout>
    @php
        function formatPrice($amount)
        {
            return 'Rp' . number_format($amount, 0, ',', '.');
        }

        function getStatusBadge($status)
        {
            $colors = [
                'paid' => 'bg-green-100 text-green-800',
                'pending' => 'bg-yellow-100 text-yellow-800',
                'canceled' => 'bg-red-100 text-red-800',
            ];
            $color = $colors[$status] ?? 'bg-gray-100 text-gray-800';
            return '<span class="px-2 py-1 rounded-full text-xs ' . $color . '">' . ucfirst($status) . '</span>';
        }
    @endphp


    <x-slot name="header">
        <div class="">
            <h1 class="text-3xl font-bold text-gray-900">Dashboard Admin</h1>
            <p class="text-gray-500">Pantau performa pemesanan dan pendapatan tour Anda.</p>
        </div>
    </x-slot>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-12">

        <!-- Cards -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
            <!-- Total Revenue -->
            <div class="bg-white rounded-2xl shadow-md p-6 flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-500">Total Revenue</p>
                    <p class="text-2xl font-bold text-gray-900 mt-1">
                        {{ formatPrice($dashboardData['stats']['totalRevenue']) }}</p>
                </div>
                <div class="p-3 rounded-full bg-emerald-100">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-emerald-600" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <line x1="12" y1="1" x2="12" y2="23" />
                        <path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6" />
                    </svg>
                </div>
            </div>

            <!-- Total Pemesanan -->
            <div class="bg-white rounded-2xl shadow-md p-6 flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-500">Total Pemesanan</p>
                    <p class="text-2xl font-bold text-gray-900 mt-1">{{ $dashboardData['stats']['totalBookings'] }}</p>
                </div>
                <div class="p-3 rounded-full ">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-blue-600" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <rect x="3" y="4" width="18" height="18" rx="2" ry="2" />
                        <line x1="16" y1="2" x2="16" y2="6" />
                        <line x1="8" y1="2" x2="8" y2="6" />
                        <line x1="3" y1="10" x2="21" y2="10" />
                    </svg>
                </div>
            </div>

            <!-- Total Customer -->
            <div class="bg-white rounded-2xl shadow-md p-6 flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-500">Total Customer</p>
                    <p class="text-2xl font-bold text-gray-900 mt-1">{{ $dashboardData['stats']['totalCustomers'] }}</p>
                </div>
                <div class="p-3 rounded-full">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-purple-600" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2" />
                        <circle cx="9" cy="7" r="4" />
                        <path d="M23 21v-2a4 4 0 0 0-3-3.87" />
                        <path d="M16 3.13a4 4 0 0 1 0 7.75" />
                    </svg>
                </div>
            </div>

            <!-- Active Tours -->
            <div class="bg-white rounded-2xl shadow-md p-6 flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-500">Active Tours</p>
                    <p class="text-2xl font-bold text-gray-900 mt-1">{{ $dashboardData['totalTours'] }}</p>
                </div>
                <div class="p-3 rounded-full">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-indigo-600" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <polyline points="23 6 13.5 15.5 8.5 10.5 1 18" />
                        <polyline points="17 6 23 6 23 12" />
                    </svg>
                </div>
            </div>
        </div>

        <!-- Charts Pemesanan & Pendapatan -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
            <!-- Chart Pemesanan -->
            <div class="bg-white rounded-2xl shadow-md p-6 space-y-4">
                <h2 class="text-lg font-semibold text-gray-800">Grafik Jumlah Pemesanan</h2>
                <div class="aspect-video">
                    <canvas id="bookingChart"></canvas>
                </div>
            </div>

            <!-- Chart Pendapatan -->
            <div class="bg-white rounded-2xl shadow-md p-6 space-y-4">
                <h2 class="text-lg font-semibold text-gray-800">Grafik Pendapatan</h2>
                <div class="aspect-video">
                    <canvas id="revenueChart"></canvas>
                </div>
            </div>
        </div>

        <!-- Pemesanan Terbaru -->
        <div class="bg-white rounded-2xl shadow-md">
            <div class="p-6 border-b">
                <h3 class="text-lg font-semibold text-gray-800">Pemesanan Terbaru</h3>
            </div>
            <div class="divide-y divide-gray-100">
                @foreach ($dashboardData['recentBookings'] as $booking)
                    <a href="{{ route('admin.pemesanan.show', $booking['id']) }}"
                        class="p-4 flex items-center justify-between">
                        <div class="flex items-center gap-4">
                            <img src="{{ $booking['tour']['images'][0] }}" class="w-12 h-12 object-cover rounded-md" />
                            <div>
                                <p class="font-medium text-gray-900">{{ $booking['customerName'] }}</p>
                                <p class="text-sm text-gray-500">{{ $booking['tour']['title'] }}</p>
                            </div>
                        </div>
                        <div class="flex items-center gap-2">
                            <div class="text-right space-y-1">
                                <p class="text-emerald-600 font-semibold">{{ formatPrice($booking['totalPrice']) }}</p>
                                <p class="text-sm text-gray-500">{{ $booking['participants'] }} peserta</p>
                            </div>
                            <div class="w-[80px] flex justify-end">
                                {!! getStatusBadge($booking['status']) !!}
                            </div>

                        </div>
                    </a>
                @endforeach
            </div>
        </div>
    </div>

    @push('scripts')
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const ctxBooking = document.getElementById('bookingChart').getContext('2d');
                new Chart(ctxBooking, {
                    type: 'bar',
                    data: {
                        labels: @json($bulanLabels),
                        datasets: [{
                            label: 'Jumlah Pemesanan',
                            data: @json($jumlahPemesanan),
                            backgroundColor: '#10b981',
                            borderRadius: 6,
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        scales: {
                            y: {
                                beginAtZero: true,
                                ticks: {
                                    precision: 0
                                }
                            }
                        }
                    }
                });

                const ctxRevenue = document.getElementById('revenueChart').getContext('2d');
                new Chart(ctxRevenue, {
                    type: 'line',
                    data: {
                        labels: @json($bulanLabels),
                        datasets: [{
                            label: 'Pendapatan',
                            data: @json($jumlahPendapatan),
                            borderColor: '#3b82f6',
                            backgroundColor: 'rgba(59, 130, 246, 0.2)',
                            fill: true,
                            tension: 0.4,
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        scales: {
                            y: {
                                beginAtZero: true
                            }
                        }
                    }
                });
            });
        </script>
    @endpush
</x-admin-layout>
