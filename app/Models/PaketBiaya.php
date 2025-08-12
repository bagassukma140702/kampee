<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PaketBiaya extends Model
{
    protected $table = 'paket_biaya';
    protected $fillable = ['paket_id', 'nama', 'jumlah'];

    public function paket()
    {
        return $this->belongsTo(PaketWisata::class, 'paket_id');
    }
}
