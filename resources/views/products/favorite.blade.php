@extends('layouts.app')
@section('content')
<div class="container mb-5">
    <div class="col-lg-12">
        <div class="row">
            @forelse($favorite as $p)
                <x-productcard :products="$p->products" />
            @empty
                <div class="unfinded-products m-auto text-center">
                    <img width="250px" class="my-2" src="{{ asset('images/icons/noactivity.svg') }}" alt="No Products">
                    <div class="text-muted">Sepertinya kamu belum memiliki favorit <br> <a class="btn btn-success" href="{{ url('/') }}">Yuk cari produk</a> </div>
                </div>
            @endforelse
        </div>
    </div>
</div>
@endsection
