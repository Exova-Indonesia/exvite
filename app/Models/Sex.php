<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sex extends Model
{
    use HasFactory;
    protected $table = 'user_sex';
    protected $primaryKey = 'sex_id';
}
