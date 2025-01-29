<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PartnerHome extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'home_name',
        'home_address',
        'managers',
        'availability',
        'ownership_proof',
    ];

    protected $casts = [
        'managers' => 'array',
        'availability' => 'array',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
