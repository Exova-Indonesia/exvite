<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
class Jasa extends Model
{
    use HasFactory, SoftDeletes;
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
        'jasa_rating',
        'jasa_sold',
        'deleted_at',
    ];

    protected $dates = ['deleted_at'];

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

    public function videos() {
        return $this->hasMany(JasaVideos::class, 'jasa_id');
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

    public function views() {
        return $this->hasMany(JasaView::class, 'jasa_id');
    }

    public function getViews() {
        return $this->views()->count();
    }

    public function setGrowth() {
        $now = $this->where('studio_id', $this->studio_id)->whereDay('created_at', now()->day)->count();
        if($this->where('studio_id', $this->studio_id)->whereDay('created_at', now()->day - 1)->count() == 0) { 
            $yesterday = 0; 
            return  $now - $yesterday * 100;
        } else { 
            $yesterday = $this->where('studio_id', $this->studio_id)->whereDay('created_at', now()->day - 1)->count(); 
            return  $now - $yesterday / $yesterday * 100;
        }
    }
}
