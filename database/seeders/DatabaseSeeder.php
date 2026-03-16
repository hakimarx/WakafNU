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

        // Sample Assets
        $asset1 = \App\Models\WaqfAsset::updateOrCreate([
            'name' => 'Tanah Wakaf Strategis Surabaya',
        ], [
            'name' => 'Tanah Wakaf Strategis Surabaya',
            'location' => 'Jl. Ahmad Yani, Surabaya',
            'area' => 500.00,
            'legality' => 'Sertifikat Wakaf BWI',
            'status' => 'available',
        ]);

        \App\Models\WaqfAsset::updateOrCreate([
            'name' => 'Lahan Pertanian Sidoarjo',
        ], [
            'name' => 'Lahan Pertanian Sidoarjo',
            'location' => 'Wonoayu, Sidoarjo',
            'area' => 2500.00,
            'legality' => 'Akta Ikrar Wakaf',
            'status' => 'assigned',
            'nadzir_id' => $nadzir->id,
        ]);

        // Sample Campaign
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
    }
}
