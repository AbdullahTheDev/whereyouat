<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VicinityDelivery extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'departure_address',
        'arrival_address',
        'transaction_date',
        'total_price',
        'status',
        'payment_status',
        'payment_details',
        'payment_method',
        'accepted',
        'driver_id' 
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function packageDetails()
    {
        return $this->hasMany(VicinityPackageDetail::class, 'delivery_id');
    }

    public function driver()
    {
        return $this->belongsTo(Driver::class);
    }
}
