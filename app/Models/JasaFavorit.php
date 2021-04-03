<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JasaFavorit extends Model
{
    use HasFactory;
    protected $table = 'user_jasa_favorit';
    protected $fillable = [
        'user_id',
        'jasa_id',
    ];
}
