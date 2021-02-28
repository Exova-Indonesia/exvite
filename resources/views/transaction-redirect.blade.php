@extends('layouts.app')
@section('content')
<div class="container mb-5">
    <div class="">
        <div class="m-auto">
            <div class="">
                <div class="card">
                    <div class="card-header bg-white border-0">
                        <h5 class="text-center">Detail Transaksi<h5>
                    </div>
                    <div class="card-body">
                        <div class="d-flex">
                            <div class="m-auto">
                                <div class="text-center text-white"><i class="fas h1 fa-arrow-right p-4 {{ ($details->wal_status == 'success') ? 'bg-success' : 'bg-danger' }} rounded-circle"></i></div>
                                <div><span class="text-capitalize">Payment {{ $details->wal_status }}</span></div>
                            </div>
                        </div>
                        <ul class="list-group">
                            <li class="list-group-item">
                                <strong>@lang('wallet.modal.status')</strong>
                                <span class="float-right text-right">{{ $details->wal_status }}</span>
                            </li>
                            <li class="list-group-item">
                                <strong>@lang('wallet.modal.to')</strong>
                                <span class="float-right text-right">{{ $details->creditedwallet['walletusers']['name'] }}</span>
                            </li>
                            <li class="list-group-item">
                                <strong>@lang('wallet.modal.id')</strong>
                                <span class="float-right text-right">****{{ substr($details->wal_debited_wallet, -4) }}</span>
                            </li>
                            <li class="list-group-item">
                                <strong>@lang('wallet.modal.type')</strong>
                                <span class="float-right text-right">{{ $details->wal_transaction_type }}</span>
                            </li>
                            <li class="list-group-item">
                                <strong>@lang('wallet.modal.note')</strong>
                                <span class="float-right text-right">{{ $details->wal_description }}</span>
                            </li>
                            <li class="list-group-item">
                                <strong>@lang('wallet.modal.date')</strong>
                                <span class="float-right text-right">{{ date('F j, Y h:i:s a', strtotime($details->updated_at)) }}</span>
                            </li>
                            <li class="list-group-item">
                                <strong>@lang('wallet.modal.amount')</strong>
                                <span class="amount float-right text-right">IDR {{ number_format($details->wal_amount, 0) }}</span>
                            </li>
                        </ul>
                        <a class="btn btn-success w-100" role="button" onclick="event.preventDefault();
                                                     document.getElementById('download-form').submit();">
                            Download
                        </a>
                        <form id="download-form" method="POST" action="{{ route('download') }}">
                            @csrf
                            <input type="hidden" name="invoice" value="{{ $details->wal_invoice }}">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection