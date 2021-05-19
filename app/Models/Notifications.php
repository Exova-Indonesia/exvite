<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Notifications extends Model
{
    use SoftDeletes, HasFactory;
    protected $fillable = [
        'user_id',
        'icon',
        'body',
        'action_text',
        'action_url',
        'seen',
        'deleted_at',
    ];

    protected $dates = ['deleted_at'];
}
