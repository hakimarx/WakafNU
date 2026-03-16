<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\WaqfAsset;
use App\Models\InvestmentProposal;
use App\Models\Campaign;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Livewire\Livewire;
use App\Livewire\Admin\WaqfAssetManager;
use App\Livewire\Investor\InvestmentSubmission;
use App\Livewire\Nadzir\AssetRegistration;
use App\Livewire\DonationComponent;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class WakafCRUDTest extends TestCase
{
    use RefreshDatabase;

    public function test_investor_can_create_update_and_delete_proposal()
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
        Storage::disk('public')->assertExists($proposal->business_plan_file_path);

        Livewire::actingAs($investor)
            ->test(InvestmentSubmission::class)
            ->call('edit', $proposal->id)
            ->set('title', 'Project A Revised')
            ->set('description', 'Desc A Revised')
            ->set('investmentValue', 9000000)
            ->call('submit')
            ->assertHasNoErrors()
            ->assertSee('Proposal investasi berhasil diperbarui');

        $this->assertDatabaseHas('investment_proposals', [
            'id' => $proposal->id,
            'title' => 'Project A Revised',
            'investment_value' => 9000000,
        ]);

        Livewire::actingAs($investor)
            ->test(InvestmentSubmission::class)
            ->call('delete', $proposal->id)
            ->assertSee('Proposal berhasil dihapus');

        $this->assertDatabaseMissing('investment_proposals', ['id' => $proposal->id]);
    }

    public function test_admin_can_create_update_and_delete_asset()
    {
        $admin = User::factory()->create(['role' => 'admin']);

        Livewire::actingAs($admin)
            ->test(WaqfAssetManager::class)
            ->set('name', 'Aset Admin')
            ->set('location', 'Surabaya')
            ->set('area', 250)
            ->set('legality', 'Sertifikat Wakaf')
            ->call('save')
            ->assertHasNoErrors()
            ->assertSee('Asset created successfully.');

        $asset = WaqfAsset::where('name', 'Aset Admin')->first();

        Livewire::actingAs($admin)
            ->test(WaqfAssetManager::class)
            ->call('edit', $asset->id)
            ->set('name', 'Aset Admin Revisi')
            ->set('location', 'Sidoarjo')
            ->call('save')
            ->assertHasNoErrors()
            ->assertSee('Asset updated successfully.');

        $this->assertDatabaseHas('waqf_assets', [
            'id' => $asset->id,
            'name' => 'Aset Admin Revisi',
            'location' => 'Sidoarjo',
        ]);

        Livewire::actingAs($admin)
            ->test(WaqfAssetManager::class)
            ->call('delete', $asset->id)
            ->assertSee('Asset deleted successfully.');

        $this->assertDatabaseMissing('waqf_assets', ['id' => $asset->id]);
    }

    public function test_nadzir_can_register_update_and_delete_asset()
    {
        $nadzir = User::factory()->create(['role' => 'nadzir']);

        Livewire::actingAs($nadzir)
            ->test(AssetRegistration::class)
            ->set('name', 'Kebun Baru')
            ->set('location', 'Malang')
            ->set('area', 500)
            ->set('legality', 'Sertifikat')
            ->call('save')
            ->assertHasNoErrors()
            ->assertSee('Aset baru berhasil didaftarkan');

        $this->assertDatabaseHas('waqf_assets', [
            'name' => 'Kebun Baru',
            'nadzir_id' => $nadzir->id
        ]);

        $asset = WaqfAsset::where('name', 'Kebun Baru')->first();

        Livewire::actingAs($nadzir)
            ->test(AssetRegistration::class)
            ->call('edit', $asset->id)
            ->set('location', 'Batu')
            ->set('area', 650)
            ->call('save')
            ->assertHasNoErrors()
            ->assertSee('Data aset berhasil diperbarui.');

        $this->assertDatabaseHas('waqf_assets', [
            'id' => $asset->id,
            'location' => 'Batu',
            'area' => 650,
        ]);

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

    public function test_guest_can_initiate_public_wakaf_payment()
    {
        config()->set('services.pakasir.project_slug', 'lwp-pwnu-jatim');
        config()->set('services.pakasir.qris_only', true);

        $asset = WaqfAsset::create([
            'name' => 'Asset Public Wakaf',
            'location' => 'Surabaya',
            'area' => 120,
            'legality' => 'Sertifikat',
            'status' => 'available'
        ]);

        $campaign = Campaign::create([
            'waqf_asset_id' => $asset->id,
            'title' => 'Wakaf Publik',
            'description' => 'Campaign publik',
            'goal_amount' => 1000000,
            'current_amount' => 0,
            'deadline' => now()->addDays(30),
            'status' => 'active'
        ]);

        Livewire::test(DonationComponent::class, ['campaignId' => $campaign->id])
            ->set('donorName', 'Wakif Publik')
            ->set('amount', 100000)
            ->call('donate')
            ->assertHasNoErrors()
            ->assertDispatched('redirect-to-payment');

        $donation = \App\Models\Donation::where('campaign_id', $campaign->id)->first();

        $this->assertNotNull($donation);
        $this->assertNull($donation->user_id);
        $this->assertStringContainsString('https://app.pakasir.com/pay/lwp-pwnu-jatim/100000', $donation->snap_token);
        $this->assertStringContainsString(route('donation.status', $donation->external_id), urldecode($donation->snap_token));
    }

    public function test_investor_sees_clear_message_when_no_assets_are_available()
    {
        $investor = User::factory()->create(['role' => 'investor']);

        Livewire::actingAs($investor)
            ->test(InvestmentSubmission::class)
            ->assertSee('Belum ada aset berstatus tersedia');
    }

    public function test_public_donation_status_page_can_be_rendered()
    {
        $asset = WaqfAsset::create([
            'name' => 'Asset Status',
            'location' => 'Gresik',
            'area' => 100,
            'legality' => 'AIW',
            'status' => 'available'
        ]);

        $campaign = Campaign::create([
            'waqf_asset_id' => $asset->id,
            'title' => 'Program Status',
            'description' => 'Program status publik',
            'goal_amount' => 1000000,
            'current_amount' => 0,
            'deadline' => now()->addDays(30),
            'status' => 'active'
        ]);

        $donation = \App\Models\Donation::create([
            'external_id' => 'WKF-STATUS-001',
            'campaign_id' => $campaign->id,
            'donor_name' => 'Wakif Status',
            'amount' => 150000,
            'status' => 'pending',
        ]);

        $this->get(route('donation.status', $donation->external_id))
            ->assertOk()
            ->assertSee('WKF-STATUS-001')
            ->assertSee('Wakif Status');
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
