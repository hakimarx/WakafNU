<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Admin LWP PWNU
        \App\Models\User::updateOrCreate([
            'email' => 'admin@lwpwnujatim.org',
        ], [
            'name' => 'Admin LWP PWNU Jatim',
            'password' => \Illuminate\Support\Facades\Hash::make('password'),
            'role' => 'admin',
        ]);

        // Sample Nadzir
        $nadzir = \App\Models\User::updateOrCreate([
            'email' => 'nadzir@example.com',
        ], [
            'name' => 'Nadzir Sholeh',
            'password' => \Illuminate\Support\Facades\Hash::make('password'),
            'role' => 'nadzir',
        ]);

        // Nadzir PCNU Kota Kediri
        $nadzirKediri = \App\Models\User::updateOrCreate([
            'email' => 'nadzir.kediri@pcnukotakediri.org',
        ], [
            'name' => 'Nazhir Perkumpulan NU Kota Kediri',
            'password' => \Illuminate\Support\Facades\Hash::make('password'),
            'role' => 'nadzir',
        ]);

        // Sample Investor
        \App\Models\User::updateOrCreate([
            'email' => 'investor@example.com',
        ], [
            'name' => 'Investor Budiman',
            'password' => \Illuminate\Support\Facades\Hash::make('password'),
            'role' => 'investor',
        ]);

        // Sample Wakif
        \App\Models\User::updateOrCreate([
            'email' => 'wakif@example.com',
        ], [
            'name' => 'Wakif Amanah',
            'password' => \Illuminate\Support\Facades\Hash::make('password'),
            'role' => 'wakif',
        ]);

        // =====================================================================
        // ASET WAKAF 1: Tanah Wakaf Strategis Surabaya
        // =====================================================================
        $asset1 = \App\Models\WaqfAsset::updateOrCreate([
            'name' => 'Tanah Wakaf Strategis Surabaya',
        ], [
            'name' => 'Tanah Wakaf Strategis Surabaya',
            'location' => 'Jl. Ahmad Yani, Surabaya',
            'city' => 'Surabaya',
            'area' => 500.00,
            'legality' => 'Sertifikat Wakaf BWI',
            'status' => 'available',
        ]);

        // =====================================================================
        // ASET WAKAF 2: Lahan Pertanian Sidoarjo
        // =====================================================================
        \App\Models\WaqfAsset::updateOrCreate([
            'name' => 'Lahan Pertanian Sidoarjo',
        ], [
            'name' => 'Lahan Pertanian Sidoarjo',
            'location' => 'Wonoayu, Sidoarjo',
            'city' => 'Sidoarjo',
            'area' => 2500.00,
            'legality' => 'Akta Ikrar Wakaf',
            'status' => 'assigned',
            'nadzir_id' => $nadzir->id,
        ]);

        // =====================================================================
        // ASET WAKAF 3: Wakaf Produktif Masjid Darussalam - Kota Kediri
        // Sumber: Infografis LWP PCNU Kota Kediri
        // =====================================================================
        $assetKediri = \App\Models\WaqfAsset::updateOrCreate([
            'name' => 'Wakaf Produktif Masjid Darussalam',
        ], [
            'name' => 'Wakaf Produktif Masjid Darussalam',
            'location' => 'Ngadiluwih, Kabupaten Kediri',
            'city' => 'Kediri',
            'district' => 'Ngadiluwih',
            'area' => 12200.00,
            'original_area' => 3260.00,
            'area_source' => 'Hasil Ruislag Tol (PSN)',
            'legality' => 'Dalam proses balik nama ke BHPNU',
            'description' => 'Dari 3.200 m2 menjadi 12.200 m2 — Bukti pengelolaan wakaf yang amanah dan progresif! '
                . 'Lahan lama berlokasi di Kabupaten Kediri dengan luas 3.260 m2. '
                . 'Lahan baru hasil Ruislag Tol berlokasi di Ngadiluwih, Kab. Kediri dengan luas ± 12.200 m2. '
                . 'Dengan aset yang meluas hampir 4 kali lipat, LWP PCNU Kota Kediri berkomitmen menjadikan lahan ini '
                . 'sebagai role model Wakaf Produktif yang berkelanjutan untuk mendukung kemandirian organisasi '
                . 'dan kesejahteraan umat di Kediri Raya.',
            'commodity' => 'Perkebunan Tebu',
            'annual_revenue' => 26000000.00,
            'productive_years' => 2,
            'benefit_usage' => 'Manfaat ekonomi digunakan untuk kemaslahatan umat dan operasional Masjid Darussalam',
            'legal_status' => 'Dalam proses balik nama ke Badan Hukum Perkumpulan Nahdlatul Ulama (BHPNU)',
            'managing_entity' => 'Panitia Tol (sebagai bagian dari kompensasi PSN)',
            'supervising_entity' => 'Nazhir Perkumpulan NU Kota Kediri',
            'nadzir_id' => $nadzirKediri->id,
            'status' => 'commercialized',
        ]);

        // =====================================================================
        // CAMPAIGN
        // =====================================================================
        \App\Models\Campaign::updateOrCreate([
            'title' => 'Pembangunan Ruko Produktif LWP',
        ], [
            'waqf_asset_id' => $asset1->id,
            'title' => 'Pembangunan Ruko Produktif LWP',
            'description' => 'Crowdfunding untuk pembangunan unit ruko di atas tanah wakaf strategis guna kemandirian umat.',
            'goal_amount' => 500000000,
            'current_amount' => 0,
            'deadline' => now()->addMonths(6),
            'status' => 'active',
        ]);

        // Campaign for Wakaf Produktif Kediri
        \App\Models\Campaign::updateOrCreate([
            'title' => 'Pengembangan Wakaf Produktif Masjid Darussalam Kediri',
        ], [
            'waqf_asset_id' => $assetKediri->id,
            'title' => 'Pengembangan Wakaf Produktif Masjid Darussalam Kediri',
            'description' => 'Pengembangan lahan wakaf produktif seluas 12.200 m2 di Ngadiluwih, Kediri. '
                . 'Saat ini dikelola sebagai perkebunan tebu dengan pendapatan Rp 26 juta/tahun. '
                . 'Dana akan digunakan untuk diversifikasi komoditas dan infrastruktur produktif.',
            'goal_amount' => 200000000,
            'current_amount' => 0,
            'deadline' => now()->addMonths(12),
            'status' => 'active',
        ]);
    }
}
