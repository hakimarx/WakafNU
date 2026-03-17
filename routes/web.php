<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', \App\Livewire\LandingPage::class);
Route::get('/campaign/{id}', \App\Livewire\CampaignDetail::class)->name('campaign.detail');
Route::get('/wakaf/status/{externalId}', function (string $externalId) {
    $donation = \App\Models\Donation::with('campaign')
        ->where('external_id', $externalId)
        ->firstOrFail();

    return view('donation-status', compact('donation'));
})->name('donation.status');
Route::post('/payments/callback', [\App\Http\Controllers\PaymentController::class, 'callback']);

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::get('/register-nadzir', \App\Livewire\NadzirRegistration::class)->name('nadzir.register');
    Route::get('/donations', \App\Livewire\DonationHistory::class)->name('donation.history');

    // Investor Routes
    Route::get('/investor/catalog', \App\Livewire\Investor\AssetCatalog::class)->name('investor.catalog');
    Route::get('/investor/submit', \App\Livewire\Investor\InvestmentSubmission::class)->name('investor.submit');
});
