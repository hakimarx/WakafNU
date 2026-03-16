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
        Schema::create('investment_proposals', function (Blueprint $table) {
            $table->id();
            $table->foreignId('investor_id')->constrained('users')->cascadeOnDelete();
            $table->foreignId('waqf_asset_id')->constrained()->cascadeOnDelete();
            $table->string('title');
            $table->text('business_plan_description');
            $table->string('business_plan_file_path')->nullable();
            $table->string('scheme'); // BOT, Mudharabah, Musyarakah, Sewa
            $table->decimal('investment_value', 15, 2);
            $table->string('status')->default('pending'); // pending, reviewing, accepted, rejected
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('investment_proposals');
    }
};
