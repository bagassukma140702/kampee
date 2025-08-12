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
        Schema::create('paket_biaya', function (Blueprint $table) {
            $table->id();
            $table->foreignId('paket_id')->constrained('paket_wisata')->cascadeOnDelete();
            $table->string('nama');       // contoh: Makan & BBQ
            $table->integer('jumlah');    // nilai biaya, misal 50000
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('paket_biaya');
    }
};
