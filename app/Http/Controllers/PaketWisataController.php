<?php

namespace App\Http\Controllers;

use App\Models\Fasilitas;
use App\Models\FasilitasPaket;
use App\Models\PaketBiaya;
use Illuminate\Support\Str;
use App\Models\PaketWisata;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PaketWisataController extends Controller
{
    public function index()
    {
        $fasilitasList = Fasilitas::all();
        $tours = PaketWisata::all();
        return view('admin.paket-wisata.index', compact('tours', 'fasilitasList'));
    }

    public function create()
    {
        return view('admin.paket-wisata.form');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'lokasi' => 'required|string|max:255',
            'durasi' => 'required|string|max:100',
            'jumlah_orang' => 'nullable|integer|min:1',
            'minimal_peserta' => 'nullable|integer|min:1',
            'target_peserta' => 'nullable|string|max:255',
            'tipe_harga' => 'required|in:per_orang,per_paket,per_pasangan',
            'margin' => 'required|numeric|min:0|max:100',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'deskripsi' => 'nullable|string',
            'fasilitas' => 'nullable|array',
            'fasilitas.*.nama' => 'required|string|max:255',
        ]);

        // Upload gambar
        $gambarPath = null;
        if ($request->hasFile('gambar')) {
            $gambarPath = $request->file('gambar')->store('paket_wisata', 'public');
        }

        // Buat paket wisata
        $paket = PaketWisata::create([
            'nama' => $request->nama,
            'lokasi' => $request->lokasi,
            'durasi' => $request->durasi,
            'jumlah_orang' => $request->jumlah_orang,
            'minimal_peserta' => $request->minimal_peserta,
            'target_peserta' => $request->target_peserta,
            'tipe_harga' => $request->tipe_harga,
            'margin' => $request->margin,
            'harga_modal' => 0, // default, akan dihitung setelah input biaya
            'harga_jual' => 0,  // default, akan dihitung setelah input biaya
            'gambar' => $gambarPath,
            'deskripsi' => $request->deskripsi,
        ]);

        // Simpan fasilitas paket (one-to-many)
        $fasilitasItems = $request->input('fasilitas', []);
        foreach ($fasilitasItems as $item) {
            if (!empty($item['nama'])) {
                FasilitasPaket::create([
                    'paket_id' => $paket->id,
                    'nama' => $item['nama'],
                ]);
            }
        }

        $biayaItems = $request->input('biaya', []);

        $totalBiaya = 0;
        foreach ($biayaItems as $biaya) {
            $jumlah = (int) $biaya['jumlah'];
            $totalBiaya += $jumlah;

            PaketBiaya::create([
                'paket_id' => $paket->id,
                'nama' => $biaya['nama'],
                'jumlah' => $jumlah,
            ]);
        }

        // Hitung harga_jual dari harga_modal + margin
        $paket->harga_modal = $totalBiaya;
        $paket->harga_jual = $totalBiaya + ($totalBiaya * ($paket->margin / 100));
        $paket->save();

        return redirect()->route('admin.paket-wisata.index')
            ->with('success', 'Paket wisata berhasil disimpan! Tambahkan biaya komponen setelah ini.');
    }

    public function show(PaketWisata $paketWisata)
    {
        // Load fasilitas & biaya seperti biasa
        $paketWisata->load('fasilitas', 'biaya');

        // Relasi bookings terbatas 5 terbaru (misal status "paid")
        $paketWisata->load([
            'bookings' => fn($q) => $q->orderByDesc('created_at')->limit(5)
        ]);

        // Hitungan total booking paid
        $paketWisata->loadCount([
            'bookings as bookings_paid_count' => fn($q) => $q->where('status', 'paid'),
        ]);

        // Total uang masuk dari booking paid
        $paketWisata->loadSum([
            'bookings as bookings_paid_sum_total_harga' => fn($q) => $q->where('status', 'paid'),
        ], 'total_harga');

        $selectedImage = 0;
        $isFavorite = false;

        return view('admin.paket-wisata.show', compact('paketWisata', 'selectedImage', 'isFavorite'));
    }

    public function edit(PaketWisata $paketWisata)
    {
        $fasilitasList = Fasilitas::all();

        // Untuk preload biaya dan fasilitas
        $paketWisata->load(['biaya', 'fasilitas']);

        return view('admin.paket-wisata.form', compact('paketWisata', 'fasilitasList'));
    }

    public function update(Request $request, PaketWisata $paketWisata)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'lokasi' => 'required|string|max:255',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'deskripsi' => 'nullable|string',
            'fasilitas' => 'nullable|array',
            'durasi' => 'nullable|string|max:255',
            'tipe_harga' => 'nullable|string|in:per_orang,per_pasangan,per_paket',
            'jumlah_orang' => 'nullable|integer|min:0',
            'minimal_peserta' => 'nullable|integer|min:1',
            'target_peserta' => 'nullable|string|max:255',
            'margin' => 'required|numeric|min:0|max:100',
            'fasilitas' => 'nullable|array',
            'fasilitas.*.nama' => 'required|string|max:255',
            'biaya' => 'nullable|array',
            'biaya.*.nama' => 'required|string|max:255',
            'biaya.*.jumlah' => 'required|numeric|min:0',
        ]);

        if ($request->hasFile('gambar')) {
            if ($paketWisata->gambar && Storage::disk('public')->exists($paketWisata->gambar)) {
                Storage::disk('public')->delete($paketWisata->gambar);
            }
            $paketWisata->gambar = $request->file('gambar')->store('paket_wisata', 'public');
        }

        $paketWisata->update([
            'nama' => $request->nama,
            'lokasi' => $request->lokasi,
            'deskripsi' => $request->deskripsi,
            'durasi' => $request->durasi,
            'tipe_harga' => $request->tipe_harga,
            'jumlah_orang' => $request->jumlah_orang,
            'minimal_peserta' => $request->minimal_peserta,
            'target_peserta' => $request->target_peserta,
            'margin' => $request->margin,
        ]);

        // Hapus semua fasilitas lama
        $paketWisata->fasilitas()->delete();

        // Simpan fasilitas baru
        foreach ($request->input('fasilitas', []) as $item) {
            $paketWisata->fasilitas()->create([
                'nama' => $item['nama'],
            ]);
        }

        // Update biaya dan hitung ulang harga
        $paketWisata->biaya()->delete();

        $totalBiaya = 0;
        foreach ($request->input('biaya', []) as $biaya) {
            $jumlah = (int) $biaya['jumlah'];
            $totalBiaya += $jumlah;

            $paketWisata->biaya()->create([
                'nama' => $biaya['nama'],
                'jumlah' => $jumlah,
            ]);
        }

        // Update harga_modal dan harga_jual
        $paketWisata->harga_modal = $totalBiaya;
        $paketWisata->harga_jual = $totalBiaya + ($totalBiaya * ($paketWisata->margin / 100));
        $paketWisata->save();

        return redirect()->route('admin.paket-wisata.index')->with('success', 'Paket wisata berhasil diperbarui.');
    }

    public function destroy(PaketWisata $paketWisata)
    {
        $paketWisata = PaketWisata::find($paketWisata->id);
        $paketWisata->delete();

        return redirect()->route('admin.paket-wisata.index')->with('success', 'Paket wisata berhasil dihapus!');
    }
}
