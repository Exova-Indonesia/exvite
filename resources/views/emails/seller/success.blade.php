@extends('emails.layouts.app')
@section('content')
@if (! empty($order))
@component('mail::table')
<div>
    <h1 class="text-center text-exova text-capitalize amount">Status: {{ str_replace('_', ' ', $order->status) }}</h1>
</div>
<table>
    <tbody>
        <tr>
            <td>Nama Proyek</td>
            <td class="text-right text-capitalize font-weight-bold">{{ $order->products['jasa_name'] }}</td>
        </tr>
        <tr>
            <td>Pembeli</td>
            <td class="text-right text-capitalize font-weight-bold">{{ $order->customer['name'] }}</td>
        </tr>
        <tr>
            <td>Catatan</td>
            <td class="text-right font-weight-bold">{{ $order->note }}</td>
        </tr>
        @foreach($order->details['additionals'] as $add)
        <tr>
            <td>Layanan Tambahan</td>
            <td class="text-right font-weight-bold">{{ $add->quantity . ' X ' . $add->title }}</td>
        </tr>
        @endforeach
        <tr>
            <td>Pendapatan Kotor</td>
            <td class="text-right font-weight-bold">{{ $order->success['amount'] }}</td>
        </tr>
        <tr>
            <td>Pendapatan Bersih</td>
            <td class="text-right font-weight-bold">{{ $order->success['paid'] }}</td>
        </tr>
    </tbody>
</table>
@endcomponent
@endif
@endsection