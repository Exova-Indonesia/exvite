<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

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
        $now = $this->where('studio_id', $this->studio_id)->whereDay('created_at', now()->day)->count();
        if($this->where('studio_id', $this->studio_id)->whereDay('created_at', now()->day - 1)->count() == 0) { 
            $yesterday = 0; 
            return  $now - $yesterday * 100;
        } else { 
            $yesterday = $this->where('studio_id', $this->studio_id)->whereDay('created_at', now()->day - 1)->count(); 
            return  $now - $yesterday / $yesterday * 100;
        }
    }
    public function setRevenueGrowth() {
        $now = $this->where('studio_id', $this->studio_id)->whereDay('created_at', now()->day)->sum('paid');
        if($this->where('studio_id', $this->studio_id)->whereDay('created_at', now()->day - 1)->sum('paid') == 0) { 
            $yesterday = 0; 
            return  $now - $yesterday * 100;
        } else { 
            $yesterday = $this->where('studio_id', $this->studio_id)->whereDay('created_at', now()->day - 1)->sum('paid'); 
            return  $now - $yesterday / $yesterday * 100;
        }
    }
    
    public function getRevenueStatistics()
    {
        return $this->where('studio_id', $this->studio_id)->get()
        ->groupBy(function ($val) {
            return Carbon::parse($val->created_at)->format('m');
        });
    }

    public function getLabels()
    {
        $labels = array();
        foreach($this->getRevenueStatistics() as $key=>$data) {
            $labels[] = $key;
        }
        return $labels;
    }

    public function getData()
    {
        $data = array();
        foreach($this->getRevenueStatistics() as $key=>$d) {
            $data[] = $d->count();
        }
        return $data;
    }
}
