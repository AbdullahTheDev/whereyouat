<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'phone',
        'date_of_birth',
        'password',
        'role',
        'terms_approved',
        'created_at',
        'updated_at'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function driver(): HasOne
    {
        return $this->hasOne(Driver::class);
    }
    public function localDriver(): HasOne
    {
        return $this->hasOne(LocalDriver::class);
    }

    public function localDelivery(): HasOne
    {
        return $this->hasOne(LocalDelivery::class);
    }

    public function business(): HasOne
    {
        return $this->hasOne(Business::class);
    }

    public function partnerHome(): HasOne
    {
        return $this->hasOne(PartnerHome::class);
    }

    public function userProfile()
    {
        return $this->hasOne(UserProfile::class);
    }
}
