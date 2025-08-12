<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class PemesananSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $userIds = DB::table('users')
            ->where('role', 'user')
            ->pluck('id')
            ->toArray();

        // Ambil data paket lengkap: id, harga_jual, tipe_harga, jumlah_orang
        $pakets = DB::table('paket_wisata')
            ->select('id', 'harga_jual', 'tipe_harga', 'jumlah_orang')
            ->get();

        if (empty($userIds) || $pakets->isEmpty()) {
            dump("Seeder dibatalkan: Pastikan tabel users dan paket_wisata memiliki data terlebih dahulu.");
            return;
        }

        foreach (range(1, 10) as $_) {
            $userId = fake()->randomElement($userIds);
            $paket = fake()->randomElement($pakets->all());

            // Tentukan jumlah peserta random (1–5)
            $jumlahPeserta = fake()->numberBetween(1, 5);
            $hargaSatuan = $paket->harga_jual;
            $total = 0;

            // Hitung total berdasarkan tipe harga
            if ($paket->tipe_harga === 'per_orang') {
                $total = $jumlahPeserta * $hargaSatuan;

            } elseif (in_array($paket->tipe_harga, ['per_paket', 'per_pasangan'])) {
                $jumlahOrangPerPaket = max(1, (int) $paket->jumlah_orang); // fallback 1 jika null atau 0
                $jumlahPaket = (int) ceil($jumlahPeserta / $jumlahOrangPerPaket);
                $total = $jumlahPaket * $hargaSatuan;

            } else {
                $total = $jumlahPeserta * $hargaSatuan;
            }

            DB::table('pemesanan')->insert([
                'user_id' => $userId,
                'paket_id' => $paket->id,
                'tanggal' => Carbon::now()->addDays(fake()->numberBetween(1, 30)),
                'jumlah' => $jumlahPeserta,
                'total_harga' => $total,
                'status' => fake()->randomElement(['pending', 'paid', 'canceled']),
                'snap_token' => null,
                'order_id' => 'ORD-' . strtoupper(Str::random(10)),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
