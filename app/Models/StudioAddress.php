<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudioAddress extends Model
{
    use HasFactory;
    protected $primaryKey = 'id';
    protected $table = 'studio_address';
    protected $fillable = [
        'prefix',
        'folder',
        'studio_id',
        'address_name',
        'state',
        'city',
        'subdistrict',
        'village',
    ];
    public function province() {
        return $this->belongsTo(Province::class, 'state');
    }
    public function district() {
        return $this->belongsTo(District::class, 'city');
    }
    public function subdistrict() {
        return $this->belongsTo(SubDistrict::class, 'subdistrict');
    }
    public function village() {
        return $this->belongsTo(Village::class, 'village');
    }
}
