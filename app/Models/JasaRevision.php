<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JasaRevision extends Model
{
    use HasFactory;
    protected $table = 'jasa_revision';
    protected $primaryKey = 'id';
    protected $fillable = [
        'count',
        'id',
        'price',
        'add_day',
    ];
}
