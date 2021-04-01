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
              <div class="card bg-13" data-card-height="400" style="background-image: url({{ $seller->cover['large'] }})">
                <!-- <div class="card-overlay bg-gradient"></div> -->
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
                  <button class="color-theme slide-description opacity-50" data-id="rating">Review</button>
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
        <div class="divider m-0"></div>
        <div class="content">
          <p class="font-600 mb-1 color-highlight">{{ $seller->subcategory['parent']['name'] . ' - ' . $seller->subcategory['name'] }}</p>
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
              <button
                role="button"
                class="icon icon-xs bg-white shadow-xl color-red-dark rounded-xl"
                ><i class="fa fa-heart"></i
              ></button>
              <button
                href="#"
                data-menu="menu-share"
                class="icon icon-xs bg-white shadow-xl color-blue-dark rounded-xl ms-1"
                ><i class="fa fa-share-alt"></i
              ></button>
              <button
                role="button" data-id="{{ $seller->jasa_id }}"
                class="icon icon-xs cart-add bg-white shadow-xl color-brown-dark rounded-xl ms-1"
                ><i class="fa fa-shopping-cart"></i
              ></button>
            </div>
          </div>
          <div class="divider mt-3"></div>
          <!-- DOM -->
          <div id="detail-body">

          </div>
          <!-- DOM END -->
          <div class="divider mt-3"></div>
          <div class="content">
          <!-- <p class="mb-n1 color-highlight font-600 mb-n1">You may like</p> -->
          <h2>Produk Sejenis</h2>
        </div>
          <div class="row mx-2">
            <ul class="product-slide col-lg-12">
              @forelse($similliar as $f)
                <li class="col-lg-3 col-sm-10 col-md-12" title="{{ $f->jasa_name }}">
                    <a class="product-seller" href="{{ url('/studios/' . strtolower(str_replace(' ','-',$f->seller['name']))) }}" title="{{ $f->seller['name'] }}">
                        <div class="row m-0">
                            <div class="product-seller-pp">
                                <img width="40px" height="40px" src="{{ $f->seller['logo']['small'] }}" alt="Picture">
                            </div>
                            <div class="product-seller-name">
                                <span>{{ explode(' ', $f->seller['name'])[0] }}</span>
                            </div>
                        </div>
                    </a>
                    <div class="col-sm-12 col-lg-12 pe-2">
                        <div class="card card-style mr-0 mt-2 text-ellipsis ml-2">
                          <a class="d-block" href="{{ url('products/' . strtolower(str_replace(' ','-', $f->jasa_name))) }}">
                          <div class="img-fluid image-products-250" style="background-image: url({{ $f->cover['medium'] }})"></div>
                          <!-- <img src="{{ $f->cover['medium'] }}" class="img-fluid image-products-250"> -->
                            <div class="px-2 white-space-normal">
                            <p class="color-highlight font-600 font-11 mb-n1 pt-1">{{ $f->subcategory['parent']['name'] }}</p>
                                <h5 class="font-14">{{ $f->jasa_name }}</h5>
                                <p class="font-12 line-height-s mb-2">
                                  {{ $f->jasa_deskripsi }}
                                </p>
                                <!-- <s class="font-12 m-0">Rp</s> -->
                                <h5 class="font-14 price-rating">Rp{{ number_format($f->jasa_price, 0) }}<span class="float-right"><i class="fa fa-star text-warning"></i>{{ $f->jasa_rating }}</span></h5>
                                </a>
                                <div class="d-flex footer-products">
                                    <div class="likers" role="button" data-id="{{ $f->jasa_id }}" title="Tambah ke favorit">
                                        <i class="fa fa-heart"></i>
                                    </div>
                                    <div class="cart-add" role="button" data-id="{{ $f->jasa_id }}" title="Tambah ke keranjang">
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
</div>
@endsection

@section('scripts')
<script>
  $(document).ready(function() {
    let content = ``, subprice = ``;
    reloadPrice = (price, additional) => {
      let total = 0;
      $.each(additional, function(i, index) {
        $.getJSON("{{ url('web/v2/products/additional') }}/" + index[0], function(data) {
          if(data !== null) {
            subtotal = parseInt(data.price ?? 0) * parseInt(index[1]);
            total = subtotal;
            price = (total ?? 0) + price;
            subprice = `<h2 class="pt-1 me-3 font-700 text-end">Subtotal : Rp`+ numeral(price).format('0,0') + `</h2>`;
            // console.log(price);
          }
          $('.sub-price').html(subprice);
        });
      });
    }
    reload = (type) => {
      $.getJSON("{{ url('web/v2/products/' . $seller->jasa_id) }}", function(data) {
        if(type === 'detail') {
          content = `
                <div class="col-12">
                  <div class="row">
                    @foreach($seller->pictures as $p)
                    <div class="col-lg-4 col-sm-12">
                      <img class="products-picture" src="{{ $p->medium }}">
                    </div>
                    @endforeach
                  </div>
                </div>
                <div class="row m-0">
                  <div class="col-lg-6 col-sm-12">
                      <div class="row ml-0">
                      @if(! empty($seller->revisi))
                      <div class="col-4">
                        <span class="font-11"><button class="color-theme opacity-50">Revisi</button></span>
                        <p class="mt-n2 mb-1">
                          <strong class="color-theme">Yes</strong>
                        </p>
                      </div>
                      @endif
                      @foreach($seller->additional as $p)
                        <div class="col-4">
                          <span class="font-11"><button class="color-theme opacity-50">{{ $p->title }}</button></span>
                          <p class="mt-n2 mb-1">
                            <strong class="color-theme">Yes</strong>
                          </p>
                        </div>
                      @endforeach
                      </div>
                    </div>
                      <div class="col-lg-6 col-sm-12">
                      @if(! empty($seller->revisi))
                      <div class="input-style mx-1 has-borders no-icon input-style-always-active mb-4">
                        <label for="form5" class="color-highlight font-500">Revisi</label>
                        <select class="add-additional" id="form6">
                          <option value="0-0" selected>Tidak perlu</option>
                          @for($i=1; $i<10; $i++)
                          <option value="{{ $seller->revisi['id'] . '-' . $i }}">{{ $i * $seller->revisi['count'] . 'X' . ', ' . '+' . $seller->revisi['add_day'] . ' Hari' . ' - ' . 'Rp' . number_format($i * $seller->revisi['price'], 0) }}</option>
                          @endfor
                        </select>
                        <span><i class="fa fa-chevron-down"></i></span>
                        <i class="fa fa-check disabled valid color-green-dark"></i>
                        <i class="fa fa-check disabled invalid color-red-dark"></i>
                        <em></em>
                      </div>
                      @endif
                      @foreach($seller->additional as $p)
                        <div class="input-style mx-1 has-borders no-icon input-style-always-active mb-4">
                          <label for="form5" class="color-highlight font-500">{{ $p->title }}</label>
                          <select class="add-additional" id="form5">
                            <option value="0-0" selected>Tidak perlu</option>
                            @for($i=1; $i<10; $i++)
                            <option value="{{ $p->id . '-' . $i }}">+{{ $i * $p->add_day . ' Hari' . ' - ' . 'Rp' . number_format($i * $p->price, 0) }}</option>
                            @endfor
                          </select>
                          <span><i class="fa fa-chevron-down"></i></span>
                          <i class="fa fa-check disabled valid color-green-dark"></i>
                          <i class="fa fa-check disabled invalid color-red-dark"></i>
                          <em></em>
                        </div>
                      @endforeach
                      </div>
                  </div>
                <div class="sub-price"></div>
              <div class="divider my-3"></div>
                <div class="text-center">
                  <a
                    href="#"
                    class="btn btn-exova font-500 rounded-s"
                    >Booking Sekarang</a
                  >
              </div>
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
        let zero = [[0, 0]];
        reloadPrice(data.jasa_price, zero);
        $('.add-additional').on('change', function() {
          let dataid = [];
          $('.add-additional').each(function() {
            // if($(this).val() !== '0-0') {
              dataid.push($(this).val().split('-'));
            // }
          });
          reloadPrice(data.jasa_price, dataid);
        });
      });
    }

    $('.slide-description').on('click', function() {
      $('.slide-description').addClass('opacity-50');
      $(this).removeClass('opacity-50');
      reload($(this).attr('data-id'));
    });
    reload('detail');

    $(".cart-add").on("click", function () {
        let id;
        id = $(this).attr("data-id");

        $.ajaxSetup({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
                "Access-Control-Allow-Origin": "*",
            },
        });
        $.ajax({
            url: "{{ url('cart/add') }}",
            type: "POST",
            data: { id: id },
            success: function (data) {
              $('#menu-success-2').addClass('menu-active');
              $('.menu-hider').addClass('menu-active');
              $(".success-message").text(data.statusMessage);
            },
            error: function (data) {
              $('#menu-warning-2').addClass('menu-active');
              $('.menu-hider').addClass('menu-active');
              $(".error-message").text(JSON.parse(data.responseText).statusMessage);
            },
        });
    });
  });
</script>
@endsection