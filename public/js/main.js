

(function ($) {
    "use strict";

    $(document).ready(function () {
        $('#search').keyup(function () {
            var query = $(this).val();
            if (!$(this).val()) {
                $('#result').css('display', 'none');
                $('#result').html();
            } else {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                    $.ajax({
                        url: "http://localhost:8000/search",
                        type: 'POST',
                        data: 'query='+query,
                        success: function (data) {
                            $('#result').css('display', 'block');
                            $('#result').html(data);
                        }
                });
            }
        });
    })

    /*==================================================================
    [ Validate ]*/
    var input = $('.validate-input .input100');

    $('.validate-form').on('submit',function(){
        var check = true;

        for(var i=0; i<input.length; i++) {
            if(validate(input[i]) == false){
                showValidate(input[i]);
                check=false;
            }
        }

        return check;
    });


    $('.validate-form .input100').each(function(){
        $(this).focus(function(){
           hideValidate(this);
        });
    });

    function validate (input) {
        if($(input).attr('type') == 'email' || $(input).attr('name') == 'email') {
            if($(input).val().trim().match(/^([a-zA-Z0-9_\-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([a-zA-Z0-9\-]+\.)+))([a-zA-Z]{1,5}|[0-9]{1,3})(\]?)$/) == null) {
                return false;
            }
        }
        else {
            if($(input).val().trim() == ''){
                return false;
            }
        }
    }

    function showValidate(input) {
        var thisAlert = $(input).parent();

        $(thisAlert).addClass('alert-validate');
    }

    function hideValidate(input) {
        var thisAlert = $(input).parent();

        $(thisAlert).removeClass('alert-validate');
    }

        const Toast = Swal.mixin({
          toast: true,
          position: 'top-end',
          showConfirmButton: false,
          timer: 3000
        });
        function delay(callback, ms) {
            var timer = 0;
            return function() {
              var context = this, args = arguments;
              clearTimeout(timer);
              timer = setTimeout(function () {
                callback.apply(context, args);
              }, ms || 0);
            };
        }
    $('.saldo_withdraw').keyup( delay(function () {
        var amount = $(this).val();
        var select = $('#select_form').find(":selected").val();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                'Access-Control-Allow-Origin': '*',
            }
        });
    $.ajax({
        url:'http://localhost:8000/wallet/'+select,
        type:'POST',
        data :'amount='+amount,
        dataType:'json',
        success: function (data) {
            if (data.statuscode == 400) {
                Toast.fire({
                    icon: 'error',
                    title: data.error,
                });
                $('.submit-wdrw').attr('disabled', 'disabled');
        } else {
                $('.submit-wdrw').removeAttr('disabled');
            }
        },
        beforeSend:function() {
          //
        },
        error:function() {
          //
        }
    });
    }, 500));

    $('.saldo_withdraw').keyup( delay(function () {
        var amount = $(this).val();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                'Access-Control-Allow-Origin': '*',
            }
        });
    $.ajax({
        url:'http://localhost:8000/wallet/minimum',
        type:'POST',
        data :'amount='+amount,
        dataType:'json',
        success: function (data) {
            if (data.statuscode == 400) {
                Toast.fire({
                    icon: 'error',
                    title: data.error,
                });
                $('.submit-wdrw').attr('disabled', 'disabled');
            }
        },
        beforeSend:function() {
          //
        },
        error:function() {
          //
        }
    });
    }, 500));

    $('.saldo_send').keyup( delay(function () {
        var amount = $(this).val();
        var select = $('#select_send').find(":selected").val();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                'Access-Control-Allow-Origin': '*',
            }
        });
    $.ajax({
        url:'http://localhost:8000/wallet/'+select,
        type:'POST',
        data :'amount='+amount,
        dataType:'json',
        success: function (data) {
            if (data.statuscode == 400) {
                Toast.fire({
                    icon: 'error',
                    title: data.error,
                });
                $('.submit-trf').attr('disabled', 'disabled');
        } else {
                $('.submit-trf').removeAttr('disabled');
            }
        },
        beforeSend:function() {
          //
        },
        error:function() {
          //
        }
    });
    }, 500));
    
    $('#check').click(function () {
        var user = $('#transfer_to').val();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                'Access-Control-Allow-Origin': '*',
            }
        });
    $.ajax({
        url:'http://localhost:8000/wallet/cekuser',
        type:'POST',
        data :'wallet_id='+user,
        dataType:'json',
        success: function (data) {
            if (data.statuscode == 400) {
                $('#transfer_user').html(data.status);
        } else {
                $('#transfer_user').html('<i class="fa fa-user text-success"></i> '+data.status);
            }
        },
        beforeSend:function() {
          //
        },
        error:function() {
         //
        }
    });
});
    

})(jQuery);

(function($){"use strict";$(".carousel-inner .item:first-child").addClass("active");$(".mainmenu-area #primary_menu li a").on("click",function(){$(".navbar-collapse").removeClass("in");});$.scrollUp({scrollText:'<i class="lnr lnr-arrow-up"></i>',easingType:'linear',scrollSpeed:900,animation:'fade'});$('.gallery-slide').owlCarousel({loop:true,margin:0,responsiveClass:true,nav:false,autoplay:true,autoplayTimeout:4000,smartSpeed:1000,navText:['<i class="lnr lnr-chevron-left"></i>','<i class="lnr lnr-chevron-right"></i>'],responsive:{0:{items:1,},600:{items:2},1280:{items:3},1500:{items:4}}});$('.team-slide').owlCarousel({loop:true,margin:0,responsiveClass:true,nav:true,autoplay:true,autoplayTimeout:4000,smartSpeed:1000,navText:['<i class="lnr lnr-chevron-left"></i>','<i class="lnr lnr-chevron-right"></i>'],responsive:{0:{items:1,},600:{items:2},1000:{items:3}}});$(".toggole-boxs").accordion();$('#mc-form').ajaxChimp({url:'https://quomodosoft.us14.list-manage.com/subscribe/post?u=b2a3f199e321346f8785d48fb&amp;id=d0323b0697',callback:function(resp){if(resp.result==='success'){$('.subscrie-form, .join-button').fadeOut();$('body').css('overflow-y','scroll');}}});$('.mainmenu-area a[href*="#"]').not('[href="#"]').not('[href="#0"]').click(function(event){if(location.pathname.replace(/^\//,'')==this.pathname.replace(/^\//,'')&&location.hostname==this.hostname){var target=$(this.hash);target=target.length?target:$('[name='+this.hash.slice(1)+']');if(target.length){event.preventDefault();$('html, body').animate({scrollTop:target.offset().top},1000,function(){var $target=$(target);$target.focus();if($target.is(":focus")){return false;}else{$target.attr('tabindex','-1');$target.focus();};});}}});var magnifPopup=function(){$('.popup').magnificPopup({type:'iframe',removalDelay:300,mainClass:'mfp-with-zoom',gallery:{enabled:true},zoom:{enabled:true,duration:300,easing:'ease-in-out',opener:function(openerElement){return openerElement.is('img')?openerElement:openerElement.find('img');}}});};magnifPopup();$(window).on("load",function(){$('.preloader').fadeOut(500);new WOW().init({mobile:false,});});})(jQuery);


/* particlesJS.load(@dom-id, @path-json, @callback (optional)); */
particlesJS.load('particles-js', 'particles.js/particlesjs.json', function() {
    console.log('callback - particles.js config loaded');
});
/*
window.onscroll = function() {scrollFunction()};

function scrollFunction() {
  if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
      document.getElementById("navbar").style.backgroundColor = "rgb(18 40 88)";
  } else {
      document.getElementById("navbar").style.backgroundColor = "rgb(18 40 88)";
  }
}
*/

let steps = [
    {
      "selector": "[data-component=intro]",
      "step": 1,
      "title": "Selamat datang di Exova Indonesia",
      "content": "Yuk biar makin kenal sama exova, ikutin tour ini bentar aja ;)",
      "image": ""
    },
    {
        "selector": "[data-component=intro_2]",
        "step": 2,
        "title": "Di Exova bisa ngapain aja sih ?",
        "content": "Oke, jadi di Exova itu kalian bisa menjual ataupun membeli produk/jasa",
        "image": ""
    },
    {
        "selector": "[data-component=services_page]",
        "step": 3,
        "title": "Terus layanan Exova ada apa aja ?",
        "content": "Saat ini baru ada 2 layanan Exova yaitu, Exova Jasa dan Exova Creations",
        "image": ""
    },
    {
        "selector": "[data-component=jasa]",
        "step": 4,
        "title": "Apaan tuh Exova Jasa ?",
        "content": "Exova Jasa adalah sebuah layanan dimana kamu bisa jual jasa kamu ataupun beli jasa dari penjual lainnya",
        "image": ""
    },
    {
        "selector": "[data-component=creations]",
        "step": 5,
        "title": "Lalu apaan tuh Exova Creations ?",
        "content": "Exova Creations adalah layanan yang bisa kamu gunakan untuk membuat undangan online, membuat website pribadi kamu, mendesain produk kamu, dan juga membuat website company profile",
        "image": ""
    },
    {
        "selector": "[data-component=wallet]",
        "step": 6,
        "title": "Satu lagi kenalan yuk sama Exova Wallet",
        "content": "Dengan Exova Wallet Kamu bisa dengan mudah menerima refund transaksi, saling kirim uang dengan teman, dan juga untuk menampung pendapatan kamu tentunya",
        "image": ""
    },
    {
        "selector": "[data-component=withdraw]",
        "step": 7,
        "title": "Withdraw",
        "content": "Kamu bisa mencairkan saldo kamu ke rekening kamu",
        "image": ""
    },
    {
        "selector": "[data-component=send]",
        "step": 7,
        "title": "Send",
        "content": "Dengan fitur Send ini kamu bisa kirim uang untuk temen, pacar, gebetan, sahabat, atau keluarga kamu",
        "image": ""
    },
    {
        "selector": "[data-component=mywallet]",
        "step": 8,
        "title": "My Wallet",
        "content": "Tentu saja dengan Kamu klik ini, Kamu akan diarahkan ke detail dari Wallet Kamu",
        "image": ""
    },
    {
        "selector": "[data-component=wallethistory]",
        "step": 9,
        "title": "History Transaksi",
        "content": "Kamu bisa melacak history transaksi kamu dengan fitur ini",
        "image": ""
    },
    {
        "selector": "[data-component=highlight]",
        "step": 10,
        "title": "Higlight",
        "content": "Fitur highlight adalah fitur promosi berbayar milik Exova, kamu bisa menggunakan fitur ini dengan gratis jika kamu langganan membership",
        "image": ""
    },
    {
        "selector": "[data-component=membership]",
        "step": 11,
        "title": "Membership",
        "content": "Fitur membership akan memberikan kamu banyak keuntungan, dengan berlangganan fitur ini kamu akan dapat keuntungan sesuai paket yang kamu pilih",
        "image": ""
    },
    {
        "selector": "[data-component=faq]",
        "step": 12,
        "title": "Frequently Asked Question",
        "content": "Kamu bisa temukan jawaban atas pertanyaan kamu disini yaa",
        "image": ""
    },
    {
        "selector": "[data-component=kontak]",
        "step": 13,
        "title": "Kontak Kami",
        "content": "Atau kamu juga bisa hubungi Kami jika ada pertanyaan yang ingin ditanyakan, kami tersedia 24/7 kok ;)",
        "image": ""
    },
    {
        "selector": "[data-component=follow]",
        "step": 14,
        "title": "Yuk Ikutin Kami",
        "content": "Dapetin berita dan konten menarik setiap harinya dengan mengikuti kami di sosial media",
        "image": ""
    },
    {
        "selector": "[data-component=team]",
        "step": 15,
        "title": "Salam kenal ya",
        "content": "Dan terakhir ini adalah Kami yang ada dibalik Exova Indonesia :)",
        "image": ""
    },
  ]

//var tourguide = new Tourguide({steps: steps});
    //tourguide.start();




/* Fungsi formatRupiah */
//Format Number
var rupiah = document.getElementById('amount');
rupiah.addEventListener('keyup', function(e){
    // tambahkan 'Rp.' pada saat form di ketik
    // gunakan fungsi formatRupiah() untuk mengubah angka yang di ketik menjadi format angka
    rupiah.value = formatRupiah(this.value);
});


function formatRupiah(angka, prefix){
    var number_string = angka.replace(/[^,\d]/g, '').toString(),
    split   		= number_string.split(','),
    sisa     		= split[0].length % 3,
    rupiah     		= split[0].substr(0, sisa),
    ribuan     		= split[0].substr(sisa).match(/\d{3}/gi);

    // tambahkan titik jika yang di input sudah menjadi angka ribuan
    if(ribuan){
        separator = sisa ? '.' : '';
        rupiah += separator + ribuan.join(',');
    }

    rupiah = split[1] != undefined ? rupiah + '.' + split[1] : rupiah;
    return prefix == undefined ? rupiah : (rupiah ? + rupiah : '');
}
