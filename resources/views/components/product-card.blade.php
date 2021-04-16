<li class="col-lg-3 col-sm-10 col-md-12 p-0" title="{{ $f->jasa_name }}">
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
        <img src="{{ $f->cover['medium'] }}" class="img-fluid image-products-250">
            <div class="px-2 white-space-normal">
            <p class="color-highlight font-600 font-11 mb-n1 pt-1">{{ $f->subcategory['parent']['name'] }}</p>
                <h5 class="font-14">{{ $f->jasa_name }}</h5>
                <p class="font-12 line-height-s mb-2">
                  {{ $f->jasa_deskripsi }}
                </p>
                <!-- <s class="font-12 m-0">Rp</s> -->
                <h5 class="font-14 price-rating">{{ rupiah($f->jasa_price) }}<span class="float-right"><i class="fa fa-star text-warning"></i>{{ $f->jasa_rating }}</span></h5>
                </a>
                <div class="d-flex footer-products">
                    <div class="likers favorit-add" role="button" data-id="{{ $f->jasa_id }}" title="Tambah ke favorit">
                        <i class="fa fa-heart"></i>
                    </div>
                    <div class="cart-add" role="button" data-id="{{ $f->jasa_id }}" title="Tambah ke keranjang">
                        <i class="fa fa-shopping-cart"></i>
                    </div>
                    <div class="comments font-11" role="button" data-id="{{ $f->jasa_id }}" data-target="#modalReview" data-toggle="modal">
                        {{ $f->rating->count() }} Reviews
                    </div>
                </div>
            </div>
        </div>
    </div>
</li>