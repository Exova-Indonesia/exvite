<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PayMethod extends Model
{
    use HasFactory;
    protected $table = 'payments_method';
    protected $fillable = [
        'pm_id',
        'pm_name',
        'pm_description',
        'pm_icons',
    ];
}
