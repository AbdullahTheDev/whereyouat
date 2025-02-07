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
        'manager',
        'availability_days',
        'time_from',
        'time_to',
        'ownership_proof',
        'terms_of_service'
    ];

    protected $casts = [
        'managers' => 'array'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
