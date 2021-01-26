@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row mb-5">
        <div class="col-md-5 p-2">
            <div class="card mb-3">
                <div class="card-header">
                    @lang('wallet.title')
                    <span class="float-right text-muted">****{{ substr($balance->wallet_id, -4) }}</span>
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
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-header">
                    @lang('wallet.payments')
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
                    <div class="border-dashed add-payments my-2" id="add_banks" role="button">
                        <span>@lang('wallet.method')</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-7 p-2">
            <div class="card">
                <div class="card-header">
                    @lang('wallet.history.title')
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table" id="history_transaction">
                            <thead>
                                <tr>
                                    <th>@lang('wallet.history.date')</th>
                                    <th>@lang('wallet.history.to')</th>
                                    <th>@lang('wallet.history.note')</th>
                                    <th>@lang('wallet.history.amount')</th>
                                    <th>@lang('wallet.history.status')</th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach($credited as $c)
                            <tr data-target="#detailtransaksi" data-toggle="modal" role="button" data-trans="{{ $c->wal_transaction_id }}">   
                                <td>{{ $c->created_at }}</td>
                                @if($c->creditedwallet->walletusers['id'] == Auth::user()->id)
                                <td>{{ $c->debitedwallet->walletusers['name'] }}</td>
                                @else
                                <td>{{ $c->creditedwallet->walletusers['name'] }}</td>
                                @endif
                                <td>{{ $c->wal_description }}</td>
                                @if($c->creditedwallet->walletusers['id'] == Auth::user()->id)
                                <td class="text-success"> + IDR {{ number_format($c->wal_amount, 0) }}</td>
                                @else
                                <td class="text-danger"> - IDR {{ number_format($c->wal_amount, 0) }}</td>
                                @endif
                                <td>{{ $c->wal_status }}</td>
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
  <div class="modal-dialog" role="document">
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
                <span class="float-right text-right amount"></span>
            </li>
        </ul>
    </div>
    <div class="modal-footer border-0">
        <button class="btn btn-success w-100" type="button" data-dismiss="modal">
            Download
        </button>
      </div>
    </div>
  </div>
</div>

<script type="text/javascript">
    $(document).ready(function() {
        function transactiondetails(data) {
        $('.status').html(data.wal_status)
        if (data.wal_status == 'success') {
            $('.status').addClass('text-success')
        } else if(data.wal_status == 'pending') {
            $('.status').addClass('text-warning')
        } else {
            $('.status').addClass('text-danger')
        }
        if(data.creditedwallet.walletusers.id == <?php echo Auth::user()->id ?>) {
            $('.to').html(data.debitedwallet.walletusers.name);
            $('.id').html("****"+data.wal_credited_wallet.substr(-4))
        } else {
            $('.to').html(data.creditedwallet.walletusers.name);
            $('.id').html("****"+data.wal_debited_wallet.substr(-4))
        }
        $('.type').html(data.wal_transaction_type)
        $('.note').html(data.wal_description)
        $('.date').html(new Date(data.updated_at).toUTCString())
        $('.amount').html("IDR "+numeral(data.wal_amount).format('0,0'))
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