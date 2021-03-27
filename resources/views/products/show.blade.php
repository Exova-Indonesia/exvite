@extends('layouts.app')
@section('content')
<div class="container">
    <div class="card card-fixed container p-0" data-card-height="400">
      <div
        class="splide single-slider slider-no-arrows slider-no-dots"
        id="single-slider-1"
      >
        <div class="splide__track">
          <div class="splide__list">
            <div class="splide__slide">
              <div class="card bg-13" data-card-height="400" style="background-image: url({{ asset('storage/DSC00422.JPG') }})">
                <div class="card-bottom text-center mb-3">
                  <h1 class="color-white font-700 mb-0">StickyMobile</h1>
                  <p class="color-white">The Menu Everyone Requested.</p>
                </div>
                <div class="card-overlay bg-gradient"></div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="card card-clear" data-card-height="400"></div>
    <div class="page-content pb-3">
      <div class="card card-full rounded-m">
        <div
          class="splide topic-slider slider-no-arrows slider-no-dots pb-2 pt-3"
          id="topic-slider-1"
        >
          <div class="splide__track">
            <div class="splide__list">
              <div class="splide__slide">
                <h1 class="font-16 d-block">
                  <button class="color-theme slide-description" data-id="detail">Detail</button>
                </h1>
              </div>
              <div class="splide__slide">
                <h1 class="font-16 d-block">
                  <button class="color-theme slide-description opacity-50" data-id="diskusi">Diskusi</button>
                </h1>
              </div>
              <div class="splide__slide">
                <h1 class="font-16 d-block">
                  <button class="color-theme slide-description opacity-50" data-id="rating">Rating & Review</button>
                </h1>
              </div>
              <div class="splide__slide">
                <h1 class="font-16 d-block">
                  <button class="color-theme slide-description opacity-50" data-id="studio">Studio</button>
                </h1>
              </div>
            </div>
          </div>
        </div>
        <div class="divider mb-0"></div>
        <div class="content">
          <p class="font-600 mb-1 color-highlight">{{ $seller->subcategory['parent']['name'] }}</p>
          <h1 class="font-30 text-capitalize">{{ $seller->jasa_name }}</h1>
          <p>
            {{ $seller->jasa_description }}
          </p>
          <div class="d-flex">
            <div class="me-auto align-self-center">
            <p class="font-400 font-10 mt-n2 mb-0 opacity-50 ">
                Start From
            </p>
              <h2 class="me-3 font-700">Rp{{ number_format($seller->jasa_price, 0) }}</h2>
                    <p class="mb-0">
                        <strong class="color-theme">4.9</strong>
                        <i class="fa fa-star color-yellow-dark"></i>
                    </p>
                    <a href="#" class="d-block">98 Reviews</a><br />
            </div>
            <div class="align-self-center">
              <a
                href="#"
                data-menu="menu-heart"
                class="icon icon-xs bg-white shadow-xl color-red-dark rounded-xl"
                ><i class="fa fa-heart"></i
              ></a>
              <a
                href="#"
                data-menu="menu-share"
                class="icon icon-xs bg-white shadow-xl color-blue-dark rounded-xl ms-1"
                ><i class="fa fa-share-alt"></i
              ></a>
              <a
                href="#"
                data-menu="menu-added"
                class="icon icon-xs bg-white shadow-xl color-brown-dark rounded-xl ms-1"
                ><i class="fa fa-shopping-bag"></i
              ></a>
            </div>
          </div>
          <div class="divider mt-3"></div>
          <!-- DOM -->
          <div id="detail-body">

          </div>
          <!-- DOM END -->
          <div class="divider mt-3"></div>
          <div class="content">
          <p class="mb-n1 color-highlight font-600 mb-n1">You may like</p>
          <h2>Similar Products</h2>
          <p>
            Products you may also like based on what you're currently looking
            at.
          </p>
        </div>

        <div class="splide double-slider slider-no-dots" id="double-slider-1">
          <div class="splide__track">
            <div class="splide__list">
              <div class="splide__slide">
                <div
                  data-card-height="300"
                  class="card mx-3 rounded-m shadow-l bg-13"
                >
                  <div class="card-bottom text-center">
                    <h2 class="color-white font-700 font-15 mb-0">
                      EazyMobile
                    </h2>
                    <p class="text-center mb-3">
                      <i class="fa fa-star color-yellow1-dark"></i>
                    </p>
                    <a
                      href="#"
                      class="btn btn-s btn-full font-13 font-600 gradient-highlight rounded-s me-2 ms-2 mb-2"
                      >View</a
                    >
                  </div>
                  <div class="card-overlay bg-gradient"></div>
                </div>
              </div>
              <div class="splide__slide">
                <div
                  data-card-height="300"
                  class="card mx-3 rounded-m shadow-l bg-27"
                >
                  <div class="card-bottom text-center">
                    <h2 class="color-white font-700 font-15 mb-0">
                      UltraMobile
                    </h2>
                    <p class="text-center mb-3">
                      <i class="fa fa-star color-yellow1-dark"></i>
                    </p>
                    <a
                      href="#"
                      class="btn btn-s btn-full font-13 font-600 gradient-highlight rounded-s me-2 ms-2 mb-2"
                      >View</a
                    >
                  </div>
                  <div class="card-overlay bg-gradient"></div>
                </div>
              </div>
              <div class="splide__slide">
                <div
                  data-card-height="300"
                  class="card mx-3 rounded-m shadow-l bg-17"
                >
                  <div class="card-bottom text-center">
                    <h2 class="color-white font-700 font-15 mb-0">
                      KolorMobile
                    </h2>
                    <p class="text-center mb-3">
                      <i class="fa fa-star color-yellow1-dark"></i>
                      <i class="fa fa-star color-yellow1-dark"></i>
                      <i class="fa fa-star color-yellow1-dark"></i>
                      <i class="fa fa-star color-yellow1-dark"></i>
                      <i class="fa fa-star color-yellow1-dark"></i>
                    </p>
                    <a
                      href="#"
                      class="btn btn-s btn-full font-13 font-600 gradient-highlight rounded-s me-2 ms-2 mb-2"
                      >View</a
                    >
                  </div>
                  <div class="card-overlay bg-gradient"></div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div
      id="menu-heart"
      class="menu menu-box-modal rounded-m"
      data-menu-hide="800"
      data-menu-width="250"
      data-menu-height="170"
    >
      <h1 class="text-center mt-3 pt-2">
        <i class="fa fa-check-circle color-green-dark fa-3x"></i>
      </h1>
      <h3 class="text-center pt-2">Saved to Favorites</h3>
    </div>

    <div
      id="menu-added"
      class="menu menu-box-modal rounded-m"
      data-menu-hide="800"
      data-menu-width="250"
      data-menu-height="170"
    >
      <h1 class="text-center mt-3 pt-2">
        <i class="fa fa-shopping-bag color-brown-dark fa-3x"></i>
      </h1>
      <h3 class="text-center pt-2">Added to Cart</h3>
    </div>
</div>
@endsection

@section('scripts')
<script>
  $(document).ready(function() {
    let content = ``;
    reload = (type) => {
      if(type === 'detail') {
        content = `
              <div class="col-12">
                <div class="row">
                  <div class="video-products col-lg-4 col-sm-12">
                    <video
                      class="video-js"
                      controls
                      preload="auto"
                      data-setup="{}">
                      <source src="https://www.youtube.com/embed/Zn8YJxP_tWM" type="video/mp4" />
                    </video>
                  </div>
                </div>
              </div>
              <div class="row ml-0">
                <div class="col-lg-6 col-sm-12">
                    <div class="row ml-0">
                      <div class="col-4">
                        <span class="font-11"><button class="color-theme opacity-50">Diskusi</button></span>
                        <p class="mt-n2 mb-1">
                          <strong class="color-theme">Yes</strong>
                        </p>
                      </div>
                      <div class="col-4">
                        <span class="font-11">Boostrap</span>
                        <p class="mt-n2 mb-1">
                          <strong class="color-theme">4.4+</strong>
                        </p>
                      </div>
                      <div class="col-4">
                        <span class="font-11">Dark Mode</span>
                        <p class="mt-n2 mb-1">
                          <strong class="color-theme">Yes</strong>
                        </p>
                      </div>
                      <div class="col-4">
                        <span class="font-11">Cordova</span>
                        <p class="mt-n2 mb-1">
                          <strong class="color-theme">Compatible</strong>
                        </p>
                      </div>
                      <div class="col-4">
                        <span class="font-11">Components</span>
                        <p class="mt-n2 mb-1">
                          <strong class="color-theme">100+</strong>
                        </p>
                      </div>
                      <div class="col-4">
                        <span class="font-11">Total Pages</span>
                        <p class="mt-n2 mb-1">
                          <strong class="color-theme">150+</strong>
                        </p>
                      </div>
                    </div>
                </div>
              <div class="row mb-0 mr-0">
              <div class="col-3">
                <div
                  class="input-style has-borders no-icon input-style-always-active validate-field mb-4 mx-1"
                >
                  <input
                    type="number"
                    class="form-control validate-number"
                    id="form1"
                    placeholder="1"
                  />
                  <label for="form1" class="color-highlight font-500"
                    >Qty</label
                  >
                  <i class="fa fa-times disabled invalid color-red-dark"></i>
                  <i class="fa fa-check disabled valid color-green-dark"></i>
                </div>
              </div>
              <div class="col-9">
                <div
                  class="input-style mx-1 has-borders no-icon input-style-always-active mb-4"
                >
                  <label for="form5" class="color-highlight font-500"
                    >Color</label
                  >
                  <select id="form5">
                    <option value="default" selected>White</option>
                    <option value="a">Space Gray</option>
                    <option value="b">Midnight Green</option>
                    <option value="c">Product (RED)</option>
                  </select>
                  <span><i class="fa fa-chevron-down"></i></span>
                  <i class="fa fa-check disabled valid color-green-dark"></i>
                  <i class="fa fa-check disabled invalid color-red-dark"></i>
                  <em></em>
                </div>
              </div>
              <div class="col-3">
                <div
                  class="input-style has-borders no-icon input-style-always-active validate-field mb-4 mx-1"
                >
                  <input
                    type="number"
                    class="form-control validate-number"
                    id="form1"
                    placeholder="1"
                  />
                  <label for="form1" class="color-highlight font-500"
                    >Qty</label
                  >
                  <i class="fa fa-times disabled invalid color-red-dark"></i>
                  <i class="fa fa-check disabled valid color-green-dark"></i>
                </div>
              </div>
              <div class="col-9">
                <div
                  class="input-style mx-1 has-borders no-icon input-style-always-active mb-4"
                >
                  <label for="form5" class="color-highlight font-500"
                    >Color</label
                  >
                  <select id="form5">
                    <option value="default" selected>White</option>
                    <option value="a">Space Gray</option>
                    <option value="b">Midnight Green</option>
                    <option value="c">Product (RED)</option>
                  </select>
                  <span><i class="fa fa-chevron-down"></i></span>
                  <i class="fa fa-check disabled valid color-green-dark"></i>
                  <i class="fa fa-check disabled invalid color-red-dark"></i>
                  <em></em>
                </div>
              </div>
            </div>
            </div>
              <h2 class="pt-1 me-3 font-700 text-end">Subtotal : Rp2,500,000</h2>
            <div class="divider mt-3"></div>
            <a
              href="#"
              class="btn btn-full btn-m font-600 rounded-s shadow-l gradient-highlight"
              >Tambahkan ke Keranjang</a
            >
          </div>
        `;
      } else if(type === 'diskusi') {
        content = `
      <div class="content">
          <h2>Diskusi</h2>
        </div>
        <div class="content">
          <div class="d-flex">
            <div class="flex-grow-1">
              <h6 class="float-start font-900 me-3">John Doe</h6>
            </div>
            <div>
              <p class="font-10 mb-0 mt-n2 opacity-40 text-end">
                21th March 2025
              </p>
            </div>
          </div>
          <p>
            It's a very complete HTML template and it's really fast as well. I
            like the way it's setup, did had to do some research before I got
            to know how it works though. I hope they will keep the support
            they deliver, because for me that's the most important part of
            buying a template.
          </p>
        </div>
        <div class="divider divider-margins mb-3"></div>
        <div class="m-auto col-lg-6">
          <div class="input-group border rounded-pill p-2">
            <div class="input-group-prepend border-0">
                <button type="button" class="btn btn-link text-info">
                    <i class="fa fa-paper-plane h3 mb-0 align-bottom" aria-hidden="true"></i>
                </button>
            </div>
            <input id="search" type="search" autocomplete="off" placeholder="Tambahkan diskusi" aria-describedby="button-addon4" class="form-control bg-transparent border-0">
          </div>
        </div>
        `;
      } else if(type === 'rating') {
        content = `
        <div class="content">
          <p class="mb-n1 color-highlight font-600 mb-n1">
            What Customers Say
          </p>
          <h2>Product Reviews</h2>
          <p>
            Awesome feedback from our customers that we wanted to share with
            you! These made our days better!
          </p>
        </div>
        <div class="content">
          <div class="d-flex">
            <div class="flex-grow-1">
              <h1 class="float-start fa-3x font-900 me-3">5.00</h1>
              <h5 class="font-11 font-500 mt-n1 mb-n1">average rating</h5>
              <span>
                <i class="fa fa-star color-yellow-dark"></i>
              </span>
            </div>
            <div>
              <h6 class="text-end">John Doe</h6>
              <p class="font-10 mb-0 mt-n2 opacity-40 text-end">
                21th March 2025
              </p>
            </div>
          </div>
          <p class="mt-3">
            It's a very complete HTML template and it's really fast as well. I
            like the way it's setup, did had to do some research before I got
            to know how it works though. I hope they will keep the support
            they deliver, because for me that's the most important part of
            buying a template.
          </p>
        </div>
        <div class="divider divider-margins mb-3"></div>
        <div class="content">
          <div class="d-flex">
            <div class="flex-grow-1">
              <h1 class="float-start fa-3x font-900 me-3">4.98</h1>
              <h5 class="font-11 font-500 mt-n1 mb-n1">average rating</h5>
              <span>
                <i class="fa fa-star color-yellow-dark"></i>
              </span>
            </div>
            <div>
              <h6 class="text-end">John Doe</h6>
              <p class="font-10 mb-0 mt-n2 opacity-40 text-end">
                21th March 2025
              </p>
            </div>
          </div>
          <p class="mt-3">
            It's a very complete HTML template and it's really fast as well. I
            like the way it's setup, did had to do some research before I got
            to know how it works though. I hope they will keep the support
            they deliver, because for me that's the most important part of
            buying a template.
          </p>
        </div>
        <a
          href="#"
          class="btn btn-full me-3 ms-3 btn-l font-13 font-600 rounded-s shadow-l mb-4 gradient-highlight"
          >Purchase Today</a
        >
        `;
      } else if(type === 'studio') {
        content = `
          <div class="col-12">
            <div class="row m-0">
              <div class="col-lg-8 col-sm-12">
                <div class="row m-0">
                  <div class="user-profile-picture m-0">
                    <img class="profile-picture" src="http://localhost:8000/storage/2021022120422715/profile/avatar/480/user-profile-20210222043850-2021022120422715.jpg" alt="Profile Picture">
                  </div>
                  <div class="mx-3 my-auto text-profile">
                    <div class="user-profile-title text-muted">@lang('profile.title')</div>
                    <div class="user-profile-content name-banner">{{ auth()->user()->name }}</div>
                  </div>
                </div>
              </div>
              <div class="col-lg-4 col-sm-12">
                <li class="list-group-item border-dashed my-2">
                    <div class="product-cart-body">
                        <div class="row m-0">
                            <div class="col-lg-6 col-sm-12">
                                <div class="color-theme"><strong> Address </strong></div>
                                <p class="mb-0 text-muted"> {{ Auth::user()->address->address_name }} </p>
                                <p class="mb-0 text-muted"> {{ Auth::user()->address->address }} </p>
                                <p class="mb-0 text-muted"> {{ Auth::user()->address->city }} </p>
                                <p class="mb-0 text-muted"> {{ Auth::user()->address->state }} </p>
                            </div>
                            <div class="col-lg-6 col-sm-12">
                                <div class="color-theme"><strong> Merchant Since </strong></div>
                                <span> {{ Auth::user()->created_at }} </span>
                            </div>
                        </div>
                    </div>
                </li>
              </div>
            </div>
            <div class="content">
              <h2>Produk lain dari {{ auth()->user()->name }}</h2>
              <p>
                Products you may also like based on what you're currently looking
                at.
              </p>
                  <div class="row mx-2">
                    <ul class="product-slide col-lg-12">
                        <li class="col-lg-3 col-sm-10 col-md-12">
                            <div class="product-seller">
                                <div class="row m-0">
                                    <div class="product-seller-pp">
                                        <img width="40px" height="40px" src="{{ asset('images/bg-01.jpg') }}" alt="">
                                    </div>
                                    <div class="product-seller-name">
                                        <span>Exova Studios</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12 col-lg-12 pe-2">
                                <div class="card card-style mr-0 mt-2 ml-2">
                                <img src="{{ asset('storage/DSC00422.JPG') }}" class="img-fluid">
                                    <div class="px-2 white-space-normal">
                                    <a href="{{ url('/products/1') }}">
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
                    </ul>
                </div>
            </div>
          </div>
        `;
      }
      $('#detail-body').html(content);
    }

    $('.slide-description').on('click', function() {
      $('.slide-description').addClass('opacity-50');
      $(this).removeClass('opacity-50');
      reload($(this).attr('data-id'));
    });
    reload('detail');
  });
</script>
@endsection