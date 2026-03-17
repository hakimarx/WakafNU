<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('waqf_assets', function (Blueprint $table) {
            $table->text('description')->nullable()->after('legality');
            $table->string('city')->nullable()->after('location');
            $table->string('district')->nullable()->after('city');
            $table->string('commodity')->nullable()->after('description');         // e.g., Perkebunan Tebu
            $table->decimal('annual_revenue', 15, 2)->nullable()->after('commodity'); // annual revenue
            $table->integer('productive_years')->nullable()->after('annual_revenue'); // how long productive
            $table->text('benefit_usage')->nullable()->after('productive_years');  // where benefit goes
            $table->string('legal_status')->nullable()->after('benefit_usage');    // legal process status
            $table->string('managing_entity')->nullable()->after('legal_status');  // e.g., Panitia Tol
            $table->string('supervising_entity')->nullable()->after('managing_entity'); // e.g., Nazhir PCNU
            $table->decimal('original_area', 10, 2)->nullable()->after('area');   // original area before transformation
            $table->string('area_source')->nullable()->after('original_area');     // e.g., "Hasil Ruislag Tol"
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('waqf_assets', function (Blueprint $table) {
            $table->dropColumn([
                'description', 'city', 'district', 'commodity', 'annual_revenue',
                'productive_years', 'benefit_usage', 'legal_status', 'managing_entity',
                'supervising_entity', 'original_area', 'area_source',
            ]);
        });
    }
};
