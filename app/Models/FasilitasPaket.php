<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FasilitasPaket extends Model
{
    protected $table = 'fasilitas_paket';
    protected $fillable = ['paket_id', 'nama'];

    public function paket()
    {
        return $this->belongsTo(PaketWisata::class, 'paket_id');
    }
}
