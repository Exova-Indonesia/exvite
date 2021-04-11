<?php 

use App\Models\Studio;

function studio()
{
    return Studio::where('user_id', auth()->user()->id)->first();
}


?>