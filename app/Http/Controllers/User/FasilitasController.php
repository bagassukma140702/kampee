<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Fasilitas;
use App\Models\PaketWisata;
use Illuminate\Http\Request;

class PaketWisataController extends Controller
{
    public function index(Request $request)
    {
        $fasilitas = Fasilitas::all();
        return view('user.fasilitas.index', compact('fasilitas'));
    }

}
