@extends('layouts.app')

@section('content')
<div class="preloader">
    <span><img width="40px" height="40px" src="{{ ('https://assets.exova.id/img/1.png') }}"></span>
</div>
<div class="home-area overlay" id="dashboard_page">
    <div class="container">
        <div id="particles-js"></div>
            <div class="row">
                <div class="col-xs-12 hidden-sm col-md-5">
                    <figure class="mobile-image wow fadeInUp" data-wow-delay="0.2s">
                        <img src="images/icons/phone.png" alt="ExPhone Picture">
                    </figure>
                </div>
                <div class="col-xs-12 col-lg-7">
                <div class="space-80 hidden-xs"></div>
                    <h1 class="wow fadeInUp" data-wow-delay="0.4s">Exova Indonesia</h1>
                <div class="space-20"></div>
                <div class="desc wow fadeInUp" data-wow-delay="0.6s">
                    <p>@lang('home.header.description')</p>
                </div>
                <div class="space-20"></div>
                    <div class="input-group mb-4 border bg-white rounded-pill p-2">
                        <div class="input-group-prepend border-0">
                            <button id="button-addon4" type="button" class="btn btn-link text-info"><i class="fa fa-search h3 mb-0"></i></button>
                        </div>
                            <input id="search" type="search" autocomplete="off" placeholder="@lang('home.header.search')" aria-describedby="button-addon4" class="form-control bg-transparent border-0">
                        </div>
                        <div id="result">
                        </div>
                {{--<input class="bttn-white wow font-weight-normal text-white fadeInUp text-capitalize" data-wow-delay="0.8s" placeholder="Aku mau beli . . .">--}}
                <div class="col-sm-12 exova-wallets">
                @guest
                @else
                <!-- Wallet Card -->
                <div class="section wallet-card-section pt-1" data-component="wallet">
                    <div class="wallet-card">
                        <!-- Balance -->
                        <div class="balance">
                            <div class="left">
                                <span class="title">Total @lang('home.wallet.balance')</span>
                                <h1 class="total-balance text-secondary">IDR {{ number_format($balance->balance, 0) }}</h1>
                            </div>
                            <div class="right text-secondary">
                            <span class="title">@lang('home.wallet.code')</span>
                            <a class="text-secondary">{{ $balance->wallet_id }}</a>
                                <!--a class="button" role="button">
                                    <i class="fa fa-credit-card"></i>
                                </a>-->
                            </div>
                        </div>
                        <!-- * Balance -->
                        <!-- Wallet Footer -->
                        <div class="wallet-footer">
                            <div class="item" data-component="withdraw">
                                <a href="#" data-toggle="modal" data-target="#withdrawActionSheet">
                                    <div class="icon-wrapper bg-danger">
                                        <i class="fa fa-arrow-down"></i>
                                    </div>
                                    <strong>@lang('home.wallet.withdraw')</strong>
                                </a>
                            </div>
                            <div class="item" data-component="send">
                                <a href="#" data-toggle="modal" data-target="#sendActionSheet">
                                    <div class="icon-wrapper">
                                        <i class="fa fa-arrow-right"></i>
                                    </div>
                                    <strong>@lang('home.wallet.send')</strong>
                                </a>
                            </div>
                            <div class="item" data-component="mywallet">
                                <a href="{{ url('wallet') }}">
                                    <div class="icon-wrapper bg-success">
                                        <i class="fas fa-piggy-bank"></i>
                                    </div>
                                    <strong>@lang('home.wallet.mywallet')</strong>
                                </a>
                            </div>
                            <div class="item" data-component="wallethistory">
                                <a href="{{ url('wallet') }}">
                                    <div class="icon-wrapper bg-primary">
                                        <i class="fa fa-history"></i>
                                    </div>
                                    <strong>@lang('home.wallet.history')</strong>
                                </a>
                            </div>

                        </div>
                        <!-- * Wallet Footer -->
                    </div>
                </div>
                <!-- Wallet Card -->
                @endguest
            </div>
            </div>
        </div>
    </div>
</div>
<section id="services_page" class="py-5 wow fadeInUp pb-5" data-wow-delay="0.5s" data-component="services_page">
    <div class="container">
         <div class="row">
            <div class="col-xs-12 col-md-12 col-md-offset-1">
                <div class="page-title text-center">
                    <div class="space-20"></div>
                    <h5 class="title">@lang('home.services.title')</h5>
                    <div class="row text-center align-items-end">
                        <!-- Pricing Table-->
                        <div class="col-lg-4 mb-5 mb-lg-0">
                        </div>
                        <!-- END -->
                        <!-- Pricing Table-->
                        <div class="col-lg-4 mb-5 mb-lg-0" data-component="jasa">
                            <div class="bg-white p-5 rounded-lg shadow">
                            <h1 class="h6 text-secondary text-uppercase font-weight-bold mb-4">@lang('home.services.jasatitle')</h1>
                            <img class="rounded-circle" src="{{ Auth::user()->avatar ?? '' }}" width="80px" height="80px" alt="avatar">
                            <div class="custom-separator my-4 mx-auto bg-primary"></div>
                            <ul class="list-unstyled my-5 text-small text-secondary text-left">
                                <li class="mb-3 text-center">
                                    @lang('home.services.jasa.description')
                                </li>
                            </ul>
                            <a href="#" class="btn btn-exova-grad btn-block p-2 shadow">@lang('home.services.jasa.button')</a>
                            </div>
                        </div>
                        <!-- END -->
                        <!-- Pricing Table-->
                        <div class="col-lg-4 mb-5 mb-lg-0" data-component="creations">
                            <div class="bg-white p-5 rounded-lg shadow">
                            <h1 class="h6 text-secondary text-uppercase font-weight-bold mb-4" >@lang('home.services.createtitle')</h1>
                            <img class="rounded-circle" src="{{ Auth::user()->avatar ?? '' }}" width="80px" height="80px" alt="avatar">
                            <div class="custom-separator my-4 mx-auto bg-primary"></div>
                            <ul class="list-unstyled my-5 text-small text-secondary text-left font-weight-normal">
                                <li class="mb-3 text-center">
                                    @lang('home.services.creations.description')
                                </li>
                            </ul>
                            <a href="#" class="btn btn-exova-grad btn-block p-2 shadow">@lang('home.services.creations.button')</a>
                            </div>
                        </div>
                        <!-- END -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@if(! empty($highlight[0]))
<section class="py-5" id="highlight">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 wow fadeInUp" data-wow-delay="0.4s">
                <div class="page-title text-center">
                    <h5 class="title">Highlight</h5>
                        <div class="space-10"></div>
                    </div>
                    <p class="text-right"><a class="text-primary" href="{{ url('highlight') }}">@lang('home.highlight.seeall')</a></p>
                <div class="row"  data-component="highlight">
                @foreach($highlight as $h)
                <div class="col-lg-2 mb-5 col-sm-6 mb-lg-0">
                    <a href="#" class="rounded-lg text-center">
                        <div class="ribbon-wrapper">
                            <div class="ribbon bg-danger text-white">
                                Highlight
                            </div>
                        </div>
                        <img class="w-100 p-2" src="{{ $h->product['jasa_thumbnail'] }}" alt="products">
                        <div class="p-2 bg-white shadow-sm">
                            <ul class="list-unstyled text-small text-secondary text-left font-weight-normal">
                                <div>{{ $h->product['jasa_name'] }}</div>
                                <div class="font-weight-bold">IDR {{ number_format($h->product['jasa_price'], 0) }}</div>
                            </ul>
                        </div>
                    </a>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
</section>
@endif

<section class="py-5" id="membership">
        <div class="container-fulid">
            <div class="container">
                <div class="page-title text-center">
                    <h5 class="title">Membership</h5>
                    <div class="space-10"></div>
                </div>
                <div class="row" data-component="membership">
                    @foreach($subs as $s)
                    <div class="col-md-4 col-sm-6 wow fadeInLeft my-2" data-wow-delay="0.3s">
                        <div class="price-table">
                            <div class="price-head">
                                <h4>{{ $s->plan_name }}</h4>
                                @if(!empty($s->price_per_year_old))
                                <h5 class="m-0 text-danger"><s>IDR {{ number_format($s->price_per_year_old, 0) }}</s></h5>
                                @endif
                                <h2>IDR {{ number_format($s->price_per_year, 0) }}<span></span></h2>
                            </div>
                            <div class="price-content">
                                <ul>
                                @foreach($s->plan_benefits['benefits'] as $b)
                                    <li>
                                    @if($b['available'] == 'Yes')
                                    <i class="fa fa-check mr-2 text-success"></i>
                                    @else
                                    <i class="fa fa-times mr-2 text-danger"></i>
                                    @endif
                                    {{ $b['counts'] }}
                                    {{ $b['name'] }}
                                    </li>
                                @endforeach
                                </ul>
                            </div>
                            <div role="button" class="price-button add_cart" data-id="{{ $s->plan_id }}" data-label="Subscription">
                                <a class="text-white">@lang('home.membership.buy')</a>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>

<section id="faq" class="questions-area section-padding">
    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <div class="page-title text-center">
                    <h5 class="title">@lang('home.help.title')</h5>
                    <h3 class="dark-color">@lang('home.help.subtitle')</h3>
                    <div class="space-60"></div>
                </div>
            </div>
        </div>
        <div class="row" data-component="faq">
            <div class="col-xs-12 col-sm-6">
                <div class="toggole-boxs wow fadeInUp" data-wow-delay="0.2s">
                    <h3>Apa itu Exova Indonesia ?</h3>
                    <div>
                        <p>Exova Indonesia adalah platform tempat menyalurkan hobby jadi uang</p>
                    </div>
                        <h3>Apa saja metode pembayaran di Exova ?</h3>
                    <div>
                        <p>Pembayaran bisa dilakukan melalui debet/credit card, Ovo, Gopay, Dana, ExoPay, dan E-Wallet lainnya</p>
                    </div>
                        <h3>Bagaimana cara mendapatkan pendapatan ?</h3>
                    <div>
                        <p>Dengan enjual produk/jasa anda di layanan <a href="#">Exova Jasa</a></p>
                    </div>
                        <h3>Bagaimana Cara Berlangganan Premium</h3>
                    <div>
                        <p>Dengan memilih paket dan membelinya, maka anda akan mendapat fitur tambahan sesuai paket yang anda pilih</p>
                    </div>
                </div>
            </div>
            <div class="col-xs-12 col-sm-6">
                <div class="toggole-boxs wow fadeInUp" data-wow-delay="0.2s">
                        <h3>Apa keuntungan berlangganan premium ?</h3>
                    <div>
                        <p>Jika kamu berlangganan premiun, adapun keuntungan yang akan kamu dapatkan <br>
                        1. Kamu bisa menikmati semua produk <a href="#">Exova Creations</a> secara gratis selama kamu berlangganan <br>
                        2. Kamu bisa sepuasnya menjadikan produk yang kamu jual di <a href="#">Exova Jasa</a> sebagai highlight secara gratis ( Highlight adalah fitur promosi berbayar milik Exova )<br>
                        3. Mendapatkan penawaran menarik lainnya</p>
                    </div>
                        <h3>Cara Menjual Produk/Jasa</h3>
                    <div>
                        <p>Registrasi terlebih dahulu dan registrasi di exova gratis. Setelah registrasi kamu bisa langsung masuk Exova Jasa dan mulai membuat studio untuk mulai menjual jasa</p>
                    </div>
                        <h3>Cara Melakukan Refund Transaksi</h3>
                    <div>
                        <p>Refund dilakukan jika tidak ada balasan dari penjual selama 2 hari, dan akan otomatis masuk pada akun Exova Wallet kamu </p>
                    </div>
                        <h3>Cara Mencairkan Saldo/Pendapatan/Refund</h3>
                    <div>
                        <p>Pengguna mendaftarkan nomor rekeningnya pada kolom pembayaran pada menu profil dan saldo akan masuk setiap kali direquest</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="testimonial-area" id="tentang">
    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <div class="page-title text-center">
                    <h5 class="title">Our Team</h5>
                    <h3 class="dark-color">The Executive</h3>
                    <div class="space-60"></div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12" data-component="team">
                <div class="team-slide wow fadeInUp" data-wow-delay="0.3s">
                    <div class="team-box">
                        <div class="team-image">
                        <img src="{{ url('images/executive/arthafix.png') }}" alt="">
                        </div>
                        <h4>Triyana Artha</h4>
                        <h6 class="position">Founder, CEO, & CTO</h6>
                        <p>Bio</p>
                    </div>
                    <div class="team-box">
                        <div class="team-image">
                        <img src="{{ url('images/executive/ngurahfix.jpg') }}" alt="">
                        </div>
                        <h4>Ngurah Krisna</h4>
                        <h6 class="position">Co-Founder, CMO, & CDO</h6>
                        <p>Bio</p>
                    </div>
                    <div class="team-box">
                        <div class="team-image">
                        <img src="{{ url('images/executive/mametfix.jpg') }}" alt="">
                        </div>
                        <h4>Adi Palguna</h4>
                        <h6 class="position">Leader BOT</h6>
                        <p>Bio</p>
                    </div>
                    <div class="team-box">
                        <div class="team-image">
                        <img src="{{ url('images/executive/yusa2.jpg') }}" alt="">
                        </div>
                        <h4>Yusa Kywn</h4>
                        <h6 class="position">BOT</h6>
                        <p>Bio</p>
                    </div>
                    <div class="team-box">
                        <div class="team-image">
                        <img src="{{ url('images/executive/prastafix.jpg') }}" alt="">
                        </div>
                        <h4>Prasta</h4>
                        <h6 class="position">BOT</h6>
                        <p>Bio</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container" data-component="kontak">
        <div class="row">
            <div class="col-xs-12 wow fadeInUp" data-wow-delay="0.2s">
                <div class="page-title text-center">
                    <h5 class="title">@lang('home.contact.title')</h5>
                    <div class="space-60"></div>
                </div>
            </div>
        </div>
    <div class="row wow fadeInUp" data-wow-delay="0.2s">
        <div class="col-xs-12 col-sm-4">
            <div class="footer-box">
                <div class="box-icon">
                    <span class="lnr lnr-map-marker"></span>
                </div>
                    <p>Jalan Trengguli 1<br />Penatih, Denpasar Timur</p>
                </div>
                <div class="space-30 hidden visible-xs"></div>
            </div>
            <div class="col-xs-12 col-sm-4">
                <div class="footer-box">
                    <div class="box-icon">
                        <span class="lnr lnr-phone-handset"></span>
                    </div>
                        <p>+62 812-3816-9667<br />+62 831-1487-0769</p>
                </div>
                <div class="space-30 hidden visible-xs"></div>
            </div>
            <div class="col-xs-12 col-sm-4 wow fadeInUp" data-wow-delay="0.2s">
                <div class="footer-box">
                    <div class="box-icon">
                        <span class="lnr lnr-envelope"></span>
                    </div>
                        <p>support@exova.id</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Modals -->
@guest
<!-- Modals -->
@else
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
                                <input type="text" name="amount" class="form-control saldo_send form-control-lg" autocomplete="off" placeholder="0">
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
                                <div class="input-group-prepend">
                                    <a href="{{ url('wallet') }}" class="input-group-text-check" role="button" id="check"><i class="fa fa-user-plus text-success"></i></a>
                            </div>
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
                                <input type="text" name="amount" class="form-control saldo_withdraw form-control-lg" autocomplete="off" placeholder="0">
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
</div>
<!-- * Withdraw Action Sheet -->
<!-- Modal Cart -->
<button type="button" class="d-none" id="cart_add" data-toggle="modal" data-target="#add_cart"></button>
<div class="modal fade" id="add_cart" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="add_cart_title">Berhasil ditambahkan</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body m-auto">
            <img class="p-3" width="250" height="80" src="{{ asset('/images/icons/shopping_cart.svg') }}" alt="Logo">
        </div>
        <div class="modal-footer">
            <a role="button" class="btn btn-danger" data-dismiss="modal">Lanjut Belanja</a>
            <a role="button" href="{{ url('cart') }}" class="btn btn-success">Lihat Keranjang</a>
        </div>
        </div>
    </div>
</div>
@endguest
@endsection
@section('scripts')
<script>
/* particlesJS.load(@dom-id, @path-json, @callback (optional)); */
    particlesJS.load("particles-js", "particles.js/particlesjs.json", function () {
        //
});
</script>
@endsection
