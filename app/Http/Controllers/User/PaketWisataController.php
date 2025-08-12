<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\PaketWisata;
use Illuminate\Http\Request;

class PaketWisataController extends Controller
{
    public function index(Request $request)
    {
        $tours = PaketWisata::all();
        return view('user.paket-wisata.index', compact('tours'));
    }

    public function show(PaketWisata $paketWisata)
    {
        $tour = $paketWisata;
        $paketWisata->load('fasilitas', 'bookings'); // semua bookings
        $paketWisata->loadCount([
            'bookings as bookings_paid_count' => fn ($q) => $q->where('status', 'paid'),
        ]);
        $paketWisata->loadSum([
            'bookings as bookings_paid_sum_total_harga' => fn ($q) => $q->where('status', 'paid'),
        ], 'total_harga');

        $selectedImage = 0; // Default selected image index
        $isFavorite = false; // Default favorite status

        return view('user.paket-wisata.show', compact('paketWisata', 'selectedImage', 'isFavorite', 'tour'));
    }

}
