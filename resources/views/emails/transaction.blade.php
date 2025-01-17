@extends('emails.layouts.app')
@section('head')
<div class="d-flex">
    <div class="m-auto">
        <div class="text-center text-white">
            <img width="350px" height="250px" src="https://assets.exova.id/payments.png">
        </div>
        <div><h2 class="text-center text-capitalize">Payment {{ $details->wal_status }}</h2></div>
    </div>
</div>
@endsection
@section('content')
@if (! empty($details))
@component('mail::table')
<div>
    <h1 class="text-center text-exova amount">IDR {{ number_format($details->wal_amount, 0) }}</h1>
</div>
<table>
    <tbody>
        <tr>
            <td>Status</td>
            <td class="text-right text-capitalize font-weight-bold">{{ $details->wal_status }}</td>
        </tr>
        <tr>
            <td>Dari</td>
            <td class="text-right text-capitalize font-weight-bold">{{ $details->debitedwallet['walletusers']['name'] }}</td>
        </tr>
        <tr>
            <td>Kepada</td>
            <td class="text-right font-weight-bold">
            @if($details->wal_credited_wallet == $details->wal_debited_wallet)
                {{ $details->withdraw['bank_user'] }}
            @else
                {{ $details->creditedwallet['walletusers']['name'] }}
            @endif
            </td>
        </tr>
        <tr>
            <td>No. Akun</td>
            <td class="text-right font-weight-bold">
            @if($details->wal_credited_wallet == $details->wal_debited_wallet)
                ****{{ substr(base64_decode($details->withdraw['bank_account']), -4) }}
            @else
                ****{{ substr($details->wal_credited_wallet, -4) }}
            @endif
            </td>
        </tr>
        <tr>
            <td>Tipe Transaksi</td>
            <td class="text-right font-weight-bold">{{ $details->wal_transaction_type }}</td>
        </tr>
        <tr>
            <td>Catatan</td>
            <td class="text-right font-weight-bold">{{ $details->wal_description }}</td>
        </tr>
        <tr>
            <td>Tanggal</td>
            <td class="text-right font-weight-bold">{{ date('F j, Y h:i:s a', strtotime($details->updated_at)) }}</td>
        </tr>
        <tr>
            <td>Transaksi ID</td>
            <td class="text-right font-weight-bold">{{ $details->wal_transaction_id }}</td>
        </tr>
    </tbody>
</table>
@endcomponent
@endif
@endsection