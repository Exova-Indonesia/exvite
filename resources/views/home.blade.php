@extends('layouts.app')

@section('content')
<div class="home-area overlay" id="dashboard_page">
    <div class="container">
        <div id="particles-js"></div>
            <div class="row">
                <div class="col-xs-12 hidden-sm col-md-5">
                    <figure class="mobile-image wow fadeInUp" data-wow-delay="0.2s">
                        <img src="images/icons/phone.png" alt="">
                    </figure>
                </div>
                <div class="col-xs-12 col-lg-7">
                <div class="space-80 hidden-xs"></div>
                    <h1 class="wow fadeInUp" data-wow-delay="0.4s">Exova Indonesia</h1>
                <div class="space-20"></div>
                <div class="desc wow fadeInUp" data-wow-delay="0.6s">
                    <p>Exova Indonesia adalah platform tempat menyalurkan hobby jadi uang</p>
                </div>
                <div class="space-20"></div>
                    <div class="input-group mb-4 border bg-white rounded-pill p-1">
                        <div class="input-group-prepend border-0">
                            <button id="button-addon4" type="button" class="btn btn-link text-info"><i class="fa fa-search h3 mb-0"></i></button>
                        </div>
                            <input type="search" placeholder="What're you searching for?" aria-describedby="button-addon4" class="form-control bg-transparent border-0">
                    </div>
                {{--<input class="bttn-white wow font-weight-normal text-white fadeInUp text-capitalize" data-wow-delay="0.8s" placeholder="Aku mau beli . . .">--}}
            </div>
        </div>
    </div>
</div>
<section id="services_page" class="pt-5 mt-5 wow fadeInUp pb-5" data-wow-delay="0.4s">
    <div class="container">
         <div class="row">
            <div class="col-xs-12 col-md-12 col-md-offset-1">
                <div class="page-title text-center">
                    <div class="space-20"></div>
                    <h5 class="title">Layanan Kami</h5>
                    <div class="row text-center align-items-end">
                        <!-- Pricing Table-->
                        <div class="col-lg-4 mb-5 mb-lg-0">
                        </div>
                        <!-- END -->
                        <!-- Pricing Table-->
                        <div class="col-lg-4 mb-5 mb-lg-0">
                            <div class="bg-white p-5 rounded-lg shadow">
                            <h1 class="h6 text-secondary text-uppercase font-weight-bold mb-4">Jasa Exova</h1>
                            <img class="rounded-circle" src="{{ Auth::user()->avatar ?? '' }}" width="80px" height="80px" alt="avatar">
                            <div class="custom-separator my-4 mx-auto bg-primary"></div>
                            <ul class="list-unstyled my-5 text-small text-secondary text-left">
                                <li class="mb-3 text-center">
                                    Jasa Exova adalah tempat membeli/menjual jasa seperti photography, 
                                    design, videography, web apps developing hingga games
                                </li>
                            </ul>
                            <a href="#" class="btn btn-primary btn-block p-2 shadow rounded-pill">Lihat Detail</a>
                            </div>
                        </div>
                        <!-- END -->
                        <!-- Pricing Table-->
                        <div class="col-lg-4 mb-5 mb-lg-0">
                            <div class="bg-white p-5 rounded-lg shadow">
                            <h1 class="h6 text-secondary text-uppercase font-weight-bold mb-4">Exova Creations</h1>
                            <img class="rounded-circle" src="{{ Auth::user()->avatar ?? '' }}" width="80px" height="80px" alt="avatar">
                            <div class="custom-separator my-4 mx-auto bg-primary"></div>
                            <ul class="list-unstyled my-5 text-small text-secondary text-left font-weight-normal">
                                <li class="mb-3 text-center">
                                    Exova Creations adalah layanan untuk membuat sesuatu seperti 
                                    undangan online, web portofolio, hingga web company profile dengan cepat dan aman
                                </li>
                            </ul>
                            <a href="#" class="btn btn-primary btn-block p-2 shadow rounded-pill">Lihat Detail</a>
                            </div>
                        </div>
                        <!-- END -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="feature-area py-5" id="highlight">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-sm-6 wow fadeInUp" data-wow-delay="0.4s">
                <div class="page-title text-center">
                    <h5 class="title">Highlight</h5>
                        <div class="space-10"></div>
                    </div>
                <div class="row">
                <div class="col-lg-3 mb-5 mb-lg-0">
                    <div class="bg-white rounded-lg text-center shadow">
                        <div class="ribbon-wrapper">
                            <div class="ribbon bg-danger">
                                Highlight
                            </div>
                        </div>
                            <img class="w-100" src="{{ Auth::user()->avatar ?? '' }}" alt="products">
                            <div class="p-3">
                                <ul class="list-unstyled my-2 text-small text-secondary text-left font-weight-normal">
                                    <h1 class="h6 text-secondary text-left text-uppercase font-weight-bold mb-2">Exova Creations</h1>
                                    <li class="mb-3 text-left">
                                        IDR 0 - 120k
                                    </li>
                                </ul>
                            <a href="#" class="btn btn-primary btn-block p-2 shadow rounded-pill">Lihat Detail</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 mb-5 mb-lg-0">
                    <div class="bg-white rounded-lg text-center shadow">
                        <div class="ribbon-wrapper">
                            <div class="ribbon bg-danger">
                                Highlight
                            </div>
                        </div>
                            <img class="w-100" src="{{ Auth::user()->avatar ?? '' }}" alt="products">
                            <div class="p-3">
                                <ul class="list-unstyled my-2 text-small text-secondary text-left font-weight-normal">
                                    <h1 class="h6 text-secondary text-left text-uppercase font-weight-bold mb-2">Exova Creations</h1>
                                    <li class="mb-3 text-left">
                                        IDR 0 - 120k
                                    </li>
                                </ul>
                            <a href="#" class="btn btn-primary btn-block p-2 shadow rounded-pill">Lihat Detail</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</section>

<section class="py-5" id="membership">
        <div class="container-fulid">
            <div class="container">
                <div class="page-title text-center">
                    <h5 class="title">Membership</h5>
                    <div class="space-10"></div>
                </div>
                <div class="row">
                    <div class="col-md-4 col-sm-6 wow fadeInLeft" data-wow-delay="0.3s">
                        <div class="price-table">
                            <div class="price-head">
                                <h4>NewBie</h4>
                                <h2>IDR 0<span></span></h2>
                            </div>
                            <div class="price-content">
                                <ul>
                                    <li><i class="fa fa-check mr-2 text-success"></i>Buat Akun</li>
                                </ul>
                            </div>
                            <div class="price-button">
                                <a href="#">Langganan</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-6 wow fadeInUp" data-wow-delay="0.4s">
                        <div class="price-table">
                        <div class="ribbon-wrapper">
                            <div class="ribbon bg-danger text-white">
                                Best Seller
                            </div>
                        </div>
                            <div class="price-head">
                                <h4>Master</h4>
                                <h2>IDR 99,000 <span></span></h2>
                            </div>
                            <div class="price-content">
                                <ul>
                                    <li><i class="fa fa-times mr-2 text-danger"></i><del>Buat Akun</del></li>
                                </ul>
                            </div>
                            <div class="price-button">
                                <a href="#">Langganan</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-6 wow fadeInRight" data-wow-delay="0.3s">
                        <div class="price-table">
                            <div class="price-head">
                                <h4>Legends</h4>
                                <h2>IDR 149,000<span></span></h2>
                            </div>
                            <div class="price-content">
                                <ul>
                                    <li><i class="fa fa-times mr-2 text-danger"></i><del>Buat Akun</del></li>
                                </ul>
                            </div>
                            <div class="price-button">
                                <a href="#">Langganan</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

<section class="py-5" id="tutorial">
<div class="container">
    <div class="page-title text-center">
        <h5 class="title">Cara kerja</h5>
        <div class="space-10"></div>
    </div>
  <ul class="timeline">
    <li class="wow fadeInUp" data-wow-delay="0.2s">
      <div class="tl-circ"></div>
      <div class="timeline-panel">
        <div class="tl-heading">
          <h4>Register/Login</h4>
        </div>
        <div class="tl-body">
          <p>Kamu bisa daftar/login<a href="/login"> disini </a>dengan akun sosmed kamu juga kok, dijamin aman hehe</p>
        </div>
      </div>
    </li>
    
    <li class="timeline-inverted wow fadeInUp" data-wow-delay="0.2s">
      <div class="tl-circ"></div>
      <div class="timeline-panel">
        <div class="tl-heading">
          <h4>Cari apa yang kamu pengen</h4>
        </div>
        <div class="tl-body">
          <p>Dalam kolom pencarian diatas kamu bisa cari apa yang kamu pengen, 
          selain itu kamu juga bisa cari di masing - masing layanan kami</p>
        </div>
      </div>
    </li>
    
    <li class="wow fadeInUp" data-wow-delay="0.2s">
      <div class="tl-circ"></div>
      <div class="timeline-panel">
        <div class="tl-heading">
          <h4>New Apple Device Release Date</h4>
          <p><small class="text-muted"><i class="glyphicon glyphicon-time"></i> 3/22/2014</small></p>
        </div>
        <div class="tl-body">
          <p>In memory of Steve Jobs.</p>
        </div>
      </div>
    </li>
  </ul>
</div>
</section>

<section id="faq" class="questions-area section-padding">
    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <div class="page-title text-center">
                    <h5 class="title">FAQ</h5>
                    <h3 class="dark-color">Frequently Asked Questions</h3>
                    <div class="space-60"></div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12 col-sm-6">
                <div class="toggole-boxs wow fadeInUp" data-wow-delay="0.2s">
                    <h3>Apa itu Exova Indonesia ?</h3>
                    <div>
                        <p></p>
                    </div>
                        <h3>Bagaimana cara memakainya ?</h3>
                    <div>
                        <p></p>
                    </div>
                        <h3>Bagaimana cara menjadi penjual di exova ?</h3>
                    <div>
                        <p></p>
                    </div>
                        <h3>Bagaimana caranya bekerja di exova ?</h3>
                    <div>
                        <p></p>
                    </div>
                </div>
            </div>
            <div class="col-xs-12 col-sm-6">
                <div class="toggole-boxs wow fadeInUp" data-wow-delay="0.2s">
                    <h3>Apa itu Exova Indonesia ?</h3>
                    <div>
                        <p></p>
                    </div>
                        <h3>Bagaimana cara memakainya ?</h3>
                    <div>
                        <p></p>
                    </div>
                        <h3>Bagaimana cara menjadi penjual di exova ?</h3>
                    <div>
                        <p></p>
                    </div>
                        <h3>Bagaimana caranya bekerja di exova ?</h3>
                    <div>
                        <p></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="testimonial-area" id="tentang">
    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <div class="page-title text-center">
                    <h5 class="title">Our Team</h5>
                    <h3 class="dark-color">The Executive</h3>
                    <div class="space-60"></div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12">
                <div class="team-slide wow fadeInUp" data-wow-delay="0.3s">
                    <div class="team-box">
                        <div class="team-image">
                        <img src="{{ url('images/executive/arthafix.jpg') }}" alt="">
                        </div>
                        <h4>Triyana Artha</h4>
                        <h6 class="position">Founder, CEO, & CTO</h6>
                        <p>Bio</p>
                    </div>
                    <div class="team-box">
                        <div class="team-image">
                        <img src="{{ url('images/executive/ngurahfix.jpg') }}" alt="">
                        </div>
                        <h4>Ngurah Krisna</h4>
                        <h6 class="position">Co-Founder, CMO, & Developer</h6>
                        <p>Bio</p>
                    </div>
                    <div class="team-box">
                        <div class="team-image">
                        <img src="{{ url('images/executive/mametfix.jpg') }}" alt="">
                        </div>
                        <h4>Adi Palguna</h4>
                        <h6 class="position">Co-Founder & CFO</h6>
                        <p>Bio</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-xs-12 wow fadeInUp" data-wow-delay="0.2s">
                <div class="page-title text-center">
                    <h5 class="title">Contact US</h5>
                    <div class="space-60"></div>
                </div>
            </div>
        </div>
    <div class="row wow fadeInUp" data-wow-delay="0.2s">
        <div class="col-xs-12 col-sm-4">
            <div class="footer-box">
                <div class="box-icon">
                    <span class="lnr lnr-map-marker"></span>
                </div>
                    <p>Jalan Trengguli 1<br />Penatih, Denpasar Timur</p>
                </div>
                <div class="space-30 hidden visible-xs"></div>
            </div>
            <div class="col-xs-12 col-sm-4">
                <div class="footer-box">
                    <div class="box-icon">
                        <span class="lnr lnr-phone-handset"></span>
                    </div>
                        <p>+62 812-3816-9667<br />+62 831-1487-0769</p>
                </div>
                <div class="space-30 hidden visible-xs"></div>
            </div>
            <div class="col-xs-12 col-sm-4 wow fadeInUp" data-wow-delay="0.2s">
                <div class="footer-box">
                    <div class="box-icon">
                        <span class="lnr lnr-envelope"></span>
                    </div>
                        <p>support@exova.id</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
