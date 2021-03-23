@extends('seller.layouts.start')
@section('content')
<div class="page-content pb-0">
<div class="splide single-slider slider-no-arrows slider-has-dots-over" id="single-slider-1" data-splide='{"type":"slide"}'>
   <div class="splide__track">
      <div class="splide__list">
         <div class="splide__slide">
            <div class="card mb-0" data-card-height="cover-full">
               <div class="card-center text-center">
                  <h1 class="font-18 font-700 color-highlight mb-n1">Selamat datang di</h1>
                  <h1 class="font-40 font-800 pb-4">Exova Studio</h1>
                  <h4 class="opacity-60 mb-4 pb-4">Hasilkan uang dengan hobimu <br> bersama Kami</h4>
                  <h1 class="text-center"><img src="{{ asset('images/undraw/a.svg') }}" class="mx-auto" width="240"></h1>
               </div>
            </div>
         </div>
         <div class="splide__slide">
            <div class="card mb-0" data-card-height="cover-full">
               <div class="card-center text-center">
                  <h1 class="font-18 font-700 color-highlight mb-n1">#1</h1>
                  <h1 class="font-34 font-800 pb-4">Upload Porfolio</h1>
                  <h4 class="opacity-60 mb-4 pb-4">Upload portfoliomu dengan mudah <br> dengan semua fitur yang Kami sediakan</h4>
                  <h1 class="text-center"><img src="{{ asset('images/undraw/b.svg') }}" class="mx-auto" width="180"></h1>
               </div>
            </div>
         </div>
         <div class="splide__slide">
            <div class="card mb-0" data-card-height="cover-full">
               <div class="card-center text-center">
                  <h1 class="font-18 font-700 color-highlight mb-n1">#2</h1>
                  <h1 class="font-34 font-800 pb-4">Dapatkan Pesanan</h1>
                  <h4 class="opacity-60 mb-4 pb-4">Dapatkan pesanan dan kerjakan<br> semua bebas Kamu yang ngatur </h4>
                  <h1 class="text-center"><img src="{{ asset('images/undraw/c.svg') }}" class="mx-auto" width="250"></h1>
               </div>
            </div>
         </div>
         <div class="splide__slide">
            <div class="card mb-0" data-card-height="cover-full">
               <div class="card-center text-center">
                  <h1 class="font-18 font-700 color-highlight mb-n1">#3</h1>
                  <h1 class="font-34 font-800 pb-4">Dapatkan Pendapatan</h1>
                  <h4 class="opacity-60 mb-4 pb-4"> Pendapatan akan otomatis <br> masuk ke Exova Walletmu </h4>
                  <h1 class="text-center"><img src="{{ asset('images/undraw/d.svg') }}" class="mx-auto" width="250"></h1>
               </div>
            </div>
         </div>
         <div class="splide__slide">
            <div class="card mb-0" data-card-height="cover-full">
               <div class="card-center text-center">
                  <h1 class="font-18 font-700 color-highlight mb-n1">Tunggu apa lagi?<h1>
                  <h1 class="font-34 font-800 pb-4">Ayo Mulai</h1>
                  <h4 class="opacity-60 mb-4 pb-4">Yuk mulai buat studiomu sendiri<br> Semua bebas menggunakan brand yang Kamu punya </h4>
                  <h1 class="text-center"><img src="{{ asset('images/undraw/e.svg') }}" class="mx-auto" width="300"></h1>
               </div>
            </div>
         </div>
         <div class="splide__slide">
            <form action="{{ route('studio.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="card rounded-0 mb-0" data-card-height="cover-full">
               <div class="card-center px-3">
                  <div class="text-center">
                     <h1 class="font-40 font-800 pb-2">Exova<span class="gradient-highlight p-2 mx-1 color-white scale-box d-inline-block rounded-s border-0">Studio</span></h1>
                  </div>
                  <div class="col-lg-6 col-sm-12 mx-auto">
                      <div class="upload-logo-studio mx-auto">
                        <input type="file" class="filepond" name="studio_logo" accept="image/png, image/jpeg, image/gif"/>
                      </div>
                    <div class="input-style input-style-always-active has-borders has-icon validate-field mb-4">
                        <i class="fa fa-user color-blue-dark"></i>
                            <input type="name" class="form-control validate-name" name="studio_name" id="form1ab" placeholder="Stonks Pictures">
                                <label for="form1ab" class="color-theme opacity-50 text-uppercase font-700 font-10">Nama Studio</label>
                            <i class="fa fa-times disabled invalid color-red-dark"></i>
                        <i class="fa fa-check disabled valid color-green-dark"></i>
                    </div>
                    <div class="clearfix"></div>
                  </div>
                  <button type="submit" class="btn btn-center-l gradient-highlight rounded-sm btn-l font-13 font-600 mt-5 border-0">Selanjutnya</button>
               </div>
            </form>
            </div>
         </div>
      </div>
   </div>
</div>
@endsection
@section('scripts')
<script>
$(document).ready(function() {
        FilePond.registerPlugin(
      FilePondPluginFileValidateType,
      FilePondPluginImageExifOrientation,
      FilePondPluginImagePreview,
      FilePondPluginImageCrop,
      FilePondPluginImageTransform,
    );
        FilePond.create(
      document.querySelector('input[name="studio_logo"]'),
      {
        labelIdle: `Drag & Drop your picture or <span class="filepond--label-action">Browse</span>`,
        imagePreviewHeight: 175,
        imageCropAspectRatio: '1:1',
        stylePanelLayout: 'compact circle',
        styleLoadIndicatorPosition: 'center bottom',
        styleProgressIndicatorPosition: 'right bottom',
        styleButtonRemoveItemPosition: 'left bottom',
        styleButtonProcessItemPosition: 'right bottom',
      }
    );
        FilePond.setOptions({
        server: { 
            url: "{{ route('upload.logo') }}",
            headers: { 
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
        },
    });
})
</script>
@endsection