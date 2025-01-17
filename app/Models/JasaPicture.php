<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class JasaPicture extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'jasa_pictures';
    protected $primaryKey = 'id';
    protected $fillable = [
        'small',
        'large',
        'medium',
        'jasa_id',
        'deleted_at',
    ];

    protected $dates = ['deleted_at'];
}
