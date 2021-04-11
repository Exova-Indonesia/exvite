<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class OrderSuccess extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [
        'order_id',
        'studio_id',
        'amount',
        'service_fee',
        'paid',
    ];
    protected $dates = ['deleted_at'];

    public function setServiceFee() {
        return $this->service_fee = $this->amount * 0.05;
    }

    public function setPaid() {
        return $this->paid = $this->amount - $this->setServiceFee();
    }

    public function orders() {
        return $this->belongsTo(OrderJasa::class, 'order_id');
    }
    
    public function setGrowth() {
        $now = $this->whereDay('created_at', now()->day)->count();
        if($this->whereDay('created_at', now()->day - 1)->count() == 0) { 
            $yesterday = 0; 
            return  $now - $yesterday * 100;
        } else { 
            $yesterday = $this->whereDay('created_at', now()->day - 1)->count(); 
            return  $now - $yesterday / $yesterday * 100;
        }
    }
    public function setRevenueGrowth() {
        $now = $this->whereDay('created_at', now()->day)->sum('paid');
        if($this->whereDay('created_at', now()->day - 1)->sum('paid') == 0) { 
            $yesterday = 0; 
            return  $now - $yesterday * 100;
        } else { 
            $yesterday = $this->whereDay('created_at', now()->day - 1)->sum('paid'); 
            return  $now - $yesterday / $yesterday * 100;
        }
    }
}
