@extends('layouts.app')
@section('content')
<div class="container mb-5">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="input-group mb-4 border bg-white rounded-pill p-2">
                <div class="input-group-prepend border-0">
                    <button id="button-addon4" type="button" class="btn btn-link text-info"><i class="fa fa-search h3 mb-0"></i></button>
                </div>
                    <input id="search" type="search" autocomplete="off" placeholder="@lang('home.header.search')" aria-describedby="button-addon4" class="form-control bg-transparent border-0">
            </div>
            <div id="result"></div>
        </div>
    </div>
    <div class="search-title">
        <h5>Menampilkan hasil untuk {{ $title }}</h5>
    </div>
    <div class="col-lg-12">
        <div class="row justify-content-center">
            @forelse($products as $p)
            <div class="col-lg-2 col-sm-6 p-1">
                <div class="card">
                    <img class="p-3 card-img-top" src="{{ $p->jasa_thumbnail }}" alt="Thumbnail">
                    <div class="card-body">
                        <h5 class="card-text">{{ $p->jasa_name }}</h5>
                        <p class="card-text">{{ $p->jasa_deskripsi }}</p>
                    </div>
                </div>
            </div>
            @empty
                <div class="unfinded-products">
                    <img width="250px" class="my-2" src="{{ asset('images/icons/noactivity.svg') }}" alt="No Products">
                    <span class="text-muted">Produk tidak ditemukan</span>
                </div>
            @endforelse
        </div>
    </div>
</div>
@endsection