<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Campaign extends Model
{
    use HasFactory;

    protected $fillable = [
        'waqf_asset_id',
        'title',
        'description',
        'goal_amount',
        'current_amount',
        'deadline',
        'image_path',
        'status',
    ];

    public function waqfAsset()
    {
        return $this->belongsTo(WaqfAsset::class);
    }
}
