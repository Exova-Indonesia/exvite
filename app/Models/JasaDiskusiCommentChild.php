<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JasaDiskusiCommentChild extends Model
{
    use HasFactory;
    protected $table = 'jasa_diskusi_comment_child';
    protected $fillable = [
        'user_id',
        'parent_id',
        'jasa_id',
        'content',
    ];
    public function users() {
        return $this->belongsTo(User::class, 'user_id');
    }
}
