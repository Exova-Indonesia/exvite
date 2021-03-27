@extends('seller.layouts.app')
@section('content')
        <div class="mb-4">
          <div class="divider mb-4"></div>
          <div class="d-flex content mt-0 mb-1">
            <div>
              <img
                src="../images/empty.png"
                data-src="{{ $seller->logo->small }}"
                width="85"
                class="rounded-circle me-3 shadow-xl preload-img"
              />
            </div>

            <div class="flex-grow-1">
              <h2>
                    {{ $seller->name }}
                <i
                  class="fa fa-check-circle color-blue-dark font-16 ms-1"
                ></i>
              </h2>
              @if(! auth()->user()->id == $seller->user_id)
              <a
                href="#"
                class="mt-3 btn btn-xs font-600 btn-border border-highlight color-highlight"
                >Pesan</a
              >
              <a
                href="#"
                data-menu="menu-follow"
                class="mt-3 ms-2 btn btn-xs font-600 btn-border border-highlight color-highlight"
              >
                <i class="fa fa-user"></i
                ><i class="ms-2 font-11 fa fa-check"></i>
              </a>
                @else
              <a
                href="#"
                class="mt-3 btn btn-xs font-600 btn-border border-highlight color-highlight"
                >Edit Profil
                <i class="fa fa-edit"></i>
              </a>
              <a
                href="#"
                class="mt-3 ms-2 btn btn-xs font-600 btn-border border-highlight color-highlight"
              >
               Promotions
              </a>
                @endif
            </div>
          </div>
          <div class="content">
            <h6>
                # {{ $seller->slogan }}
            </h6>
            <p class="mb-n3">
                {{ $seller->description }}
            </p>
            <br/>
            <a href="#" class="font-600 color-highlight"
              >Exova Headquartes, Denpasar</a
            >
            <p class="opacity-60 font-12 pt-2">
              Followed by <a href="#" class="color-theme font-600">PT. Artha Group Tbk</a>,
              <a href="#" class="color-theme font-600">Semen Tonasa Tbk</a>,
              <a href="#" class="color-theme font-600">Gudang Garam Tbk</a> +324
              more
            </p>
          </div>

          <div class="divider mb-2"></div>
          <div class="row mb-2 text-center">
            <div class="col-4">
              <h6 class="mb-0 color-theme">{{ $seller->portfolio->count() }}</h6>
              portfolios
            </div>
            <div class="col-4">
              <h6 class="mb-0 color-theme">1,8m</h6>
              lovers
            </div>
            <div class="col-4">
              <h6 class="mb-0 color-theme">385</h6>
              sells
            </div>
          </div>
          <div class="divider mb-3"></div>
          <div class="d-flex">
            @forelse($seller->portfolio as $f)
            <div>
              <a
                href="{{ url('products/' . strtolower(str_replace(' ','-', $f->jasa_name))) }}"
                title="{{ $f->jasa_name }}"
                data-gallery="gallery"
              >
                <img
                  src="../images/pictures/1t.jpg"
                  class="img-fluid border border-transparent"
                />
              </a>
            </div>
            @empty
                {{ Kosong }}
            @endforelse
          </div>
        </div>
        <div data-menu-load="menu-footer.html"></div>
      </div>

      <div
        id="menu-story"
        class="menu menu-box-modal bg-dark-dark"
        data-menu-width="cover"
        data-menu-height="cover"
      >
        <div class="card bg-6 rounded-0 mb-0" data-card-height="cover-full">
          <div class="card-top">
            <h1 class="color-white font-18 ms-3 mt-4">
              <img
                src="../images/pictures/6s.jpg"
                width="30"
                class="rounded-xl me-2 mt-n1"
              />
              Jane Louder
              <span class="opacity-60 font-300 font-12 ps-3 pb-3">12w</span>
              <a
                href="#"
                class="close-menu float-end me-3 mt-0 color-white font-20"
                ><i class="fa fa-times"></i
              ></a>
            </h1>
          </div>
          <div class="card-center text-center">
            <h1 class="color-white mb-3 font-50 text-uppercase font-900">
              Create
            </h1>
            <h1 class="color-white mb-3 font-38 text-uppercase font-900">
              Awesome
            </h1>
            <h1 class="color-white mb-0 font-48 text-uppercase font-900">
              Stories
            </h1>
            <p class="color-white boxed-text-l font-16 mt-4">
              Simulate Stories with ease. It's a great and super easy to use
              feature.
            </p>
            <a
              href="#"
              class="btn btn-center-s rounded-s close-menu btn-m font-13 border-gray-light font-700 text-uppercase color-white"
              >Awesome</a
            >
          </div>
          <div class="card-overlay bg-black opacity-80"></div>
        </div>
      </div>

      <div
        id="menu-follow"
        class="menu menu-box-modal rounded-m"
        data-menu-width="300"
        data-menu-height="380"
      >
        <div class="text-center">
          <img
            src="images/pictures/6t.jpg"
            width="150"
            class="mx-auto mt-4 rounded-circle"
          />
          <p class="text-center font-15 mt-4">Unfollow @jane.louder84?</p>
          <div class="divider mb-0"></div>
          <a
            href="#"
            class="color-red-dark font-15 font-600 text-center py-3 d-block"
            >Unfollow</a
          >
          <div class="divider mb-0"></div>
          <a
            href="#"
            class="close-menu color-theme font-15 text-center py-3 d-block"
            >Cancel</a
          >
@endsection

@section('scripts')
@endsection