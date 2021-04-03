<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JasaDiskusi extends Model
{
    use HasFactory;
    protected $table = 'jasa_diskusi';
    protected $fillable = [
        'user_id',
        'jasa_id',
        'content',
    ];

    public function comment() {
        return $this->hasMany(JasaDiskusiComment::class, 'diskusi_id');
    }

    public function users() {
        return $this->belongsTo(User::class, 'user_id');
    }
}
