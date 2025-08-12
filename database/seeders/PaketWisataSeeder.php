<?php

namespace Database\Seeders;

use App\Models\FasilitasPaket;
use App\Models\PaketBiaya;
use App\Models\PaketWisata;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PaketWisataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tours = [
            [
                'id' => 1,
                'nama' => 'Sunset Serenity At Kendeng (Half Day)',
                'lokasi' => 'Pegunungan Kendeng, Pati',
                'gambar' => 'paket_wisata/sunset.jpg',
                'deskripsi' => 'Glamping sore di lereng Kendeng dengan city light, BBQ malam, dan musik tradisional.',
                'durasi' => '6 jam (16.00–22.00)',
                'jumlah_orang' => null,
                'minimal_peserta' => 10,
                'target_peserta' => 'umum',
                'tipe_harga' => 'per_orang',
                'margin' => 32,
                'fasilitas' => [
                    ['nama' => 'Glamping area (akses + fasilitas umum)'],
                    ['nama' => 'Menikmati city light dari lereng Kendeng'],
                    ['nama' => 'BBQ malam'],
                    ['nama' => 'Live musik akustik tradisional'],
                ],
                'biaya' => [
                    ['nama' => 'Sewa area dan tenda', 'jumlah' => 35000],
                    ['nama' => 'Makan & BBQ', 'jumlah' => 50000],
                    ['nama' => 'Pertunjukan musik tradisional', 'jumlah' => 15000],
                    ['nama' => 'Operasional & pemandu', 'jumlah' => 10000],
                ],
            ],
            [
                'id' => 2,
                'nama' => 'Eksplor Kendeng (One Day)',
                'lokasi' => 'Kawasan Kendeng, Pati',
                'gambar' => 'paket_wisata/eksplor.jpg',
                'deskripsi' => 'Trip satu hari menjelajahi air terjun, kuliner lokal, dan edukasi lingkungan melalui workshop & penanaman pohon.',
                'durasi' => '1 hari (08.00–17.00)',
                'jumlah_orang' => null,
                'minimal_peserta' => 15,
                'target_peserta' => 'umum',
                'tipe_harga' => 'per_orang',
                'margin' => 40,
                'fasilitas' => [
                    ['nama' => 'Tracking ke air terjun'],
                    ['nama' => 'Kuliner tradisional (makan siang dan camilan)]'],
                    ['nama' => 'Workshop pemilahan sampah'],
                    ['nama' => 'Penanaman pohon'],
                ],
                'biaya' => [
                    ['nama' => 'Pemandu tracking & logistik', 'jumlah' => 25000],
                    ['nama' => 'Makan + snack', 'jumlah' => 40000],
                    ['nama' => 'Bibit pohon', 'jumlah' => 10000],
                    ['nama' => 'Workshop edukasi lingkungan', 'jumlah' => 15000],
                    ['nama' => 'Operasional', 'jumlah' => 10000],
                ],
            ],
            [
                'id' => 3,
                'nama' => 'Petualang Kendeng (2 Hari 1 Malam)',
                'lokasi' => 'Kawasan Kendeng, Pati',
                'gambar' => 'paket_wisata/petualang.jpg',
                'deskripsi' => 'Menginap di glamping, tracking air terjun, BBQ malam, dan edukasi lingkungan 2 hari 1 malam penuh petualangan.',
                'durasi' => '2D1N',
                'jumlah_orang' => null,
                'minimal_peserta' => 10,
                'target_peserta' => 'umum',
                'tipe_harga' => 'per_orang',
                'margin' => 35,
                'fasilitas' => [
                    ['nama' => 'Menginap di glamping'],
                    ['nama' => 'Tracking air terjun'],
                    ['nama' => 'BBQ malam + pertunjukan tradisional'],
                    ['nama' => 'Kuliner lokal'],
                    ['nama' => 'Workshop lingkungan: tanam pohon & pilah sampah'],
                ],
                'biaya' => [
                    ['nama' => 'Glamping 1 malam', 'jumlah' => 100000],
                    ['nama' => 'Makan (3x) + BBQ', 'jumlah' => 90000],
                    ['nama' => 'Tracking + pemandu', 'jumlah' => 30000],
                    ['nama' => 'Hiburan tradisional', 'jumlah' => 15000],
                    ['nama' => 'Bibit + workshop lingkungan', 'jumlah' => 20000],
                    ['nama' => 'Operasional + logistik', 'jumlah' => 20000],
                ],
            ],
            [
                'id' => 4,
                'nama' => 'Wisata Sekolah Hijau (One Day Group)',
                'lokasi' => 'Kawasan Kendeng, Pati',
                'gambar' => 'paket_wisata/sekolah.jpg',
                'deskripsi' => 'Program edukasi lingkungan untuk rombongan sekolah dengan tanam pohon, city light sore, outbound, dan kuliner lokal.',
                'durasi' => '1 hari',
                'jumlah_orang' => null,
                'minimal_peserta' => 25,
                'target_peserta' => 'siswa',
                'tipe_harga' => 'per_orang',
                'margin' => 40,
                'fasilitas' => [
                    ['nama' => 'Edukasi lingkungan (pilah sampah & tanam pohon)'],
                    ['nama' => 'City light sore hari'],
                    ['nama' => 'Outbound ringan'],
                    ['nama' => 'Kuliner tradisional (makan siang & snack)'],
                ],
                'biaya' => [
                    ['nama' => 'Edukasi & workshop', 'jumlah' => 20000],
                    ['nama' => 'Bibit pohon', 'jumlah' => 10000],
                    ['nama' => 'Makan & snack', 'jumlah' => 35000],
                    ['nama' => 'Games & alat outbound', 'jumlah' => 15000],
                    ['nama' => 'Operasional & tim', 'jumlah' => 10000],
                ],
            ],
            [
                'id' => 5,
                'nama' => 'Kendeng Romantis (Couple Glamping)',
                'lokasi' => 'Glamping Area Kendeng, Pati',
                'gambar' => 'paket_wisata/romantis.jpg',
                'deskripsi' => '2D1N glamping romantis untuk pasangan, BBQ malam, musik akustik, citylight sore, dan tanam pohon sebagai simbol cinta.',
                'durasi' => '2D1N',
                'jumlah_orang' => 2,
                'minimal_peserta' => null,
                'target_peserta' => 'pasangan',
                'tipe_harga' => 'per_pasangan',
                'margin' => 40,
                'fasilitas' => [
                    ['nama' => 'Tenda privat'],
                    ['nama' => 'BBQ romantis'],
                    ['nama' => 'Pertunjukan kecil musik tradisional'],
                    ['nama' => 'Sarapan & makan malam'],
                    ['nama' => 'Aktivitas sore: city light & sunset view'],
                    ['nama' => 'Tanam pohon berdua (simbol cinta)'],
                ],
                'biaya' => [
                    ['nama' => 'Tenda privat + dekorasi', 'jumlah' => 150000],
                    ['nama' => 'Makanan & BBQ', 'jumlah' => 120000],
                    ['nama' => 'Musik & fasilitas', 'jumlah' => 50000],
                    ['nama' => 'Bibit pohon + dokumentasi', 'jumlah' => 30000],
                    ['nama' => 'Operasional', 'jumlah' => 30000],
                ],
            ],
        ];

        foreach ($tours as $data) {
            // Relasi biaya
            $biayaItems = $data['biaya'];
            unset($data['biaya']);

            // Relasi fasilitas
            $fasilitas = $data['fasilitas'] ?? []; // ❗ perbaiki $tour -> $data
            unset($data['fasilitas']);

            // Hitung harga_modal
            $hargaModal = collect($biayaItems)->sum('jumlah');
            $data['harga_modal'] = $hargaModal;
            $data['harga_jual'] = $hargaModal + ($hargaModal * $data['margin'] / 100);

            // Simpan paket
            $paket = PaketWisata::updateOrCreate(['id' => $data['id']], $data);

            // Insert biaya
            foreach ($biayaItems as $biaya) {
                PaketBiaya::updateOrCreate([
                    'paket_id' => $paket->id,
                    'nama' => $biaya['nama'],
                ], [
                    'jumlah' => $biaya['jumlah']
                ]);
            }

            // ✅ Insert fasilitas dengan benar
            foreach ($fasilitas as $item) {
                FasilitasPaket::updateOrCreate([
                    'paket_id' => $paket->id,
                    'nama' => $item['nama'],
                ]);
            }
        }
    }
}
