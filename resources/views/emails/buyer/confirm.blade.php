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
        @if($order->status == 'pesanan_diproses')
        <tr>
            <td>Deadline</td>
            <td class="text-right font-weight-bold">{{ parse_date($order->deadline) }}</td>
        </tr>
        @endif
        @forelse($order->details['additionals'] as $add)
        <tr>
            <td>Layanan Tambahan</td>
            <td class="text-right font-weight-bold">{{ $add->quantity . ' X ' . $add->title }}</td>
        </tr>
        @empty
        @endforelse
    </tbody>
</table>
@endcomponent
@endif
@endsection