<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class StudioLover extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [
        'customer_id',
        'studio_id',
        'deleted_at'
    ];
    protected $dates = ['deleted_at'];

    public function setGrowth() {
        $now = $this->where('studio_id', $this->studio_id)->whereDay('created_at', now()->day)->count();
        if($this->where('studio_id', $this->studio_id)->whereDay('created_at', now()->day - 1)->count() == 0) { 
            $yesterday = 0; 
            return  $now - $yesterday * 100;
        } else { 
            $yesterday = $this->where('studio_id', $this->studio_id)->whereDay('created_at', now()->day - 1)->count(); 
            return  $now - $yesterday / $yesterday * 100;
        }
    }

    public function setGone() {
        $now = $this->where([['studio_id', $this->studio_id], ['deleted_at', '!=', null]])->whereDay('created_at', now()->day)->count();
        if($this->where([['studio_id', $this->studio_id], ['deleted_at', '!=', null]])->whereDay('created_at', now()->day - 1)->count() == 0) { 
            $yesterday = 0; 
            return  $now - $yesterday * 100;
        } else { 
            $yesterday = $this->where([['studio_id', $this->studio_id], ['deleted_at', '!=', null]])->whereDay('created_at', now()->day - 1)->count(); 
            return  $now - $yesterday / $yesterday * 100;
        }
    }
}
