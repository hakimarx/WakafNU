<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\WaqfAsset;
use App\Models\InvestmentProposal;
use App\Models\Campaign;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Livewire\Livewire;
use App\Livewire\Investor\InvestmentSubmission;
use App\Livewire\Nadzir\AssetRegistration;
use App\Livewire\DonationComponent;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class WakafCRUDTest extends TestCase
{
    use RefreshDatabase;

    public function test_investor_can_create_and_delete_proposal()
    {
        $investor = User::factory()->create(['role' => 'investor']);
        $asset = WaqfAsset::create([
            'name' => 'Test Asset',
            'location' => 'Test Loc',
            'area' => 100,
            'legality' => 'Test',
            'status' => 'available'
        ]);

        Storage::fake('public');
        $file = UploadedFile::fake()->create('plan.pdf', 100);

        Livewire::actingAs($investor)
            ->test(InvestmentSubmission::class)
            ->set('waqfAssetId', $asset->id)
            ->set('title', 'Project A')
            ->set('description', 'Desc A')
            ->set('investmentValue', 5000000)
            ->set('businessPlanFile', $file)
            ->call('submit')
            ->assertHasNoErrors()
            ->assertSee('Proposal investasi berhasil dikirim');

        $this->assertDatabaseHas('investment_proposals', [
            'title' => 'Project A',
            'investor_id' => $investor->id
        ]);

        $proposal = InvestmentProposal::first();

        Livewire::actingAs($investor)
            ->test(InvestmentSubmission::class)
            ->call('delete', $proposal->id)
            ->assertSee('Proposal berhasil dihapus');

        $this->assertDatabaseMissing('investment_proposals', ['id' => $proposal->id]);
    }

    public function test_nadzir_can_register_and_delete_asset()
    {
        $nadzir = User::factory()->create(['role' => 'nadzir']);

        Livewire::actingAs($nadzir)
            ->test(AssetRegistration::class)
            ->set('name', 'Kebun Baru')
            ->set('location', 'Malang')
            ->set('area', 500)
            ->set('legality', 'Sertifikat')
            ->call('store')
            ->assertHasNoErrors()
            ->assertSee('Aset baru berhasil didaftarkan');

        $this->assertDatabaseHas('waqf_assets', [
            'name' => 'Kebun Baru',
            'nadzir_id' => $nadzir->id
        ]);

        $asset = WaqfAsset::where('name', 'Kebun Baru')->first();

        Livewire::actingAs($nadzir)
            ->test(AssetRegistration::class)
            ->call('delete', $asset->id)
            ->assertSee('Aset berhasil dihapus');

        $this->assertDatabaseMissing('waqf_assets', ['id' => $asset->id]);
    }

    public function test_wakif_can_initiate_donation()
    {
        $wakif = User::factory()->create(['role' => 'wakif']);
        $asset = WaqfAsset::create([
            'name' => 'Asset for Campaign',
            'location' => 'Loc',
            'area' => 100,
            'legality' => 'Lgl',
            'status' => 'available'
        ]);
        
        $campaign = Campaign::create([
            'waqf_asset_id' => $asset->id,
            'title' => 'Bantu Masjid',
            'description' => 'Desc',
            'goal_amount' => 10000000,
            'current_amount' => 0,
            'deadline' => now()->addDays(10),
            'status' => 'active'
        ]);

        Livewire::actingAs($wakif)
            ->test(DonationComponent::class, ['campaignId' => $campaign->id])
            ->set('donorName', 'Wakif A')
            ->set('amount', 50000)
            ->call('donate')
            ->assertHasNoErrors();

        $this->assertDatabaseHas('donations', [
            'donor_name' => 'Wakif A',
            'amount' => 50000,
            'status' => 'pending'
        ]);
    }

    public function test_wakif_qris_payment_callback_updates_status()
    {
        $wakif = User::factory()->create(['role' => 'wakif']);
        $asset = WaqfAsset::create([
            'name' => 'Asset for Campaign QRIS',
            'location' => 'Loc QRIS',
            'area' => 100,
            'legality' => 'Lgl',
            'status' => 'available'
        ]);
        
        $campaign = Campaign::create([
            'waqf_asset_id' => $asset->id,
            'title' => 'Bantu Masjid QRIS',
            'description' => 'Desc',
            'goal_amount' => 10000000,
            'current_amount' => 0,
            'deadline' => now()->addDays(10),
            'status' => 'active'
        ]);

        Livewire::actingAs($wakif)
            ->test(DonationComponent::class, ['campaignId' => $campaign->id])
            ->set('donorName', 'Wakif B')
            ->set('amount', 75000)
            ->call('donate')
            ->assertHasNoErrors();

        $donation = \App\Models\Donation::where('donor_name', 'Wakif B')->first();
        $this->assertNotNull($donation);
        $this->assertEquals('pending', $donation->status);

        // Simulate Midtrans Webhook for QRIS (settlement)
        // Midtrans webhook reads JSON from request body normally, but \Midtrans\Notification parses php://input
        // Let's create a notification mock or just call the controller if it's testable, 
        // Or simply test the logic of updating campaign amount if status is settlement.
        
        // Since \Midtrans\Notification uses file_get_contents('php://input'), we might need to mock it
        // Or we can just build a JSON payload and post it to the callback route
        
        // Let's check if the callback route exists
        $payload = [
            'transaction_status' => 'settlement',
            'payment_type' => 'qris',
            'order_id' => $donation->external_id,
            'fraud_status' => 'accept',
            'gross_amount' => '75000.00',
            'transaction_id' => 'abc-123'
        ];

        $response = $this->postJson('/payments/callback', $payload);
        $response->assertStatus(200);

        // Verify Donation is updated
        $donation->refresh();
        $this->assertEquals('success', $donation->status);

        // Verify Campaign is updated
        $campaign->refresh();
        $this->assertEquals(75000, $campaign->current_amount);
    }
}
