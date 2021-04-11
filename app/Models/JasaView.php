<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JasaView extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'jasa_id',
    ];

    public function setGrowth() {
        $now = $this->whereDay('created_at', now()->day)->count();
        if($this->whereDay('created_at', now()->day - 1)->count() == 0) { 
            $yesterday = 0; 
            return ($now - $yesterday) * 100;
        } else { 
            $yesterday = $this->whereDay('created_at', now()->day - 1)->count(); 
            return ($now - $yesterday) / $yesterday * 100;
        }
    }
}
