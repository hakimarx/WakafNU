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

        \App\Models\WaqfAsset::create([
            'name' => 'Sentra Dapur MBG (Malang Raya)',
            'location' => 'Kec. Singosari, Malang (Dekat Akses Tol)',
            'city' => 'Malang',
            'district' => 'Singosari',
            'area' => 800.00,
            'legality' => 'Sertifikat Wakaf AIW',
            'status' => 'available',
            'category' => 'Commercial',
            'potential_uses' => ['Dapur MBG (Makan Bergizi Gratis)', 'Central Kitchen', 'Hub Logistik Makanan'],
            'description' => 'Lokasi strategis di Malang Utara dengan akses cepat ke kota dan kabupaten. Sangat cocok untuk pusat produksi makanan bergizi bagi jutaan siswa di Malang Raya.',
            'latitude' => -7.8938,
            'longitude' => 112.6661,
        ]);

        \App\Models\WaqfAsset::create([
            'name' => 'Kompleks Terpadu KUA & Madrasah (Ponorogo)',
            'location' => 'Pusat Kota Ponorogo',
            'city' => 'Ponorogo',
            'district' => 'Ponorogo',
            'area' => 1200.00,
            'legality' => 'Sertifikat Wakaf',
            'status' => 'available',
            'category' => 'Public Service',
            'potential_uses' => ['Kantor KUA', 'Madrasah Ibtidaiyah', 'Pusat Dakwah'],
            'description' => 'Aset wakaf di tengah pemukiman padat. Peluang kerjasama dengan Kemenag atau Yayasan Pendidikan untuk penyediaan fasilitas kantor layanan publik dan pendidikan.',
            'latitude' => -7.8671,
            'longitude' => 111.4658,
        ]);

        \App\Models\WaqfAsset::create([
            'name' => 'Perkebunan Pisang Cavendish (Blitar)',
            'location' => 'Kec. Srengat, Blitar',
            'city' => 'Blitar',
            'district' => 'Srengat',
            'area' => 50000.00,
            'legality' => 'Sertifikat Wakaf Tanpa Sengketa',
            'status' => 'available',
            'category' => 'Agribusiness',
            'potential_uses' => ['Kebun Pisang Cavendish', 'Export Oriented Farming', 'Edu-Wisata Pertanian'],
            'description' => 'Lahan luas dan subur dengan kontur yang sudah diratakan. Sangat potensial untuk budidaya komoditas ekspor seperti pisang Cavendish dengan sistem bagi hasil.',
            'latitude' => -8.1009,
            'longitude' => 112.0622,
        ]);

        \App\Models\WaqfAsset::create([
            'name' => 'Estate Tambak Udang Vaname (Sumenep)',
            'location' => 'Pesisir Pantai Selatan Sumenep',
            'city' => 'Sumenep',
            'district' => 'Saronggi',
            'area' => 35000.00,
            'legality' => 'Sertifikat Wakaf Aktif',
            'status' => 'available',
            'category' => 'Fishery',
            'potential_uses' => ['Tambak Udang Vaname', 'Pengolahan Hasil Laut', 'Cold Storage'],
            'description' => 'Lahan pesisir dengan kualitas air laut yang sangat baik untuk budidaya udang intensif. Terbuka untuk investor sektor perikanan dengan skema bagi hasil/sewa.',
            'latitude' => -7.0543,
            'longitude' => 113.8821,
        ]);

        \App\Models\WaqfAsset::create([
            'name' => 'Kawasan Industri Pabrik & Warehouse (Lumajang)',
            'location' => 'Dekat Jalur Lintas Selatan, Lumajang',
            'city' => 'Lumajang',
            'district' => 'Tempeh',
            'area' => 15000.00,
            'legality' => 'Sertifikat Wakaf',
            'status' => 'available',
            'category' => 'Industrial',
            'potential_uses' => ['Pabrik Kayu/Sengon', 'Gudang Distribusi', 'Stockpile'],
            'description' => 'Berada di jalur strategis distribusi Jawa Timur. Area industri yang sedang berkembang, cocok untuk pabrik pengolahan hasil bumi atau pusat logistik.',
            'latitude' => -8.1969,
            'longitude' => 113.2081,
        ]);
    }
}
