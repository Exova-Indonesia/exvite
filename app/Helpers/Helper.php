<?php 

use App\Models\Studio;

function studio()
{
    return Studio::where('user_id', auth()->user()->id)->first();
}

function dates($date)
{
    return date('Y-m-d', strtotime($date));
}

function parse_date($date)
{
    return date('F j, Y', strtotime($date));
}

function month($date)
{
    return date('F', strtotime($date));
}

function rupiah($amount)
{
    return 'Rp' . number_format($amount, 0);
}


?>