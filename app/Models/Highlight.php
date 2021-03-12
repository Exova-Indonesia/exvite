<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Highlight extends Model
{
    use HasFactory;
    protected $table = 'highlight_products';
    public function product() {
        return $this->belongsTo(Jasa::class, 'product_id');
    }
}