<?php 

use App\Models\Studio;
use App\Models\OrderJasa;
use App\Models\PaymentDetail;

function studio()
{
    return Studio::where('user_id', auth()->user()->id)->first();
}

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

function orderInvoice($id)
{
    $data = PaymentDetail::with('details.products.products.seller.address', 'details.products.products.subcategory', 'details.products.customer.address', 'details.additionals')->where('payment_id', $id)->first();
    $pdf = PDF::loadview('pdf.order', ['data' => $data])->setPaper('a4', 'potrait');
    $url = auth()->user()->id . '/' . 'invoices/orders' . '/' . date('Y') . '/' . date('F');
    $name = 'EX-' . $id . '-' . date('Y-m-d') . '.pdf';
    Storage::put($url . '/' . $name, $pdf->output());
    return $url . '/' . $name;
}


?>