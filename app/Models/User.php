<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasFactory, Notifiable;
    
    protected $primaryKey = 'id';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'phone',
        'avatar',
        'password',
        'provider',
        'provider_id',
        'id',
        'subscription',
        'api_token',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'api_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    
    public function address() {
        return $this->hasOne(UserAddress::class, 'user_id');
    }
    public function carts() {
        return $this->hasMany(Cart::class, 'user_id');
    }
    public function activity() {
        return $this->hasMany(Activity::class, 'user_id');
    }
    public function sexType() {
        return $this->belongsTo(Sex::class, 'sex');
    }
    public function avatar() {
        return $this->hasOne(Avatar::class, 'user_id');
    }
    public function notif() {
        return $this->hasOne(UserNotif::class, 'user_id');
    }

}
