<?php

namespace App\Http\Controllers;

use App\Models\Fasilitas;
use Illuminate\Http\Request;

class FasilitasController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
        ]);

        $fasilitas = Fasilitas::create([
            'nama' => $validated['nama'],
            'deskripsi' => '-', // Default, nanti bisa diedit manual
        ]);

        return response()->json([
            'id' => $fasilitas->id,
            'nama' => $fasilitas->nama,
        ]);
    }
}
