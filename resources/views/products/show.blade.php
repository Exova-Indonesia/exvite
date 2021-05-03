@extends('layouts.app')
@section('src-scripts')
  <script src="https://cdn.plyr.io/3.6.5/plyr.js"></script>
@endsection
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
              <h2 class="me-3 font-700">{{ rupiah($seller->jasa_price) }}</h2>
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
          <div class="row m-0">
            @forelse($seller->videos->take(2) as $p)
            <div class="col-lg-6 col-sm-12 py-1">
              <video class="player-video" id="player{{ $loop->iteration }}" playsinline controls>
                <source src="{{ storage($p->path) }}" type="video/mp4" />
              </video>
            </div>
            @empty
            @endforelse
          </div>
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
                <x-productcard :products="$f" />
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
    const players = Array.from(document.querySelectorAll('.player-video')).map(p => new Plyr(p, {
      settings: ['quality'],
    }));

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
                    @foreach($seller->pictures->where('id', '!=', $seller->jasa_thumbnail) as $p)
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
                      @foreach($seller->additional as $p)
                        <div class="col-lg-3 col-sm-12 input-style mx-1 has-borders no-icon input-style-always-active mb-4">
                          <label for="form5" class="color-highlight font-500">{{ $p->title }}</label>
                          <select class="add-additional" id="form5">
                            <option value="{{ $p->id . '-' . 0 }}" selected hidden>Pilih Paket</option>
                            <option value="{{ $p->id . '-' . 0 }}">Tidak perlu</option>
                            @if ($seller->additional)
                              @for($i=1; $i<10; $i++)
                              <option value="{{ $p->id . '-' . $i }}">{{ $i * $p->quantity . 'X ' . '+' . $p->add_day . ' Hari' . ' - ' . rupiah($i * $p->price) }}</option>
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
                @if($seller->seller['user_id'] == (auth()->user()->id ?? ''))
                  <a href="{{ URL('manage/' . strtolower(str_replace(' ','-', $seller->jasa_name))) }}"
                    class="btn btn-exova font-500 rounded-s submit-bookings text-uppercase"
                    >Edit</a
                  >
                  @else
                  <button
                    role="button"
                    data-id = "{{ $seller->jasa_id }}"
                    class="btn btn-exova font-500 rounded-s submit-bookings text-uppercase"
                    >Booking Sekarang</button
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
              $.each((diskusi.comment), function(i, comment) {
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
            <div class="divider divider-margins mb-3">
            </div></div>
            `;
              });
            content += `</div></div>
            `;
          });
        } else {
          content += `
          <div class="text-center">
            {{ "Belum Ada Diskusi" }}
          </div>
          `;
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
                <button class="btn btn-exova submit-diskusi" data-label="diskusi" data-id="{{ $seller->jasa_id }}">Kirim</button>
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
          @forelse($seller->rating as $r)
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
          @empty
          <div class="text-center">
            {{ "Belum Ada Rating & Review" }}
          </div>
          @endforelse
          `;
        } else if(type === 'studio') {
          content = `
            <div class="col-12">
              <div class="row m-0 mb-5">
                <div class="col-lg-8 col-sm-12">
                  <div class="row m-0">
                    <div class="user-profile-picture m-0">
                      <img class="profile-picture" src="{{ $seller->seller['logo']['medium'] }}" alt="Profile Picture">
                    </div>
                    <div class="mx-3 my-auto text-profile">
                      <div class="user-profile-title text-muted">@lang('seller.title')</div>
                      <div class="user-profile-content name-banner">{{ $seller->seller['name'] }}</div>
                      <div class="user-profile-title text-capitalize font-14">Owned by <b> {{ $seller->seller['owner']['name'] }} </b></div>
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
                  <li>
                    <div>
                      <button onclick="event.preventDefault();
                      document.getElementById('chat-form').submit()"; data-id="{{ $seller->seller['owner']['id'] }}" type="button" class="chat btn btn-success">Hubungi Owner</button>
                    </div>
                    <form id="chat-form" action="{{ route('chat') }}" method="POST" class="d-none">
                        @csrf
                        <input name="id" type="hidden" value="{{ $seller->seller['owner']['id'] }}" />
                    </form>
                  </li>
                </div>
              </div>
              <div class="divider m-0"></div>
              <div class="content mt-5">
                <h2>Produk lain dari {{ $seller->seller['name'] }}</h2>
                  <div class="row mx-2">
                    <ul class="product-slide col-lg-12">
                      @forelse($seller->seller['portfolio'] as $f)
                        <x-productcard :products="$f" />
                      @empty
                      @endforelse
                    </ul>
                </div>
              </div>
            </div>
          `;
        }
        $('#detail-body').html(content);

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
      $('.add_comment').on('click', function() {
        let field = ``;
        field += `
            <div class="input-style input-style-always-active has-borders has-icon validate-field mb-2">
              <textarea type="name" class="form-control validate-name" id="discuss"></textarea>
              <label for="discuss" class="color-theme opacity-50 text-uppercase font-700 font-10">Balas</label>
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
    $.ajax({
      url: "{{ route('products.views') }}",
      type: "POST",
      data: { id: "{{ auth()->user()->id }}", jasid:"{{ $seller->jasa_id }}" },
      headers: {
        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
      },
    });
  });
</script>
@endsection
