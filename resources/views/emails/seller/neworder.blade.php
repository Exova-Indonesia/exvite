@extends('emails.layouts.app')
@section('content')
@if (! empty($order))
@component('mail::table')
<div>
    <h1 class="text-center text-exova amount">Batas Waktu: {{ parse_date($order->products['batal_otomatis']) }}</h1>
</div>
<table>
    <tbody>
        <tr>
            <td>Nama Proyek</td>
            <td class="text-right text-capitalize font-weight-bold">{{ $order->products['products']['jasa_name'] }}</td>
        </tr>
        <tr>
            <td>Pembeli</td>
            <td class="text-right text-capitalize font-weight-bold">{{ $order->products['customer']['name'] }}</td>
        </tr>
        <tr>
            <td>Catatan</td>
            <td class="text-right font-weight-bold">{{ $order->products['note'] }}</td>
        </tr>
        <tr>
            <td>Deadline</td>
            <td class="text-right font-weight-bold">{{ parse_date($order->products['deadline']) }}</td>
        </tr>
        @foreach($order->additionals as $add)
        <tr>
            <td>Layanan Tambahan</td>
            <td class="text-right font-weight-bold">{{ $add->quantity . ' X ' . $add->title }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
@endcomponent
@endif
@endsection