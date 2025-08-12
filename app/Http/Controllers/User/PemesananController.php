<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\PaketWisata;
use App\Models\Pemesanan;
use Barryvdh\DomPDF\Facade\Pdf as FacadePdf;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class PemesananController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::user();

        $query = Pemesanan::with('paket')
        ->where('user_id', $user->id);

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $pemesanan = $query->latest()->get();

            // Hitung statistik
        $stats = [
            'total'     => $pemesanan->count(),
            'confirmed' => $pemesanan->where('status', 'paid')->count(),
            'pending'   => $pemesanan->where('status', 'pending')->count(),
            'spent'     => $pemesanan->where('status', 'paid')->sum('total_harga'),
        ];

        return view('user.pemesanan.index', compact('pemesanan', 'stats'));
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        // ✅ Validasi input
        $validated = $request->validate([
            'tour_id' => 'required|exists:paket_wisata,id',
            'date' => 'required|date',
            'participants' => 'required|integer|min:1',
            'customer_name' => 'required|string|max:255',
            'customer_email' => 'required|email',
            'customer_phone' => 'required|string|min:10|max:15',
        ]);

        // ✅ Ambil data paket
        $paket = PaketWisata::findOrFail($validated['tour_id']);

        // ✅ Hitung total harga
        $totalHarga = $paket->harga_jual * $validated['participants'];

        // ✅ Buat order ID unik
        $orderId = 'ORD-' . strtoupper(Str::random(8)) . '-' . now()->format('YmdHis');

        // ✅ Simpan data pemesanan
        $pemesanan = Pemesanan::create([
            'user_id' => Auth::id(),
            'paket_id' => $paket->id,
            'tanggal' => $validated['date'],
            'jumlah' => $validated['participants'],
            'total_harga' => $totalHarga,
            'status' => 'pending',
            'order_id' => $orderId,
            'snap_token' => null, 
            'no_hp' => $request->customer_phone,
        ]);

        // Generate e-ticket PDF
        $pdf = FacadePdf::loadView('user.pemesanan.eticket-pdf', compact('pemesanan'));
        $filename = "tickets/{$pemesanan->order_id}.pdf";
        Storage::put($filename, $pdf->output());

        // ⏭️ Redirect ke halaman sukses
        return redirect()->route('user.pemesanan.index', $pemesanan->id)
            ->with('success', 'Pemesanan berhasil dibuat!');
    }

    public function success($id)
    {
        $pemesanan = Pemesanan::with('paket')->where('id', $id)->where('user_id', Auth::id())->firstOrFail();

        return view('user.pemesanan.success', compact('pemesanan'));
    }

    public function form($id)
    {
        $tour = PaketWisata::findOrFail($id);
        
        $available_dates = collect();
        for ($i = 0; $i < 10; $i++) {
            $available_dates->push(Carbon::now()->addDays($i)->toDateString());
        }

        return view('user.pemesanan.form', compact('tour', 'available_dates'));
    }

    public function show($id){
        $pemesanan = Pemesanan::with('paket')->where('id', $id)->where('user_id', Auth::id())->firstOrFail();

        // Nomor admin WA
        $adminPhone = '6281332008813';

        // Format isi pesan WhatsApp
        $message = "Halo Admin

Saya ingin konfirmasi pemesanan saya:

Nama: {$pemesanan->user->name}
No HP: {$pemesanan->no_hp}
Email: {$pemesanan->user->email}

Paket: {$pemesanan->paket->nama}
Tanggal: " . \Carbon\Carbon::parse($pemesanan->tanggal)->translatedFormat('d F Y') . "
Peserta: {$pemesanan->jumlah}
Total Harga: Rp " . number_format($pemesanan->total_harga, 0, ',', '.') . "
Order ID: {$pemesanan->order_id}

Mohon info lebih lanjut terkait pembayaran.";

        $waLink = "https://wa.me/{$adminPhone}?text=" . urlencode($message);

        return view('user.pemesanan.show', compact('pemesanan', 'waLink'));
    }

   public function downloadEticket($id)
    {
        $pemesanan = Pemesanan::findOrFail($id);

        // Cek hak akses
        if (
            auth()->user()->role !== 'admin' &&
            ($pemesanan->user_id !== auth()->id() || $pemesanan->status !== 'paid')
        ) {
            abort(403, 'Unauthorized');
        }

        $filename = "tickets/{$pemesanan->order_id}.pdf";

        // Hapus file lama jika ada
        if (Storage::exists($filename)) {
            Storage::delete($filename);
        }

        // Selalu generate yang baru
        $pdf = FacadePdf::loadView('user.pemesanan.eticket-pdf', compact('pemesanan'))
            ->setOptions(['isRemoteEnabled' => true]);

        Storage::put($filename, $pdf->output());

        return Storage::download($filename, "E-ticket-{$pemesanan->order_id}.pdf", [
            'Content-Type' => 'application/pdf',
        ]);
    }

}
