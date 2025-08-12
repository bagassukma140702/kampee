<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GambarPaket extends Model
{
    protected $table = 'gambar_paket';

    public function paket()
    {
        return $this->belongsTo(PaketWisata::class);
    }
}
