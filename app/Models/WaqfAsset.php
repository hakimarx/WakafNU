<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WaqfAsset extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'location',
        'city',
        'district',
        'area',
        'original_area',
        'area_source',
        'legality',
        'description',
        'commodity',
        'annual_revenue',
        'productive_years',
        'benefit_usage',
        'legal_status',
        'managing_entity',
        'supervising_entity',
        'nadzir_id',
        'image_path',
        'status',
    ];

    protected $casts = [
        'area' => 'decimal:2',
        'original_area' => 'decimal:2',
        'annual_revenue' => 'decimal:2',
    ];

    public function nadzir()
    {
        return $this->belongsTo(User::class, 'nadzir_id');
    }

    public function campaigns()
    {
        return $this->hasMany(Campaign::class);
    }

    public function investmentProposals()
    {
        return $this->hasMany(InvestmentProposal::class);
    }
}
