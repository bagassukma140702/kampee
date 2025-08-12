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
        Schema::create('paket_wisata', function (Blueprint $table) {
            $table->id();

            // Informasi umum
            $table->string('nama');
            $table->text('deskripsi');
            $table->string('durasi'); // Contoh: "2D1N", "1 hari", "6 jam"
            $table->integer('jumlah_orang')->nullable(); // untuk pasangan atau private trip
            $table->integer('minimal_peserta')->nullable(); // untuk open trip atau grup
            $table->string('target_peserta')->nullable()->default('orang'); // contoh: siswa, pasangan, umum

            // Perhitungan bisnis
            $table->enum('tipe_harga', ['per_orang', 'per_paket', 'per_pasangan'])->default('per_orang');
            $table->integer('harga_modal')->nullable(); // dihitung dari tabel paket_biaya
            $table->integer('margin')->default(0); // dalam persen, contoh 40
            $table->integer('harga_jual')->nullable(); // hasil dari harga_modal + margin

            // Metadata
            $table->string('lokasi');
            $table->string('gambar')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('paket_wisata');
    }
};
