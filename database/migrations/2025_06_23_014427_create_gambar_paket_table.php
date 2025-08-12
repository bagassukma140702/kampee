<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('gambar_paket', function (Blueprint $table) {
            $table->id();
            $table->foreignId('paket_id')->constrained('paket_wisata')->onDelete('cascade');
            $table->string('path'); // lokasi file di storage/public
            $table->string('caption')->nullable();
            $table->integer('urutan')->default(0); // untuk mengatur mana yang tampil pertama
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('gambar_paket');
    }
};
