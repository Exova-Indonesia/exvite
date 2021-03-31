<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Studio extends Model
{
    use HasFactory;
    protected $primaryKey = 'id';
    protected $fillable = [
        'prefix',
        'user_id',
        'name',
        'description',
        'address_id',
        'logo_id',
        'is_complete',
        'slogan',
        'suspend',
    ];

    public function portfolio() {
        return $this->hasMany(Jasa::class, 'user_id');
    }
    
    public function logo() {
        return $this->belongsTo(StudioLogo::class, 'logo_id');
    }

    public function owner() {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function address() {
        return $this->hasOne(StudioAddress::class, 'studio_id');
    }
}
