<?php

namespace App\Http\Controllers;

use App\Models\PaketWisata;
use App\Models\Pemesanan;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Str;


class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Statistik dasar
        $totalRevenue = Pemesanan::where('status', 'paid')->sum('total_harga');
        $totalBookings = Pemesanan::count();
        $totalCustomers = User::where('role', 'user')->count();
        $jumlahTour = PaketWisata::count();

        // Inisialisasi bulan (Jan - Des)
        $bulanLabels = collect(range(1, 12))->map(function ($b) {
            return Carbon::create()->month($b)->locale('id')->isoFormat('MMMM');
        });

        // Pemesanan per bulan
        $bookingsPerMonth = Pemesanan::selectRaw('MONTH(tanggal) as bulan, COUNT(*) as jumlah')
            ->whereYear('tanggal', now()->year)
            ->groupBy('bulan')
            ->pluck('jumlah', 'bulan');

        $jumlahPemesanan = $bulanLabels->keys()->map(function ($i) use ($bookingsPerMonth) {
            $bulan = $i + 1;
            return $bookingsPerMonth[$bulan] ?? 0;
        });

        // Pendapatan per bulan
        $pendapatanPerMonth = Pemesanan::selectRaw('MONTH(tanggal) as bulan, SUM(total_harga) as total')
            ->whereYear('tanggal', now()->year)
            ->where('status', 'paid')
            ->groupBy('bulan')
            ->pluck('total', 'bulan');

        $jumlahPendapatan = $bulanLabels->keys()->map(function ($i) use ($pendapatanPerMonth) {
            $bulan = $i + 1;
            return $pendapatanPerMonth[$bulan] ?? 0;
        });

        // Pemesanan terbaru
        $recentBookings = Pemesanan::with(['user', 'paket'])
            ->latest()
            ->take(5)
            ->get()
            ->map(function ($item) {
                $gambar = $item->paket->gambar ?? null;
                $imageUrl = Str::startsWith($gambar, ['http://', 'https://'])
                    ? $gambar
                    : ($gambar ? asset('storage/' . $gambar) : '/placeholder.jpg');

                return [
                    'id' => $item->id,
                    'customerId' => $item->paket_id,
                    'customerName' => $item->user->name ?? 'User tidak ditemukan',
                    'tour' => [
                        'title' => $item->paket->nama ?? '-',
                        'images' => [$imageUrl],
                    ],
                    'totalPrice' => $item->total_harga,
                    'participants' => $item->jumlah,
                    'status' => $item->status,
                ];
            });

        // Kemas ke array data
        $dashboardData = [
            'stats' => [
                'totalRevenue' => $totalRevenue,
                'totalBookings' => $totalBookings,
                'totalCustomers' => $totalCustomers,
            ],
            'totalTours' => $jumlahTour,
            'recentBookings' => $recentBookings,
        ];

        return view('admin.dashboard', compact(
            'dashboardData',
            'jumlahTour',
            'bulanLabels',
            'jumlahPemesanan',
            'jumlahPendapatan'
        ));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
