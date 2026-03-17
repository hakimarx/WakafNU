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
            $table->string('category')->nullable()->after('status'); // commercial, agricultural, educational, etc.
            $table->json('potential_uses')->nullable()->after('category'); // Array of items like ['Minimarket', 'Pabrik']
            $table->decimal('latitude', 10, 8)->nullable()->after('location');
            $table->decimal('longitude', 11, 8)->nullable()->after('location');
            $table->string('video_url')->nullable()->after('image_path');
        });

        Schema::table('investment_proposals', function (Blueprint $table) {
            $table->decimal('profit_sharing_nadzir', 5, 2)->nullable()->after('scheme');
            $table->decimal('profit_sharing_lwp', 5, 2)->nullable()->after('scheme');
            $table->string('term_sheet_path')->nullable()->after('business_plan_file_path');
            $table->string('contract_digital_path')->nullable()->after('term_sheet_path');
            $table->timestamp('signed_at')->nullable()->after('status');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('waqf_assets', function (Blueprint $table) {
            $table->dropColumn(['category', 'potential_uses', 'latitude', 'longitude', 'video_url']);
        });

        Schema::table('investment_proposals', function (Blueprint $table) {
            $table->dropColumn(['profit_sharing_nadzir', 'profit_sharing_lwp', 'term_sheet_path', 'contract_digital_path', 'signed_at']);
        });
    }
};
