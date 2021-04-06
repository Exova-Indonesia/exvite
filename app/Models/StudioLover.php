<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class StudioLover extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [
        'user_id',
        'studio_id',
        'deleted_at'
    ];
    protected $dates = ['deleted_at'];
}
