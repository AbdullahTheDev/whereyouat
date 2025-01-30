<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PackageDetail extends Model
{
    use HasFactory;

    protected $timestamps = false;

    protected $fillable = [
        'delivery_id',
        'package_type',
        'qty',
    ];

    public function delivery()
    {
        return $this->belongsTo(DistanceDelivery::class);
    }
}
