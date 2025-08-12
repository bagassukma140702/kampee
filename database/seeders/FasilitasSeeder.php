<?php

namespace Database\Seeders;

use App\Models\Fasilitas;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FasilitasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $fasilitas = [
            ['nama' => 'Homestay', 'deskripsi' => 'Penginapan nyaman dengan suasana lokal'],
            ['nama' => 'Kolam Renang', 'deskripsi' => 'Fasilitas kolam renang untuk tamu'],
            ['nama' => 'Barbeque', 'deskripsi' => 'Barbeque prasmanan atau dalam bentuk paket'],
            ['nama' => 'Pantry Umum', 'deskripsi' => 'Dapur bersama yang bisa digunakan pengunjung'],
            ['nama' => 'Live Musik dan Api Unggun', 'deskripsi' => 'Hiburan malam dengan musik dan api unggun'],
            ['nama' => 'Tanam Pohon', 'deskripsi' => 'Kegiatan menanam pohon untuk wisata edukatif'],
            ['nama' => 'Kegiatan Memilah Sampah', 'deskripsi' => 'Edukasi dan praktik memilah sampah'],
            ['nama' => 'Workshop Tentang Sampah', 'deskripsi' => 'Pelatihan pengelolaan sampah ramah lingkungan'],
            ['nama' => 'Makanan dan Minuman Khas Kabupaten Pati', 'deskripsi' => 'Kuliner lokal khas daerah Pati'],
            ['nama' => 'Café', 'deskripsi' => 'Tempat santai dengan berbagai minuman dan makanan ringan'],
            ['nama' => 'Tracking Air Terjun', 'deskripsi' => 'Petualangan menuju air terjun alami'],
            ['nama' => 'Mushola', 'deskripsi' => 'Tempat ibadah untuk pengunjung Muslim'],
            ['nama' => 'Sunset dan Sunrise', 'deskripsi' => 'Pemandangan indah matahari terbit dan terbenam'],
            ['nama' => 'Citylight', 'deskripsi' => 'Pemandangan lampu kota di malam hari'],
            ['nama' => 'Spot Foto Instagramable', 'deskripsi' => 'Lokasi-lokasi foto dengan latar menarik'],
            ['nama' => 'Toilet Umum', 'deskripsi' => 'Fasilitas toilet yang bersih dan terawat'],
            ['nama' => 'Glamping Reguler dan VIP', 'deskripsi' => 'Penginapan mewah di alam terbuka'],
            ['nama' => 'Taman Bermain Anak-anak', 'deskripsi' => 'Area bermain khusus anak'],
            ['nama' => 'Free Wi-Fi', 'deskripsi' => 'Akses internet gratis untuk pengunjung'],
            ['nama' => 'Outbond', 'deskripsi' => 'Kegiatan luar ruangan yang seru dan menantang'],
            ['nama' => 'Tour Guide', 'deskripsi' => 'Pemandu wisata yang siap membantu dan menjelaskan lokasi'],
        ];

        foreach ($fasilitas as $item) {
            Fasilitas::updateOrCreate(['nama' => $item['nama']], $item);
        }
    }
}
