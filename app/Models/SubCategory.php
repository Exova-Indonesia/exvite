<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubCategory extends Model
{
    use HasFactory;
    protected $table = 'subcategory';
    protected $primaryKey = 'id';

    protected $fillable = [];

    public function parent() {
        return $this->belongsTo(Category::class, 'category_id');
    }
}
