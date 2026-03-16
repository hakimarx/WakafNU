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
        \App\Models\User::factory()->create([
            'name' => 'Admin LWP PWNU Jatim',
            'email' => 'admin@lwpwnujatim.org',
            'password' => \Illuminate\Support\Facades\Hash::make('password'),
            'role' => 'admin',
        ]);

        // Sample Nadzir
        $nadzir = \App\Models\User::factory()->create([
            'name' => 'Nadzir Sholeh',
            'email' => 'nadzir@example.com',
            'password' => \Illuminate\Support\Facades\Hash::make('password'),
            'role' => 'nadzir',
        ]);

        // Sample Assets
        $asset1 = \App\Models\WaqfAsset::create([
            'name' => 'Tanah Wakaf Strategis Surabaya',
            'location' => 'Jl. Ahmad Yani, Surabaya',
            'area' => 500.00,
            'legality' => 'Sertifikat Wakaf BWI',
            'status' => 'available',
        ]);

        \App\Models\WaqfAsset::create([
            'name' => 'Lahan Pertanian Sidoarjo',
            'location' => 'Wonoayu, Sidoarjo',
            'area' => 2500.00,
            'legality' => 'Akta Ikrar Wakaf',
            'status' => 'assigned',
            'nadzir_id' => $nadzir->id,
        ]);

        // Sample Campaign
        \App\Models\Campaign::create([
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
