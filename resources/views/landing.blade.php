@extends('layouts.app')
@section('content')
      <div class="page-content">
        <div
          class="splide double-slider visible-slider slider-no-dots"
          id="double-slider-1"
        >
          <div class="splide__track">
            <div class="splide__list">
              <div class="splide__slide ps-3">
                <div
                  data-card-height="220"
                  class="card shadow-xl rounded-m bg-6"
                >
                  <div class="card-bottom text-center">
                    <h4 class="color-white font-800 mb-3">PWA Ready</h4>
                  </div>
                  <div class="card-overlay bg-gradient"></div>
                </div>
              </div>
              <div class="splide__slide ps-3">
                <div
                  data-card-height="220"
                  class="card shadow-xl rounded-m bg-16"
                >
                  <div class="card-bottom text-center">
                    <h4 class="color-white font-800 mb-3">Bootstrap</h4>
                  </div>
                  <div class="card-overlay bg-gradient"></div>
                </div>
              </div>
              <div class="splide__slide ps-3">
                <div
                  data-card-height="220"
                  class="card shadow-xl rounded-m bg-19"
                >
                  <div class="card-bottom text-center">
                    <h4 class="color-white font-800 mb-3">Dark Mode</h4>
                  </div>
                  <div class="card-overlay bg-gradient"></div>
                </div>
              </div>
              <div class="splide__slide ps-3">
                <div
                  data-card-height="220"
                  class="card shadow-xl rounded-m bg-31"
                >
                  <div class="card-bottom text-center">
                    <h4 class="color-white font-800 mb-3">SCSS & RTL</h4>
                  </div>
                  <div class="card-overlay bg-gradient"></div>
                </div>
              </div>
              <div class="splide__slide ps-3">
                <div
                  data-card-height="220"
                  class="card shadow-xl rounded-m bg-33"
                >
                  <div class="card-bottom text-center">
                    <h4 class="color-white font-800 mb-3">Mobile Kit</h4>
                  </div>
                  <div class="card-overlay bg-gradient"></div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="container mb-5">
            <div class="col-lg-6 m-auto">
                <div class="input-group mb-4 border rounded-pill p-2">
                    <div class="input-group-prepend border-0">
                        <button type="button" class="btn btn-link text-info">
                            <i class="fa fa-search h3 mb-0 align-bottom" aria-hidden="true"></i>
                        </button>
                    </div>
                        <input id="search" type="search" autocomplete="off" placeholder="@lang('home.header.search')" aria-describedby="button-addon4" class="form-control bg-transparent border-0">
                </div>
            </div>
            <div class="row col-lg-8 m-auto">
                <div class="col-5 px-1">
                    <div class="card mx-0 mb-2 card-style bg-33" data-card-height="130">
                        <div class="card-bottom">
                            <h2 class="color-white text-center mb-n1">Banners</h2>
                            <p class="color-white text-center opacity-50 pb-3">
                                Promo &amp; Promo
                            </p>
                        </div>
                    </div>
                        <a class="card mx-0 mb-2 card-style bg-20" data-card-height="130">
                            <div class="card-top ps-3 pt-3">
                                <h1 class="color-white font-19">Saldo</h1>
                            </div>
                                <div class="card-center pe-3">
                                    <h4 class="color-white text-end">****6345</h4>
                                </div>
                            <div class="card-bottom ps-3 pb-2">
                                <h5 class="color-white">Rp20,000,000</h5>
                            </div>
                            <div class="card-overlay bg-gradient"></div>
                        </a>
                    </div>
                <div class="col-7 px-1">
                    <a class="card mx-0 card-style default-link bg-6" data-card-height="270">
                        <div class="card-bottom">
                            <h2 class="color-white text-center mb-n1">Banners</h2>
                            <p class="color-white text-center opacity-50 pb-3">
                                Promo &amp; Promo
                            </p>
                        </div>
                        <div class="card-overlay bg-gradient"></div>
                    </a>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="col-12">
                <div class="section-title">
                    <h2 class="s-title d-block">Terlaris <a href="{{ url('/products/terlaris') }}" class="text-capitalize font-14">Lihat Semua</a></h2>
                </div>
                <div class="row mx-2">
                    <ul class="product-slide col-lg-12">
                      @forelse($seller as $f)
                        <li class="col-lg-3 col-sm-10 col-md-12">
                            <div class="product-seller">
                                <div class="row m-0">
                                    <div class="product-seller-pp">
                                        <img width="40px" height="40px" src="{{ asset('../images/bg-01.jpg') }}" alt="">
                                    </div>
                                    <div class="product-seller-name">
                                        <span>Exova Studios</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12 col-lg-12 pe-2">
                                <div class="card card-style mr-0 mt-2 ml-2">
                                <img src="images/food/small/10s.jpg" class="img-fluid">
                                    <div class="px-2 white-space-normal">
                                    <a href="{{ url('products/' . strtolower(str_replace(' ','-', $f->jasa_name))) }}">
                                    <p class="color-highlight font-600 font-11 mb-n1 pt-1">Photography</p>
                                        <h5 class="font-14">Wedding Ceremony in Bali</h5>
                                        <p class="font-12 line-height-s mb-2">
                                        Tomato Sauce, Mozzarella, Pizza Stuff, Oregano
                                        </p>
                                        <s class="font-12 m-0">Rp2,500,000</s>
                                        <h5 class="font-14 price-rating">Rp2,250,000<span class="float-right"><i class="fa fa-star text-warning"></i> 4.5</span></h5>
                                        </a>
                                        <div class="d-flex footer-products">
                                            <div class="likers color-theme" role="button">
                                                <i class="fa fa-heart"></i>
                                            </div>
                                            <div class="cart-add color-theme" role="button">
                                                <i class="fa fa-shopping-cart"></i>
                                            </div>
                                            <div class="comments font-11" role="button">
                                                Tambah Diskusi
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </li>
                      @empty
                      @endforelse
                    </ul>
                </div>
            </div>
        </div>
        <div class="card card-style">
          <h4 class="font-28 text-center color-theme font-800 pt-3 mt-3">
            Exova
          </h4>
          <p class="boxed-text-l mb-4">
            @lang('home.header.description')
          </p>
          <div class="text-center mb-4">
            <a
              href="#"
              class="icon icon-xs rounded-sm shadow-l mr-1 bg-facebook"
              ><i class="fab fa-facebook-f"></i
            ></a>
            <a href="#" class="icon icon-xs rounded-sm shadow-l mr-1 bg-twitter"
              ><i class="fab fa-twitter"></i
            ></a>
            <a href="#" class="icon icon-xs rounded-sm shadow-l mr-1 bg-phone"
              ><i class="fa fa-phone"></i
            ></a>
            <a
              href="#"
              data-menu="menu-share"
              class="icon icon-xs rounded-sm mr-1 shadow-l bg-red-dark"
              ><i class="fa fa-share-alt"></i
            ></a>
            <a
              href="#"
              class="back-to-top icon icon-xs rounded-sm shadow-l bg-highlight color-white"
              ><i class="fa fa-arrow-up"></i
            ></a>
          </div>
          <div class="divider mb-3"></div>
          <div class="row text-center mb-3 pl-3 pr-3">
            <a class="font-11 col-4" href="#">Privacy Policy</a>
            <a class="font-11 col-4" href="#">Terms of Service</a>
            <a class="font-11 col-4" href="#">About Exova</a>
          </div>
        </div>
      </div>
    </div>
</div>
@endsection
@section('scripts')
@endsection
