<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JasaRating extends Model
{
    use HasFactory;
    protected $table = 'jasa_rating';
    protected $fillable = [
        'user_id',
        'jasa_id',
        'rating',
        'content',
    ];

    public function users() {
        return $this->belongsTo(User::class, 'user_id');
    }
}
