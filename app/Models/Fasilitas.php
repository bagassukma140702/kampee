<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Fasilitas extends Model
{
    protected $fillable = ['nama', 'deskripsi'];

    public function paketWisata()
    {
        return $this->belongsToMany(PaketWisata::class, 'fasilitas_paket');
    }

}
