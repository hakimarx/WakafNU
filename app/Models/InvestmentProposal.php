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
        'profit_sharing_nadzir',
        'profit_sharing_lwp',
        'term_sheet_path',
        'contract_digital_path',
        'signed_at',
    ];

    protected $casts = [
        'investment_value' => 'decimal:2',
        'profit_sharing_nadzir' => 'decimal:2',
        'profit_sharing_lwp' => 'decimal:2',
        'signed_at' => 'datetime',
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
