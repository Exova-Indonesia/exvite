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
              <div class="card bg-13" data-card-height="400" style="background-image: url('{{asset('images/banners/about.jpg')}}')">
                <div class="card-bottom text-center mb-3">
                  <h1 class="color-white font-700 mb-0">Tentang Exova Indonesia</h1>
                  <p class="color-white">Sejarah, Tim, & Perjalanan Menuju Kebebasan</p>
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
        <div class="content">
            <div class="col-lg-12 col-sm-12">
                <h1 class="text-center">Sejarah Exova</h1>
            </div>
            <div class="row m-0 mb-5">
                <div class="col-lg-6 col-sm-12">
                    <img src="https://assets.exova.id/img/logo.png" alt="Exova Group">
                </div>
                <div class="col-lg-6 col-sm-12">
                    <span>
                        Sejarah Exova bermula ketika sang founder "Triyana Artha" ingin membangun sebuah perusahaan e-commerce.
                        Namun, sebelum mulai membangun Exova. Dia pernah membuat sebuah sosial media sederhana yang dia ciptakan karena sakit hati dengan "teman dekatnya" kala itu.
                        Tak lama, dia pun merilis layanannya tersebut yang dia beri nama "curhatskuy". Namun, setelah update versi 2.0, dia memberhentikan layanannya karena ingin serius membangun perusahaan.
                        Lantas, dalam perjalanannya membangun exova ini, dia mengajak sang co-founder "Ngurah Krisna" untuk bergabung. Dikala itu nama Exova masih "Kayana Entertainment", karena memang awalnya mereka ingin membuat sebuah game, bahkan sudah seperempat perjalanan.
                        Dan akhirnya produksi game berhenti dan mulai serius membangun Platform Penyedia Jasa Online yang akhirnya mereka beri nama Exova. Sebuah platform jual beli jasa apapun terlengkap dan termurah.
                        Exova akhirnya didaftarkan event pertamanya namun gagal, event kedua gagal, event ketiga gagal, hingga lima kali saat ini. Namun mereka tak menyerah sedikit pun. Dibalik dua orang tadi juga masih ada tim exova yang lainnya,
                        Yusa, Mamet, Prasta yang ikut serta membangun Exova sampai titik ini. Karena banyaknya kegagalan, tim Exova bertemu dengan seorang founder dan CEO yang sekarang menjadi mentor Exova, beliau adalah "Sabda Nirmala", beliau berperan  memberi masukan kepada tim Exova, yang awalnya Exova masih kurang jelas bisnisnya seperti apa sekarang  menjadi lebih jelas dan terarah.
                        Dan, resmi Exova rilis versi 2.0 sekaligus perubahan pada model bisnis, Exova sekarang berfokus pada layanan marketplace dokumentasi khusus di bidang acara, adat, tradisi, dan budaya seperti contoh: Praweddding, kelahiran, kematian, acara adat, acara agama, dsb.
                        Tagline Exova yaitu #ExovaSaveTheCulture akan bergema senusantara dan akan menjadi platform kebangaan seluruh lapisan masyarakat Indonesia!
                    </span>
                </div>
            </div>

            <div class="text-center">
                <h1 class="text-center">Tim Exova</h1>
                <div class="row text-center">
						        <!--Grid column-->
						       <div class="col-md-4 mb-3 ">

						         <h2 class="my-5 h2">Co-Leader BOT</h2>

						         <img class="rounded-circle" width="200px" alt="100x100" src="https://assets.exova.id/blogs/ngurahfix.jpg" data-holder-rendered="true">
									<p class="my-3">Ngurah Krisna<br>
										<a href="mailto:ngurahkrisna@exova.id">ngurahkrisna@exova.id</a> <br>
									+62 8311 4870 769</p>
						       </div>
						       <!--Grid column-->


									 <div class="col-md-4 mb-3 mx-hide">

									 	<h2 class="my-5 h2">Leader BOT</h2>

									 	<img class="rounded-circle" width="200px" "view="" overlay="" zoom"="" src="https://assets.exova.id/blogs/arthafix.jpg" data-holder-rendered="true" "mb-7"="">
									 		<p class="my-3">Triyana Artha <br>
									 			<a href="mailto:artha@exova.id">artha@exova.id</a> <br>
									 			+62 8135 3250 61</p>
									 </div>


									 
									 <div class="col-md-4 mb-3">

						         <h2 class="my-5 h2">Expert BOT</h2>

						         <img class="rounded-circle" width="200px" src="https://assets.exova.id/blogs/mametfix.jpg" data-holder-rendered="true">
											 <p class="my-3"> Adi Palguna <br>
											  <a href="mailto:adipalgunamv@exova.id">adipalgunamv@exova.id</a> <br>
											+62 851-5671-0356 </p>
						       </div>

									 <div class="col-md-6 mb-3">

						         <h2 class="my-5 h2">Expert Senior BOT</h2>

						         <img class="rounded-circle" width="200px" src="https://assets.exova.id/blogs/prastafix.jpg" data-holder-rendered="true">
											 <p class="my-3"> Prasta Dwiutama<br>
											 	<a href="mailto:prasta@exova.id">prasta@exova.id</a> <br>
												+62 8810 3734 6694 </p>
						       </div>

									 <div class="col-md-6 mb-3">

						         <h2 class="my-5 h2">Expert BOT</h2>

						         <img class="rounded-circle" width="200px" src="https://assets.exova.id/blogs/yusa2.jpg" data-holder-rendered="true">
											 <p class="my-3"> Yusa Widyananda <br>
												 <a href="mailto:yusakywn@exova.id">yusakywn@exova.id</a><br>
											 	+62 8199 1047 22 </p>

						       </div>

						     </div>
            </div>
            <div class="row m-0 mb-5">
                <div class="col-lg-12 col-sm-12">
                    <h1 class="text-center">Perjalanan Menuju Kebebasan</h1>
                    <p class="text-center">
                        Perjalanan menuju kebebasan bukanlah cerita ataupun sejarah. Namun, sebuah prinsip hidup seseorang yang enggan akan sempitnya kehidupan. Mereka ingin melihat dunia dari seluruh sudut pandang yang ada
                        <br/> "Kebebasan bukan berarti kriminal, namun kebebasan adalah jalan menuju nikmat kehidupan yang sesungguhnya" <br/> -CEO Exova, Artha
                    </p>
                </div>
            </div>
            <div class="col-lg-12 col-sm-12">
                <h1 class="text-center">Exova Mania</h1>
            </div>
            <div class="row m-0 mb-5 text-center">
                <div class="col-lg-4 col-sm-12">
                    <h1>150+</h1>
                    <p>Jumlah Customers Aktif</p>
                </div>
                <div class="col-lg-4 col-sm-12">
                    <h1>80+</h1>
                    <p>Jumlah Mitra Aktif</p>
                </div>
                <div class="col-lg-4 col-sm-12">
                    <h1>200+</h1>
                    <p>Jumlah Jasa Terjual</p>
                </div>
            </div>
            <div class="text-center">
                <h1>#ExovaSaveTheCulture</h1>
            </div>
        </div>
      </div>
    </div>
</div>
@endsection