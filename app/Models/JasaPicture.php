<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JasaPicture extends Model
{
    use HasFactory;
    protected $table = 'jasa_pictures';
    protected $primaryKey = 'id';
    protected $fillable = [
        'small',
        'large',
        'medium',
        'jasa_id',
    ];
}
