<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NadzirCertification extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'ktp_path',
        'certificate_path',
        'status',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
