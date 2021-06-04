<?php 

// namespace App\Helpers;

use App\Models\Studio;
use App\Models\OrderJasa;
use App\Models\PaymentDetail;
use Illuminate\Support\Facades\Storage;

// function studio()
// {
//     return Studio::where('user_id', auth()->user()->id)->first();
// }

function storage($url)
{
    return url('storage/' . $url);
}

function dates($date)
{
    return date('Y-m-d', strtotime($date));
}

function date_inv($date)
{
    return date('Ymd', strtotime($date));
}

function parse_date($date)
{
    return date('F j, Y', strtotime($date));
}

function datetimes($date)
{
    return date('F j, Y h:i', strtotime($date));
}

function month($date)
{
    return date('F', strtotime($date));
}

function rupiah($amount)
{
    return 'Rp' . number_format($amount, 0);
}

function parse_rupiah($amount)
{
    return preg_replace(['/[Rp,.]/'],'', $amount);
}

function rating($sum, $count) {
    if($count == 0) { $count = 1; }
    return $sum / $count;
}

?>
