<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VicinityPackageDetail extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'delivery_id',
        'package_type',
        'qty',
        'description'
    ];

    public function delivery()
    {
        return $this->belongsTo(VicinityDelivery::class);
    }
}
