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
        'user_id',
        'jasa_name',
        'jasa_subcategory',
        'jasa_deskripsi',
        'jasa_price',
        'jasa_price_old',
        'jasa_revisiion',
        'jasa_thumbnail',
        'jasa_status',
        'jasa_rating',
        'jasa_sold',
    ];
    public function seller() {
        return $this->belongsTo(User::class, 'user_id');
    }
}
