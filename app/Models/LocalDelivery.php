<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class LocalDelivery extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'id_photo',
        'proof_of_domicile',
        'means_of_transport',
        'transport_details',
        'availability_days',
        'availability_hours',
    ];

    protected $casts = [
        'transport_details' => 'array',
        'availability_days' => 'array',
        'availability_hours' => 'array',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
