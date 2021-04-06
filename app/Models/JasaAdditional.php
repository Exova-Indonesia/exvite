<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JasaAdditional extends Model
{
    use HasFactory;
    protected $table = 'jasa_additional';
    protected $primaryKey = 'id';
    protected $fillable = [
        'title',
        'jasa_id',
        'price',
        'add_day',
        'quantity',
        'type',
    ];
}
