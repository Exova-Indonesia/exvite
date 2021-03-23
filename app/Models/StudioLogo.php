<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudioLogo extends Model
{
    use HasFactory;
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
}
