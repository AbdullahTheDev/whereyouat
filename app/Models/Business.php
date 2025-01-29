<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Business extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'trade_name',
        'business_address',
        'business_number',
        'co_manager_details',
        'ownership_proof',
        'availability',
    ];

    protected $casts = [
        'co_manager_details' => 'array',
        'availability' => 'array',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
