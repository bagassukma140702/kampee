<?php

namespace App\Http\Controllers;

use App\Models\PaketWisata;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        $query = PaketWisata::query();

        // Ambil hanya 3 data
        $tours = $query->take(3)->get();
        $user = Auth::user(); // null jika belum login

        return view('home', compact('user', 'tours'));
    }
}
