<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Driver extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'license_photo_front',
        'license_photo_back',
        'vehicle_make',
        'vehicle_model',
        'vehicle_year',
        'vehicle_plate',
        'vehicle_color',
        'vehicle_seats',
        'vehicle_photo',
        'services',
        'packages',
        'local_delivery_city',
    ];

    protected $casts = [
        'services' => 'array',
        'packages' => 'array',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
