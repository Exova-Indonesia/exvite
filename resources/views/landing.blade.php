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
            <div class="landing-shorcut-wrapper row col-lg-8 m-auto">
                <div class="col-lg-4">
                    <div class="landing-shortcut">
                        <i class="fas fa-business-time"></i>
                    </div>
                    <div class="landing-shortcut">
                        <i class="fas fa-percent"></i>
                    </div>
                    <div class="landing-shortcut">
                        <i class="fas fa-thumbs-up"></i>
                    </div>
                    <div class="landing-shortcut">
                        <i class="fa fa-map-marker" aria-hidden="true"></i>
                    </div>
                </div>
                <div class="col-lg-4">
                    <i class="fas fa-business-time"></i>
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
            <a class="font-11 col-4" href="#">Contact Support</a>
          </div>
        </div>
      </div>
    </div>
</div>
@endsection
@section('scripts')
@endsection
