<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InvestmentProposal extends Model
{
    use HasFactory;

    protected $fillable = [
        'investor_id',
        'waqf_asset_id',
        'title',
        'business_plan_description',
        'business_plan_file_path',
        'scheme',
        'investment_value',
        'status',
    ];

    public function investor()
    {
        return $this->belongsTo(User::class, 'investor_id');
    }

    public function waqfAsset()
    {
        return $this->belongsTo(WaqfAsset::class);
    }
}
