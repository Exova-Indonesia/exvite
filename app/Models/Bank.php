<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bank extends Model
{
    use HasFactory;
    protected $table = 'user_banks';
    protected $fillable = [
        'bank_id',
        'bank_code',
        'bank_user',
        'bank_account',
        'user_id',
    ];
    public function banks() {
        //
    }
}
