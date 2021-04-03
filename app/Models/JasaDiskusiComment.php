<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JasaDiskusiComment extends Model
{
    use HasFactory;
    protected $table = 'jasa_diskusi_comment';
    protected $fillable = [
        'user_id',
        'diskusi_id',
        'content',
    ];

    public function comment_child() {
        return $this->hasMany(JasaDiskusiCommentChild::class, 'parent_id');
    }
    public function users() {
        return $this->belongsTo(User::class, 'user_id');
    }
}
