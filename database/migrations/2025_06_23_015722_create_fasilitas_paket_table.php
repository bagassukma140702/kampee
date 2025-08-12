<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('fasilitas_paket', function (Blueprint $table) {
            $table->id();
            $table->foreignId('paket_id')->constrained('paket_wisata')->onDelete('cascade');
            $table->string('nama');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('fasilitas_paket');
    }
};
