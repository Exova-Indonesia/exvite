<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
<!------ Include the above in your HEAD tag ---------->

<!--Author      : @arboshiki-->
<div id="invoice">
<style>
#invoice{
    padding: 30px;
}

.invoice {
    position: relative;
    background-color: #FFF;
    min-height: 680px;
    padding: 15px
}

.invoice header {
    padding: 10px 0;
    margin-bottom: 20px;
    border-bottom: 1px solid #3989c6
}

.invoice .company-details {
    text-align: right
}

.invoice .company-details .name {
    margin-top: 0;
    margin-bottom: 0
}

.invoice .contacts {
    margin-bottom: 20px
}

.invoice .invoice-to {
    text-align: left
}

.invoice .invoice-to .to {
    margin-top: 0;
    margin-bottom: 0
}

.invoice .invoice-details {
    text-align: right
}

.invoice .invoice-details .invoice-id {
    margin-top: 0;
    color: #3989c6
}

.invoice main {
    padding-bottom: 50px
}

.invoice main .thanks {
    margin-top: -100px;
    font-size: 2em;
    margin-bottom: 50px
}

.invoice main .notices {
    padding-left: 6px;
    border-left: 6px solid #3989c6
}
.invoice table {
    width: 100%;
    border-collapse: collapse;
    border-spacing: 0;
    margin-bottom: 20px
}

.invoice table td,.invoice table th {
    padding: 15px;
    background: #eee;
    border-bottom: 1px solid #fff
}

.invoice table th {
    white-space: nowrap;
    font-weight: 400;
    font-size: 16px
}

.invoice table td h3 {
    margin: 0;
    font-weight: 400;
    color: #3989c6;
    font-size: 1.2em
}

.invoice table .qty,.invoice table .total,.invoice table .unit {
    text-align: right;
    font-size: 1.2em
}

.invoice table .no {
    color: #fff;
    font-size: 1.6em;
    background: #3989c6
}

.invoice table .unit {
    background: #ddd
}

.invoice table .total {
    background: #3989c6;
    color: #fff
}

.invoice table tbody tr:last-child td {
    border: none
}

.invoice table tfoot td {
    background: 0 0;
    border-bottom: none;
    white-space: nowrap;
    text-align: right;
    padding: 10px 20px;
    font-size: 1.2em;
    border-top: 1px solid #aaa
}

.invoice table tfoot tr:first-child td {
    border-top: none
}

.invoice table tfoot tr:last-child td {
    color: #3989c6;
    font-size: 1.4em;
    border-top: 1px solid #3989c6
}

.invoice table tfoot tr td:first-child {
    border: none
}

.invoice main .notices .notice {
    font-size: 1.2em
}

.invoice footer {
    width: 100%;
    text-align: center;
    color: #777;
    border-top: 1px solid #aaa;
    padding: 8px 0
}

@media print {
    .invoice {
        font-size: 11px!important;
        overflow: hidden!important
    }

    .invoice footer {
        position: absolute;
        bottom: 10px;
        page-break-after: always
    }

    .invoice>div:last-child {
        page-break-before: always
    }
}
</style>
    <div class="invoice overflow-auto">
        <div style="min-width: 600px">
            <header>
                <div class="row">
                    <div class="col">
                        <a target="_blank" href="{{ config('app.url') }}">
                            <img src="https://assets.exova.id/img/logo.png" />
                            </a>
                    </div>
                    <div class="col company-details">
                        <div>Transaction Details</div>
                    </div>
                </div>
            </header>
            <main>
                <div class="row contacts">
                    <div class="col invoice-to">
                        <div class="text-gray-light">Account Holder</div>
                        <h2 class="to">{{ Auth::user()->name }}</h2>
                        <div class="address">Kode ExoWallet : {{ $wallet->wallet_id }} </div>
                        <div class="email"><a href="mailto:{{ Auth::user()->email }}">{{ Auth::user()->email }}</a></div>
                    </div>
                    <div class="col invoice-details">
                        <h5 class="invoice-id">Transaction Total</h5>
                        <div class="date">{{ $credited }} Transaksi Keluar</div>
                        <div class="date">{{ $debited }} Transaksi Masuk</div>
                    </div>
                </div>
                <table class="table table-bordered" id="history_transaction">
                    <thead>
                        <tr>
                            <th>@lang('wallet.history.id')</th>
                            <th>@lang('wallet.history.date')</th>
                            <th>@lang('wallet.history.credited')</th>
                            <th>@lang('wallet.history.debited')</th>
                            <th>@lang('wallet.history.note')</th>
                            <th>@lang('wallet.modal.type')</th>
                            <th>@lang('wallet.history.amount')</th>
                            <th>@lang('wallet.history.status')</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($history as $c)
                    <tr data-target="#detailtransaksi" data-toggle="modal" role="button" data-trans="{{ $c->wal_transaction_id }}">   
                        <td>{{ $c->wal_transaction_id }}</td>
                        <td>{{ $c->created_at }}</td>
                        <td>{{ $c->debitedwallet->walletusers['name'] }}</td>
                        @if($c->wal_credited_wallet == $c->wal_debited_wallet && !empty($c->wal_debited_bank))
                        <td>{{ $c->withdraw['bank_user'] }}</td>
                        @else
                        <td>{{ $c->creditedwallet->walletusers['name'] }}</td>
                        @endif
                        <td>{{ $c->wal_description }}</td>
                        <td>{{ $c->wal_transaction_type }}</td>
                        @if($c->creditedwallet->walletusers['id'] == Auth::user()->id && $c->wal_credited_wallet !== $c->wal_debited_wallet)
                        <td class="text-success"> + IDR {{ number_format($c->wal_amount, 0) }}</td>
                        @else
                        <td class="text-danger"> - IDR {{ number_format($c->wal_amount, 0) }}</td>
                        @endif
                        <td>{{ $c->wal_status }}</td>
                    </tr>
                    @endforeach
                    </tbody>
                </table>
            </main>
            <footer>
                {{ 'Copyright ' . Date('Y ') . config('app.name') }}
            </footer>
        </div>
        <div></div>
    </div>
</div>