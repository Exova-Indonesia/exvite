@extends('seller.layouts.app')
@section('content')
<form action="{{ route('mystudio.store') }}" method="POST" enctype="multipart/form-data">
@csrf
<div class="card rounded-0 mb-0" data-card-height="cover-full">
   <div class="card-center px-3">
      <div class="text-center">
         <h1 class="font-40 font-800 pb-2">Exova<span class="gradient-highlight p-2 mx-1 color-white scale-box d-inline-block rounded-s border-0">Studio</span></h1>
      </div>
      <div class="col-lg-6 col-sm-12 mt-4 mx-auto">
        <div class="input-style input-style-always-active has-borders has-icon mb-4">    
                <input type="name" class="form-control" name="title" id="title" autocomplete="off">
                    <label for="title" class="color-theme opacity-50 text-uppercase font-700 font-10">Nama Portfolio</label>
                <i class="fa fa-times disabled invalid color-red-dark"></i>
            <i class="fa fa-check disabled valid color-green-dark"></i>
        </div>
        <div class="input-style input-style-always-active has-borders has-icon mb-4">    
                <textarea type="name" class="form-control" name="description" id="deskripsi" placeholder=""></textarea>
                    <label for="deskripsi" class="color-theme opacity-50 text-uppercase font-700 font-10">Deskripsi Portfolio</label>
                <i class="fa fa-times disabled invalid color-red-dark"></i>
            <i class="fa fa-check disabled valid color-green-dark"></i>
        </div>
        <div class="clearfix"></div>
        <div class="d-flex">
            <div class="mx-auto">
                <button type="submit" class="btn btn-exova rounded-sm btn-l font-13 font-600 mt-5 border-0">Selanjutnya</button>
            </div>
        </div>
      </div>
   </div>
</form>
@endsection
@section('scripts')
@endsection