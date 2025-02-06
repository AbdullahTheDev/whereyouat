<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class LocalDriver extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'user_id',
        'walk',
        'mean_of_transport',
        'vehicle_make',
        'vehicle_model',
        'vehicle_year',
        'vehicle_plate',
        'vehicle_color',
        'city',
        'address',
        'availability',
        'time_from',
        'time_to'
    ];
    
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
