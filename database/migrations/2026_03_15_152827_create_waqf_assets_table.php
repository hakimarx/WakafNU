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
        Schema::create('waqf_assets', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('location');
            $table->decimal('area', 10, 2); // in m2
            $table->string('legality'); // e.g., Sertifikat Wakaf
            $table->foreignId('nadzir_id')->nullable()->constrained('users');
            $table->string('image_path')->nullable();
            $table->string('status')->default('available'); // available, assigned, commercialized
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('waqf_assets');
    }
};
