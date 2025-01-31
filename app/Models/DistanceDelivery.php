<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DistanceDelivery extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'departure_city',
        'arrival_city',
        'transaction_date',
        'delivery_mode',
        'total_price',
        'status',
        'payment_details',
        'payment_method',
        'payment_status',
        'accepted',
        'driver_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function packageDetails()
    {
        return $this->hasMany(PackageDetail::class, 'delivery_id');
    }
}
