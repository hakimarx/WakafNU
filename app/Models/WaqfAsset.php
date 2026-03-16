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
        'area',
        'legality',
        'nadzir_id',
        'image_path',
        'status',
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
