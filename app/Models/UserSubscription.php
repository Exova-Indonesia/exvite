<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserSubscription extends Model
{
    use HasFactory;
    protected $table = 'user_subscription';
    protected $primaryKey = 'subscription_id';
    public function plan() {
        return $this->belongsTo(Subscription::class, 'plan_id');
    }
}
