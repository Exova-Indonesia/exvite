<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    use HasFactory;
    protected $table = 'snap_activity';
    protected $fillable = [
        'activity_id',
        'user_id',
        'activity',
        'ip_address',
        'user_agent',
        'availability',
    ];
    public function users() {
        $this->belongsTo(User::class, 'user_id');
    }
}
