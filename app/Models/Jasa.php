<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jasa extends Model
{
    use HasFactory;
    protected $table = 'jasa_products';
    protected $primaryKey = 'jasa_id';
    protected $fillable = [
        'jasa_id',
        'studio_id',
        'jasa_name',
        'jasa_subcategory',
        'jasa_deskripsi',
        'jasa_price',
        'jasa_price_old',
        'jasa_revision',
        'jasa_thumbnail',
        'jasa_status',
        'jasa_rating',
        'jasa_sold',
    ];
    public function subcategory() {
        return $this->belongsTo(SubCategory::class, 'jasa_subcategory');
    }

    public function seller() {
        return $this->belongsTo(Studio::class, 'studio_id');
    }

    public function revisi() {
        return $this->belongsTo(JasaRevision::class, 'jasa_revision');
    }

    public function additional() {
        return $this->hasMany(JasaAdditional::class, 'jasa_id');
    }

    public function pictures() {
        return $this->hasMany(JasaPicture::class, 'jasa_id');
    }
    public function cover() {
        return $this->belongsTo(JasaPicture::class, 'jasa_thumbnail');
    }
    public function diskusi() {
        return $this->hasMany(JasaDiskusi::class, 'jasa_id');
    }
    public function rating() {
        return $this->hasMany(JasaRating::class, 'jasa_id');
    }
}
