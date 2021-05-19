@extends('layouts.app')
@section('src-styles')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
@endsection
@section('content')
<form action="{{ route('submit.rating') }}" method="post">
    @csrf
    <input type="hidden" name="order_id" value="{{ $order->order_id }}">
    <div class="container">
        <div class="card">
            <div class="mb-5 mt-2">
                <h3 class="text-center">Berikan rating dan review</h3>
            </div>
            <div class="d-flex">
                <div class="m-auto">
                    <div class="col-lg-12 col-sm-12">
                        <div class="row m-0">
                            <div class="notif-image">
                                <img class="notif-image-content" src="{{ $order->orders['products']['cover']['small'] }}" alt="Cover">
                            </div>
                            <div class="notif-content-more">
                                <h5>{{ $order->orders['products']['jasa_name'] }}</h5>
                                <span class="text-capitalize">Status : {{ str_replace('_', ' ', $order->orders['status']) }}</span>
                                <div><span>{{ rupiah($order->orders['details']['subtotal']) }}</span></div>
                            </div>
                        </div>
                    </div>
                    <div class="rating-star my-4">
                        <div class="form-group text-center">
                            <div class="input-rating">
                                <div class="stars">
                                    <input type="radio" id="star5" name="rating" value="5" /><label for="star5"></label>
                                    <input type="radio" id="star4" name="rating" value="4" /><label for="star4"></label>
                                    <input type="radio" id="star3" name="rating" value="3" /><label for="star3"></label>
                                    <input type="radio" id="star2" name="rating" value="2" /><label for="star2"></label>
                                    <input type="radio" id="star1" name="rating" value="1" /><label for="star1"></label>
                                </div>
                                @error('rating')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div> 
            </div>
            <div class="container">
                <div class="review-field my-4">
                    <div class="input-style input-style-always-active has-borders has-icon validate-field mb-4">
                        <textarea type="text" class="form-control validate-name" name="content" id="form1ab" placeholder="Keren banget astaga"></textarea>
                        <label for="form1ab" class="color-theme opacity-50 text-uppercase font-700 font-10">Ulasan</label>
                        @error('content')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="text-center"><button type="submit" class="btn btn-success">Submit</button></div>
                </div>
            </div>
        </div>
    </div>
</form>
@endsection
@section('scripts')
<script>
    $(document).ready(function() {
        $('input[name=rating]').on('click', function() {
            for (let i = 1; i <= 5; i++) {
                $('.star-'+i).removeClass('text-success');
            }
            for (let i = 1; i <= $(this).val(); i++) {
                $('.star-'+i).addClass('text-success');
            }
        });
    });
</script>
@endsection