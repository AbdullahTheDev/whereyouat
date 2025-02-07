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
        'responsible_name',
        'responsible_email',
        'responsible_phone',
        'responsible_dob',
        'responsible_address',
        'business_email',
        'business_phone',
        'business_address',
        'business_number',
        'availability_days',
        'time_from',
        'time_to',
        'co_manager_details',
        'ownership_proof',
        'general_terms',
        'password',
    ];

    protected $casts = [
        'co_manager_details' => 'array'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
