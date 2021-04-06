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
          <p class="font-600 mb-1 color-highlight">{{ $seller->subcategory['name'] }}</p>
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
                        <strong class="color-theme">{{ $seller->jasa_rating }}</strong>
                        <i class="fa fa-star color-yellow-dark"></i>
                    </p>
                    <a href="#" class="d-block">{{ $seller->rating->count() }} Reviews</a><br />
            </div>
            <div class="align-self-center">
              <button
                role="button" data-id="{{ $seller->jasa_id }}"
                class="icon icon-xs favorit-add bg-white shadow-xl color-red-dark rounded-xl"
                ><i class="fa fa-heart"></i
              ></button>
              <button
                role="button"
                data-menu="menu-share-modal"
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
@section('modals')
 <div
    id="menu-share-modal"
    class="menu menu-box-modal rounded-m"
    data-menu-width="350"
    data-menu-height="400"
  >
    <div class="menu-title">
      <p class="color-highlight">Tap a link to</p>
      <h1>Share</h1>
      <a href="#" class="close-menu"><i class="fa fa-times-circle"></i></a>
    </div>
    <div class="divider divider-margins mt-3 mb-0"></div>
    <div class="content mt-0">
      <div class="list-group list-custom-small">
        <a href="https://www.facebook.com/sharer/sharer.php?u={{ url()->current() }}">
          <i
            class="shareToFacebook external-link fab fa-facebook-f font-12 bg-facebook color-white shadow-l rounded-l"
          ></i>
          <span>Facebook</span>
          <i class="fa fa-angle-right me-2"></i>
        </a>
        <a href="https://twitter.com/share?text={{ url()->current() }}">
          <i
            class="shareToTwitter external-link fab fa-twitter font-12 bg-twitter color-white shadow-l rounded-l"
          ></i>
          <span>Twitter</span>
          <i class="fa fa-angle-right me-2"></i>
        </a>
        <a href="https://www.linkedin.com/shareArticle?mini=true&url={{ url()->current() }}">
          <i
            class="shareToLinkedIn external-link fab fa-linkedin-in font-12 bg-linkedin color-white shadow-l rounded-l"
          ></i>
          <span>LinkedIn</span>
          <i class="fa fa-angle-right me-2"></i>
        </a>
        <a href="whatsapp://send?text={{ url()->current() }}">
          <i
            class="shareToWhatsApp external-link fab fa-whatsapp font-12 bg-whatsapp color-white shadow-l rounded-l"
          ></i>
          <span>WhatsApp</span>
          <i class="fa fa-angle-right me-2"></i>
        </a>
        <a href="mailto:?body={{ url()->current() }}">
          <i
            class="shareToMail external-link fa fa-envelope font-12 bg-mail color-white shadow-l rounded-l"
          ></i>
          <span>Email</span>
          <i class="fa fa-angle-right me-2"></i>
        </a>
        <a href="https://pinterest.com/pin/create/button/?url={{ url()->current() }}">
          <i
            class="shareToPinterest external-link fa fa-envelope font-12 bg-pinterest color-white shadow-l rounded-l"
          ></i>
          <span>Pinterest</span>
          <i class="fa fa-angle-right me-2"></i>
        </a>
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
                <div class="content">
                  <h2>Layanan Tambahan</h2>
                </div>
                <div class="col-lg-12 col-sm-12">
                  <div class="row m-0">
                      @if(! empty($seller->revisi))
                      <div class="col-lg-3 col-sm-12 input-style mx-1 has-borders no-icon input-style-always-active mb-4">
                        <label for="form5" class="color-highlight font-500">Revisi</label>
                        <select class="add-additional" id="form6">
                          <option value="0-0" selected hidden>Pilih Paket</option>
                          <option value="0-0">Tidak perlu</option>
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
                        <div class="col-lg-3 col-sm-12 input-style mx-1 has-borders no-icon input-style-always-active mb-4">
                          <label for="form5" class="color-highlight font-500">{{ $p->title }}</label>
                          <select class="add-additional" id="form5">
                            <option value="{{ $p->id . '-' . 0 }}" selected hidden>Pilih Paket</option>
                            <option value="{{ $p->id . '-' . 0 }}">Tidak perlu</option>
                            @if ($seller->additional)
                              @for($i=1; $i<10; $i++)
                              <option value="{{ $p->id . '-' . $i }}">+{{ $i * $p->add_day . ' Hari' . ' - ' . 'Rp' . number_format($i * $p->price, 0) }}</option>
                              @endfor
                            @endif
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
                @if($seller->studio['user_id'] == (auth()->user()->id ?? ''))
                  <button
                    role="button"
                    data-id = "{{ $seller->jasa_id }}"
                    class="btn btn-exova font-500 rounded-s submit-bookings text-uppercase"
                    >Booking Sekarang</button
                  >
                  @else
                  <a href="{{ URL('manage/' . strtolower(str_replace(' ','-', $seller->jasa_name))) }}"
                    class="btn btn-exova font-500 rounded-s submit-bookings text-uppercase"
                    >Edit</a
                  >
                @endif
              </div>
            </div>
          `;
        } else if(type === 'diskusi') {
          content = `
      <div class="content">
        <h2>Diskusi</h2>
      </div>
        <div class="row m-0">
          <div class="col-lg-6 col-sm-12">`;
      loadComment = (count) => {
        if(data.diskusi) {
          $.each(data.diskusi, function(i, diskusi) {
            content += `
            <div class="content">
              <div class="d-flex">
                <div class="flex-grow-1">
                  <h6 class="float-start text-exova-1 font-500 me-3"><i class="fa fa-user"></i> ` + diskusi.users.name + `</h6>
                </div>
                <div>
                  <p class="font-10 mb-0 mt-n2 opacity-40 text-end">
                    ` + new Date(diskusi.created_at).toDateString() + `
                  </p>
                </div>
              </div>
              <p>
                ` + diskusi.content + `
              </p>
              <div class="text-right">
                <span role="button" class="text-exova-2 font-500 show_comment">` + (diskusi.comment).length + ` Balasan</span> |
                <span role="button" class="text-exova-2 font-500 add_comment" data-label="comment" data-id="` + diskusi.id + `">Balas</span>
              </div>
            <div class="divider divider-margins mb-3"></div>
            <div class="container">`;
              $.each((diskusi.comment).slice(0, count), function(i, comment) {
                content += `
                  <div class="content">
                    <div class="d-flex">
                      <div class="flex-grow-1">
                        <h6 class="float-start text-exova-1 font-500 me-3"><i class="fa fa-user"></i> ` + comment.users.name + `</h6>
                      </div>
                      <div>
                        <p class="font-10 mb-0 mt-n2 opacity-40 text-end">
                          ` + new Date(comment.created_at).toDateString() + `
                        </p>
                      </div>
                    </div>
                    <p>
                      ` + comment.content + `
                    </p>
                    <div class="text-right">
                      <span role="button" class="text-exova-2 font-500 add_comment" data-label="comment" data-id="` + diskusi.id + `">Balas</span>
                  </div>
            <div class="divider divider-margins mb-3">
            </div></div>
            `;
              });
            content += `</div></div>
            `;
          });
        }
      }

      loadComment(1);

          content += `
          </div>
          <div class="col-lg-6 col-sm-12">
            <div class="col-lg-12 comment-field">
              <div class="input-style input-style-always-active has-borders has-icon validate-field mb-2">
                <textarea type="name" class="form-control validate-name" id="discuss"></textarea>
                <label for="discuss" class="color-theme opacity-50 text-uppercase font-700 font-10">Apa yang ingin kamu tanyakan?</label>
              </div>
              <div class="text-right">
                <button class="btn btn-exova submit-diskusi" data-label="` + $(this).attr('data-label') + `" data-id="` + $(this).attr('data-id') + `">Kirim</button>
              </div>
            </div>
          </div>
        </div>
          `;
        } else if(type === 'rating') {
          content = `
          <div class="content">
            <h2>Product Reviews</h2>
          </div>
          @foreach($seller->rating as $r)
          <div class="content">
            <div class="d-flex">
              <div class="flex-grow-1">
                <h1 class="float-start fa-2x font-900 me-1">{{ number_format($r->rating, 2) }}</h1>
                <span>
                  <i class="fa fa-star color-yellow-dark"></i>
                </span>
              </div>
              <div>
                <h6 class="text-end">{{ $r->users->name }}</h6>
                <p class="font-10 mb-0 mt-n2 opacity-40 text-end">
                  {{ date('F j, Y', strtotime($r->created_at)) }}
                </p>
              </div>
            </div>
            <p class="mt-3">
              {{ $r->content }}
            </p>
          </div>
          <div class="divider divider-margins mb-3"></div>
          @endforeach
          `;
        } else if(type === 'studio') {
          content = `
            <div class="col-12">
              <div class="row m-0">
                <div class="col-lg-8 col-sm-12">
                  <div class="row m-0">
                    <div class="user-profile-picture m-0">
                      <img class="profile-picture" src="{{ $seller->seller['logo']['medium'] }}" alt="Profile Picture">
                    </div>
                    <div class="mx-3 my-auto text-profile">
                      <div class="user-profile-title text-muted">@lang('seller.title')</div>
                      <div class="user-profile-content name-banner">{{ $seller->seller['name'] }}</div>
                    </div>
                  </div>
                </div>
                <div class="col-lg-4 col-sm-12">
                  <li class="list-group-item border-dashed my-2">
                      <div class="product-cart-body">
                          <div class="row m-0">
                              <div class="col-lg-6 col-sm-12">
                                  <div class="color-theme"><strong> Address </strong></div>
                                  <p class="mb-0 text-muted"> {{ $seller->seller['address']['address_name'] }} </p>
                                  <p class="mb-0 text-muted"> {{ $seller->seller['address']['address'] }} </p>
                                  <p class="mb-0 text-muted"> {{ $seller->seller['address']['district']['name'] }} </p>
                                  <p class="mb-0 text-muted"> {{ $seller->seller['address']['province']['name'] }} </p>
                              </div>
                              <div class="col-lg-6 col-sm-12">
                                  <div class="color-theme"><strong> Merchant Since </strong></div>
                                  <span> {{ date('F j, Y', strtotime($seller->seller['created_at'])) }} </span>
                              </div>
                          </div>
                      </div>
                  </li>
                </div>
              </div>
              <div class="content">
                <h2>Produk lain dari {{ $seller->seller['name'] }}</h2>
                  <div class="row mx-2">
                    <ul class="product-slide col-lg-12">
                      @forelse($seller->seller['portfolio'] as $f)
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
          `;
        }
        $('#detail-body').html(content);
        let zero = [[0, 0]];
        reloadPrice(data.jasa_price, zero);
        $('.add-additional').on('change', function() {
          let dataid = [];
          $('.add-additional').each(function() {
            // if($(this).val() !== '0-0') {
              dataid.push(($(this).val()).split('-'));
            // }
          });
          reloadPrice(data.jasa_price, dataid);
        });
        $(".submit-bookings").on("click", function () {
          let id, dataid = [];
          id = $(this).attr("data-id");
          $('.add-additional').each(function() {
            if($(this).val() !== '0-0') {
              dataid.push(($(this).val()).split('-'));
            }
          });
          $.ajax({
              url: "{{ url('cart/add') }}",
              type: "POST",
              data: { id: id, add:dataid },
              headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
              },
              success: function (data) {
                $('#menu-success-2').addClass('menu-active');
                $('.menu-hider').addClass('menu-active');
                $(".success-message").text(data.statusMessage);
                setInterval(() => {
                  // window.location = "{{ url('cart') }}";
                }, 1000);
              },
              error: function (data) {
                setInterval(() => {
                  // window.location = "{{ url('cart') }}";
                }, 1000);
              },
          });
      });
      $('.show_comment').on('click', function() {
        let comment = ``;
        comment += `
            <div class="input-style input-style-always-active has-borders has-icon validate-field mb-2">
              <textarea type="name" class="form-control validate-name" id="discuss"></textarea>
              <label for="discuss" class="color-theme opacity-50 text-uppercase font-700 font-10">Diskusi</label>
            </div>
            <div class="text-right">
              <button class="btn btn-exova submit-diskusi" data-label="` + $(this).attr('data-label') + `" data-id="` + $(this).attr('data-id') + `">Kirim</button>
            </div>
        `;
        $('.comment-field').html(comment);
      });
      $('.add_comment').on('click', function() {
        let field = ``;
        field += `
            <div class="input-style input-style-always-active has-borders has-icon validate-field mb-2">
              <textarea type="name" class="form-control validate-name" id="discuss"></textarea>
              <label for="discuss" class="color-theme opacity-50 text-uppercase font-700 font-10">Diskusi</label>
            </div>
            <div class="text-right">
              <button class="btn btn-exova submit-diskusi" data-label="` + $(this).attr('data-label') + `" data-id="` + $(this).attr('data-id') + `">Kirim</button>
            </div>
        `;
        $('.comment-field').html(field);

        $('.submit-diskusi').on('click', function() {
          $.ajax({
            url: "{{ route('diskusi.new') }}",
            type: "POST",
            data: { id: $(this).attr('data-id'), content: $('#discuss').val(), label: $(this).attr('data-label') },
            headers: {
              "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            success: function (data) {
              reload('diskusi');
            },
            error: function (data) {
              $('#menu-warning-2').addClass('menu-active');
              $('.menu-hider').addClass('menu-active');
              $(".error-message").text(JSON.parse(data.responseText).statusMessage);
            },
          });
        });
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
        $.ajax({
            url: "{{ url('cart/add') }}",
            type: "POST",
            data: { id: id },
            headers: {
              "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
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

    $(".favorit-add").on("click", function () {
        let id;
        id = $(this).attr("data-id");

        $.ajax({
            url: "{{ route('products.favorit') }}",
            type: "POST",
            data: { id: id },
            headers: {
              "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
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
