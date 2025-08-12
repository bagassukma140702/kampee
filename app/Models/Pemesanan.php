<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pemesanan extends Model
{
    protected $table = 'pemesanan';
    protected $fillable = [
    'user_id',
    'paket_id',
    'tanggal',
    'jumlah',
    'total_harga',
    'status',
    'snap_token',
    'order_id',
    'no_hp',
];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function paket()
    {
        return $this->belongsTo(PaketWisata::class, 'paket_id');
    }

}
