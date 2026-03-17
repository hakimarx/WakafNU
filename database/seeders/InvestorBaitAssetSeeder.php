<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class InvestorBaitAssetSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\WaqfAsset::create([
            'name' => 'Lahan Strategis Dapur MBG (Gresik City)',
            'location' => 'Kec. Manyar, Gresik (Dekat Kawasan Industri & Sekolah)',
            'city' => 'Gresik',
            'district' => 'Manyar',
            'area' => 500.00,
            'legality' => 'Sertifikat Wakaf AIW',
            'status' => 'available',
            'category' => 'Commercial',
            'potential_uses' => ['Dapur MBG (Makan Bergizi Gratis)', 'Catering Sehat', 'Food Court'],
            'description' => 'Lahan sangat strategis di jalur utama, cocok untuk pusat pengolahan makanan bergizi guna mensuplai program pemerintah (MBG) bagi sekolah-sekolah sekitar.',
            'latitude' => -7.1518,
            'longitude' => 112.6318,
        ]);

        \App\Models\WaqfAsset::create([
            'name' => 'Kawasan Wisata Pemancingan Keluarga (Sidoarjo)',
            'location' => 'Desa Prasung, Buduran',
            'city' => 'Sidoarjo',
            'district' => 'Buduran',
            'area' => 2500.00,
            'legality' => 'Sertifikat Wakaf',
            'status' => 'available',
            'category' => 'Tourism',
            'potential_uses' => ['Pemancingan', 'Resto Apung', 'Wisata Edukasi'],
            'description' => 'Lahan subur dengan sumber air melimpah. Sangat potensial untuk dikembangkan menjadi destinasi wisata keluarga berbasis kolam pancing dan kuliner.',
            'latitude' => -7.4239,
            'longitude' => 112.7523,
        ]);

        \App\Models\WaqfAsset::create([
            'name' => 'Ruko Pojok Strategis (Surabaya Selatan)',
            'location' => 'Jl. Ahmad Yani, Gayungan',
            'city' => 'Surabaya',
            'district' => 'Gayungan',
            'area' => 150.00,
            'legality' => 'Sertifikat Wakaf AIW',
            'status' => 'available',
            'category' => 'Retail',
            'potential_uses' => ['Minimarket', 'Apotek 24 Jam', 'Kedai Kopi'],
            'description' => 'Terletak di hook jalan utama Surabaya. Traffic sangat tinggi, sangat cocok untuk usaha ritel seperti minimarket atau outlet franchise.',
            'latitude' => -7.3312,
            'longitude' => 112.7275,
        ]);

        \App\Models\WaqfAsset::create([
            'name' => 'Lahan Industri Terpadu (Pasuruan)',
            'location' => 'Kawasan Industri PIER, Rembang',
            'city' => 'Pasuruan',
            'district' => 'Rembang',
            'area' => 10000.00,
            'legality' => 'Sertifikat Wakaf',
            'status' => 'available',
            'category' => 'Industrial',
            'potential_uses' => ['Pabrik Pengolahan', 'Gudang Logistik', 'Bengkel Alat Berat'],
            'description' => 'Lahan luas di dalam/sekitar kawasan industri. Akses kontainer 40ft. Ideal untuk investor yang ingin membangun fasilitas manufaktur atau pergudangan.',
            'latitude' => -7.6046,
            'longitude' => 112.8362,
        ]);
    }
}
