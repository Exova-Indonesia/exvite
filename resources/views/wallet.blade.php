@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row mb-5">
        <div class="col-md-5 p-2">
            <div class="card mb-3">
                <div class="card-header border-0 bg-white">
                    <h5 class="m-0 d-block">@lang('wallet.title')
                    <small class="float-right text-muted">{{ $balance->wallet_id }}</small></h5>
                </div>
                <div class="card-body">
                    <p>@lang('wallet.withdraw.total')<b class="float-right">IDR {{ number_format($balance->balance, 0) }}</b></p>
                    <div class="row">
                        <div class="col-md-12 col-lg-6 p-2">
                            <div class="card-block mb-2">
                                <div class="card-main">
                                    <div class="balance">
                                        <span class="label">@lang('wallet.withdraw.revenue')</span>
                                        <h1 class="title">IDR {{ number_format($balance->revenue, 0) }}</h1>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12 col-lg-6 p-2">
                            <div class="card-block mb-2 bg-danger">
                                <div class="card-main">
                                    <div class="balance">
                                        <span class="label">@lang('wallet.withdraw.fund')</span>
                                        <h1 class="title">IDR {{ number_format($balance->fund, 0) }}</h1>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="m-auto row">
                            <div class="m-1 text-right">
                                <button type="button" data-target="#withdrawActionSheet" data-toggle="modal" class="btn btn-danger">@lang('wallet.withdraw.title')</button>
                            </div>
                            <div class="m-1 text-right">
                                <button type="button" data-target="#topupActionSheet" data-toggle="modal" class="btn btn-success">@lang('wallet.topup.title')</button>
                            </div>
                            <div class="m-1 text-right">
                                <button type="button" data-target="#sendActionSheet" data-toggle="modal" class="btn btn-primary">@lang('wallet.transfer.title')</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-header border-0 bg-white">
                    <h5 class="m-0">@lang('wallet.payments')</h5>
                </div>
                <div class="card-body">
                @foreach($bank as $b)
                    <div class="list-payments">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="details-payments">
                                    <div class="text-banks">
                                        ****{{ substr(base64_decode($b->bank_account), -4) }}
                                        <a class="float-right text-muted" role="button" href="{{ url('bank/'.$b->bank_id) }}">
                                            <i class="fa fa-trash text-danger"></i>
                                        </a>
                                    </div>
                                    <span class=text-muted>{{ $b->bank_user }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
                    <div class="col-md-12">
                        <div class="action-sheet-content" id="addbanks_form">
                        <form method="POST" action="{{ route('bank.add') }}">
                            @csrf
                            <div class="form-group basic">
                                <div class="input-wrapper">
                                    <label class="label" for="bank_code">@lang('wallet.withdraw.bank')</label>
                                    <select type="text" class="form-control" id="bank_code" name="bank_code">
                                    </select>
                                </div>
                            </div>
                            <div class="form-group basic">
                                <div class="input-wrapper">
                                    <label class="label" for="bank_user">@lang('wallet.withdraw.user')</label>
                                    <input type="text" class="form-control" id="bank_user" name="bank_user" placeholder="e.g : Mr. Jhony">
                                </div>
                            </div>
                            <div class="form-group basic">
                                <div class="input-wrapper">
                                    <label class="label" for="bank_account">@lang('wallet.withdraw.id')</label>
                                    <input type="text" class="form-control" name="bank_account"
                                        placeholder="e.g : 012345678900">
                                </div>
                            </div>
                            <div class="form-group basic">
                                <button type="submit" class="btn btn-primary btn-block btn-lg">
                                    @lang('wallet.addpayments')
                                </button>
                            </div>
                        </form>
                    </div>
                    </div>
                    @if($bankscount < 3)
                    <div class="border-dashed add-payments my-2" id="add_banks" role="button">
                        <span>@lang('wallet.addpayments')</span>
                    </div>
                    @endif
                </div>
            </div>
        </div>
        <div class="col-md-7 p-2">
            <div class="card">
                <div class="card-header border-0 bg-white">
                    <h5 class="m-0">@lang('wallet.history.title')</h5>
                </div>
                <div class="card-body">
                <div class="text-right">
                    <a href="{{ route('transaction.all') }}" class="btn btn-success m-1">Export Riwayat</a>
                </div>
                    <div class="table-responsive my-4">
                        <table class="table" id="history_transaction">
                            <thead>
                                <tr>
                                    <th>@lang('wallet.history.date')</th>
                                    <th>@lang('wallet.history.to')</th>
                                    <th>@lang('wallet.modal.type')</th>
                                    <th>@lang('wallet.history.amount')</th>
                                    <th>@lang('wallet.history.status')</th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach($credited as $c)
                            <tr data-target="#detailtransaksi" data-toggle="modal" role="button" data-trans="{{ $c->wal_transaction_id }}">   
                                <td>{{ $c->created_at }}</td>
                                @if($c->wal_credited_wallet == $c->wal_debited_wallet)
                                <td>{{ $c->withdraw['bank_user'] }}</td>
                                @else
                                <td>{{ $c->creditedwallet->walletusers['name'] }}</td>
                                @endif
                                <td>{{ $c->wal_transaction_type }}</td>
                                @if($c->creditedwallet->walletusers['id'] == Auth::user()->id && $c->wal_credited_wallet !== $c->wal_debited_wallet)
                                <td class="text-success"> + IDR {{ number_format($c->wal_amount, 0) }}</td>
                                @else
                                <td class="text-danger"> - IDR {{ number_format($c->wal_amount, 0) }}</td>
                                @endif
                                <td class="@if($c->wal_status == 'success') text-success 
                                    @elseif($c->wal_status == 'pending') text-warning 
                                    @else text-danger @endif">{{ $c->wal_status }}</td>
                            </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Modals Detail Transaction -->
<div class="modal fade" id="detailtransaksi" tabindex="-1" role="dialog" aria-labelledby="Modal Detail Transaksi" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header"><h5 class="modal-title">@lang('wallet.modal.title')</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <ul class="list-group">
            <li class="list-group-item">
                <strong>@lang('wallet.modal.status')</strong>
                <span class="float-right text-right status"></span>
            </li>
            <li class="list-group-item">
                <strong>@lang('wallet.modal.from')</strong>
                <span class="float-right text-right from"></span>
            </li>
            <li class="list-group-item">
                <strong>@lang('wallet.modal.to')</strong>
                <span class="float-right text-right to"></span>
            </li>
            <li class="list-group-item">
                <strong>@lang('wallet.modal.id')</strong>
                <span class="float-right text-right id"></span>
            </li>
            <li class="list-group-item">
                <strong>@lang('wallet.modal.type')</strong>
                <span class="float-right text-right type"></span>
            </li>
            <li class="list-group-item">
                <strong>@lang('wallet.modal.note')</strong>
                <span class="float-right text-right note"></span>
            </li>
            <li class="list-group-item">
                <strong>@lang('wallet.modal.date')</strong>
                <span class="float-right text-right date"></span>
            </li>
            <li class="list-group-item">
                <strong>@lang('wallet.modal.amount')</strong>
                <span class="amount float-right text-right"></span>
            </li>
        </ul>
    </div>
    <div class="modal-footer border-0">
        <a class="btn btn-success w-100" role="button" onclick="event.preventDefault();
            document.getElementById('download-form').submit();">
            Download
        </a>
        <form id="download-form" method="POST" action="{{ route('download') }}">
            @csrf
            <input type="hidden" name="invoice" class="invoice">
        </form>
      </div>
    </div>
  </div>
</div>

<!-- Send Action Sheet -->
<div class="modal fade" id="sendActionSheet" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">@lang('wallet.send.title')</h5>
            </div>
            <div class="modal-body">
                <div class="action-sheet-content">
                    <form method="POST" action="{{ route('wallet.send') }}">
                        @csrf
                        <div class="form-group basic">
                            <div class="input-wrapper">
                                <label class="label" for="select_send">@lang('wallet.form.from')</label>
                                <select type="text" class="form-control" id="select_send" name="trf_from"
                                    placeholder="@lang('wallet.form.to')">
                                <option value="dana" selected>Exova Dana - IDR {{ number_format($balance->fund, 0) }}</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group basic">
                            <label class="label" for="transfer_to">@lang('wallet.form.to')</label>
                                <div class="input-group mb-2">
                                <input type="text" class="form-control" id="transfer_to" name="transfer_to"
                                    placeholder="@lang('wallet.form.to_place')">
                                    <div class="input-group-prepend">
                                    <span class="input-group-text-check" role="button" id="check">check</span>
                                </div>
                            </div>
                            <div id="transfer_user"></div>
                        </div>
                        <div class="form-group basic">
                            <div class="input-wrapper">
                                <label class="label" for="note">@lang('wallet.form.note')</label>
                                <input type="text" class="form-control" id="note" name="note"
                                    placeholder="@lang('wallet.form.note')">
                            </div>
                        </div>
                        <div class="form-group basic">
                            <label class="label">@lang('wallet.form.amount')</label>
                            <div class="input-group mb-2">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="input14">IDR</span>
                                </div>
                                <input type="text" id="amount" name="amount" class="form-control saldo_send form-control-lg" autocomplete="off" placeholder="0">
                            </div>
                        </div>
                        <div class="form-group basic">
                            <button type="submit" class="btn btn-primary submit-trf btn-block btn-lg" disabled>
                                @lang('wallet.send.title')
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- * Send Action Sheet -->

<!-- Withdraw Action Sheet -->
<div class="modal fade" id="withdrawActionSheet" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">@lang('wallet.withdraw.title')</h5>
            </div>
            <div class="modal-body">
                <div class="action-sheet-content">
                    <form method="POST" action="{{ route('wallet.withdraw') }}">
                        @csrf
                        <div class="form-group basic">
                            <div class="input-wrapper">
                                <label class="label" for="select_form">@lang('wallet.withdraw.from')</label>
                                <select type="text" class="form-control" id="select_form" name="withdraw_from">
                                <option value="pendapatan" selected>@lang('wallet.withdraw.revenue') - IDR {{ number_format($balance->revenue, 0) }}</option>
                                <option value="dana">@lang('wallet.withdraw.fund') - IDR {{ number_format($balance->fund, 0) }}</option>
                                <option value="saldo">@lang('wallet.withdraw.total') - IDR {{ number_format($balance->balance, 0) }}</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group basic">
                            <label class="label" for="withdraw_to">@lang('wallet.withdraw.to')</label>
                                <div class="input-group mb-2">
                                <select type="text" class="form-control" id="withdraw_to" name="withdraw_to"
                                    placeholder="@lang('wallet.withdraw.to')">
                                <option value="Pilih Akun Bank" selected hidden disabled>Pilih Akun Bank</option>
                                @foreach($bank as $b)
                                    <option value="{{ $b->bank_id }}">****{{ substr(base64_decode($b->bank_account), -4) }} - {{ $b->bank_user }}</option>
                                @endforeach
                                </select>
                        </div>
                        <div class="form-group basic">
                            <div class="input-wrapper">
                                <label class="label" for="note">@lang('wallet.withdraw.note')</label>
                                <input type="text" class="form-control" name="note"
                                    placeholder="@lang('wallet.withdraw.note')">
                                <i class="clear-input">
                                    <ion-icon name="close-circle"></ion-icon>
                                </i>
                            </div>
                        </div>
                        <div class="form-group basic">
                            <label class="label">@lang('wallet.form.amount')</label>
                            <div class="input-group mb-2">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">IDR</span>
                                </div>
                                <input type="text" id="amount" name="amount" class="form-control saldo_withdraw form-control-lg" autocomplete="off" placeholder="0">
                            </div>
                        </div>
                        <div class="form-group basic">
                            <button type="submit" class="btn btn-primary submit-wdrw btn-block btn-lg" disabled>
                                @lang('wallet.withdraw.title')
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- * Withdraw Action Sheet -->

<script type="text/javascript">
    $(document).ready(function() {
        function transactiondetails(data) {
        if (data.wal_status == 'success') {
            $('.status').html(`<span class="float-right text-right text-success">`+data.wal_status+`</span>`)
        } else if(data.wal_status == 'pending') {
            $('.status').html(`<span class="float-right text-right text-warning">`+data.wal_status+`</span>`)
        } else {
            $('.status').html(`<span class="float-right text-right text-danger">`+data.wal_status+`</span>`)
        }
        if(data.creditedwallet.walletusers.id == <?php echo Auth::user()->id ?> && data.wal_credited_wallet != data.wal_debited_wallet) {
            $('.amount').html(`<span class="float-right text-right text-success">+ IDR `+numeral(data.wal_amount).format('0,0'))+`</span>`
        } else {
            $('.amount').html(`<span class="float-right text-right text-danger">- IDR `+numeral(data.wal_amount).format('0,0'))+`</span>`
        }
        if(data.wal_credited_wallet == data.wal_debited_wallet) {
            $('.from').html(data.debitedwallet.walletusers.name);
            $('.to').html(data.withdraw.bank_user);
            // $('.id').html("****"+atob(data.withdraw.bank_account).substr(-4))
            $('.id').html("****"+atob(data.withdraw.bank_account).substr(-4))
            // $('.id').html("****"+data.wal_credited_wallet.substr(-4))
        } else {
            $('.id').html("****"+data.wal_debited_wallet.substr(-4))
            $('.from').html(data.debitedwallet.walletusers.name);
            $('.to').html(data.creditedwallet.walletusers.name);
        }
        
        $('.type').html(data.wal_transaction_type)
        $('.note').html(data.wal_description)
        $('.invoice').val(data.wal_invoice)
        $('.date').html(new Date(data.updated_at).toUTCString())
    }

    $('#detailtransaksi').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget)
        var id = button.data('trans')

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                'Access-Control-Allow-Origin': '*',
            }
        });
        $.ajax({
            url: "{{ url('transaction-details') }}",
            type: "POST",
            dataType: "json",
            data: 'trans_id=' + id,
            success: function(data) {
                transactiondetails(data)
            },
            beforeSend: function () {
                $('.status').html('Loading...')
                $('.to').html('Loading...')
                $('.id').html('Loading...')
                $('.type').html('Loading...')
                $('.note').html('Loading...')
                $('.date').html('Loading...')
                $('.amount').html('Loading...')
            },
            error: function () {
                
            }
        })

        var modal = $(this)
        
    })
})
</script>
<!-- Modals Detail Transaction -->
@endsection