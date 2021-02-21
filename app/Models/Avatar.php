<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Avatar extends Model
{
    use HasFactory;
    protected $table = 'user_avatar';
    protected $fillable = [
        'user_id',
        'medium',
        'small',
        'large',
    ];
    protected $guarded = [];
}
