<?php

namespace App\Http\Controllers;

use App\Models\Pemesanan;
use Illuminate\Http\Request;

class PemesananController extends Controller
{
    public function index(Request $request)
    {
        $query = Pemesanan::with(['user', 'paket']);

        // Filter berdasarkan status
        if ($request->filled('status') && $request->status !== 'all') {
            $query->where('status', $request->status);
        }

        // Pencarian berdasarkan nama user
        if ($request->filled('search')) {
            $query->whereHas('user', function ($q) use ($request) {
                $q->where('name', 'like', '%' . $request->search . '%');
            });
        }

        // Pagination
        $bookings = $query->latest()->paginate(5)->withQueryString();

        return view('admin.pemesanan.index', compact('bookings'));
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show($id)
    {
        $pemesanan = Pemesanan::with(['user', 'paket'])
            ->findOrFail($id);

        return view('admin.pemesanan.show', compact('pemesanan'));
    }

    public function edit(Pemesanan $pemesanan)
    {
        //
    }

    public function update(Request $request, Pemesanan $pemesanan)
    {
        //
    }

    public function destroy(Pemesanan $pemesanan)
    {
        //
    }

    public function updateStatus($id, Request $request)
    {
        $booking = Pemesanan::findOrFail($id);

        // Validasi status baru (optional, bisa juga dropdown dinamis)
        $newStatus = $request->input('status');
        if (!in_array($newStatus, ['pending', 'paid', 'failed', 'canceled'])) {
            return redirect()->back()->with('error', 'Status tidak valid.');
        }

        $booking->status = $newStatus;
        $booking->save();

        return redirect()->back()->with('success', 'Status booking berhasil diperbarui.');
    }
}
