<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class StudioVisitor extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'studio_id',
    ];

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
    
    public function users()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function setByGender($sex)
    {
        // return $this->getSex($sex) / $this->getTotalSex()  * 100;
    }

    public function getSex($sex)
    {
        return $this->withCount(['users' => function($q) use($sex) {
            $q->where('sex', $sex);
        }])->where('studio_id', $this->studio_id)->get()->sum('users_count');
    }

    public function getTotalSex()
    {
        return $this->withCount(['users' => function($q) {
            $q->whereNotNull('sex');
        }])->where('studio_id', $this->studio_id)->get()->sum('users_count');
    }

    public function getVisitorsStatistics()
    {
        return $this->where('studio_id', $this->studio_id)
        ->whereBetween('created_at', [now()->subMonth(), now()->addDays(7)])
        ->orderBy('created_at')
        ->get()
        ->groupBy(function ($val) {
            return Carbon::parse($val->created_at)->format('d');
        });
    }

    public function getLabels()
    {
        $labels = array();
        foreach($this->getVisitorsStatistics() as $key=>$data) {
            $labels[] = $key;
        }
        return $labels;
    }

    public function getData()
    {
        $data = array();
        foreach($this->getVisitorsStatistics() as $key=>$d) {
            $data[] = $d->count();
        }
        return $data;
    }
}
