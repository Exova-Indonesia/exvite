<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudioPoint extends Model
{
    use HasFactory;
    protected $fillable = [
        'studio_id',
        'value',
        'source',
    ];
    protected $dates = ['deleted_at'];
}
