@extends('emails.layouts.app')
@section('content')
@if (! empty($order))
@component('mail::table')
<div>
    <h1 class="text-center text-exova text-capitalize amount">{{ rupiah($order->total) }}</h1>
</div>
<table>
    <tbody>
        <tr>
            <td>Status Pembayaran</td>
            <td class="text-right text-capitalize font-weight-bold">{{ str_replace('_', ' ', $order->status) }}</td>
        </tr>
        <tr>
            <td>Metode Pembayaran</td>
            <td class="text-right text-capitalize font-weight-bold">{{ $method }}</td>
        </tr>
        <tr>
            <td>Total</td>
            <td class="text-right text-capitalize font-weight-bold">{{ rupiah($order->total) }}</td>
        </tr>
        <tr>
            <td>Subtotal</td>
            <td class="text-right text-capitalize font-weight-bold">{{ rupiah($order->amount) }}</td>
        </tr>
        <tr>
            <td>Biaya Admin</td>
            <td class="text-right font-weight-bold">{{ rupiah($order->admin_fee) }}</td>
        </tr>
        <tr>
            <td>Discount</td>
            <td class="text-right font-weight-bold">{{ rupiah($order->discount) }}</td>
        </tr>
        @if($order->status == 'pending')
        <tr>
            <td>Batas Waktu</td>
            <td class="text-right font-weight-bold">{{ datetimes(now()->addDays(1)) }}</td>
        </tr>
        @endif
    </tbody>
</table>
@endcomponent
@endif
@endsection