<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PaketWisata extends Model
{
    protected $table = 'paket_wisata';
    protected $fillable = [
        'nama',
        'deskripsi',
        'durasi',
        'jumlah_orang',
        'minimal_peserta',
        'target_peserta',
        'tipe_harga',
        'harga_modal',
        'margin',
        'harga_jual',
        'lokasi',
        'gambar',
    ];
    
    public function gambar()
    {
        return $this->hasMany(GambarPaket::class);
    }

    public function fasilitas()
    {
        return $this->hasMany(FasilitasPaket::class, 'paket_id');
    }

    public function biaya()
    {
        return $this->hasMany(PaketBiaya::class, 'paket_id');
    }

    public function hitungHargaModal()
    {
        return $this->biaya->sum('jumlah');
    }

    public function hitungHargaJual()
    {
        $modal = $this->hitungHargaModal();
        return $modal + ($modal * $this->margin / 100);
    }

    public function bookings()
    {
        return $this->hasMany(Pemesanan::class, 'paket_id');
    }

    public function paidBookings()
    {
        return $this->hasMany(Pemesanan::class, 'paket_id')->where('status', 'paid');
    }
}
