<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudioLogo extends Model
{
    use HasFactory;
    protected $primaryKey = 'id';
    protected $table = 'studio_logo';
    protected $fillable = [
        'prefix',
        'folder',
        'user_id',
        'medium',
        'small',
        'large',
    ];
    protected $guarded = [];

    protected $attributes = [
        'small' => 'images/users/default.png',
        'medium' => 'images/users/default.png',
        'large' => 'images/users/default.png',
    ];
}
