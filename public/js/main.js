

(function ($) {
    "use strict";
    var url = "http://localhost:8000/";
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
                $('#transfer_user').html(`<i class="fas fa-exclamation text-danger"></i> `+data.status);
        } else {
                $('#transfer_user').html(`<i class="fa fa-user text-success"></i> `+data.status);
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

    $('#add_banks').on('click', function () {
        $('#addbanks_form').css('display', 'block');
    })
    
    $.getJSON('http://localhost:8000/js/banks.json', function (data) {
        let banks = data;
        $.each(banks, function (i, data) {
            $('#bank_code').append('<option value="'+data.code+'">'+data.name+'</option>')
        })
    })


    // $('#bank_name').select2({
    //     placeholder: "Pilih Nama Bank",
    //     ajax: {
    //         url: 'http://localhost:8000/js/banks.json',
    //         dataType: 'json',
    //         delay: 250,
    //         processResults: function (data) {
    //             return {
    //                 results: $.map(data, function (banks) {
    //                     return {
    //                         text: banks.name,
    //                         id: banks.code,
    //                     }
    //                 })
    //             }
    //         }, cache: false
    //     }
    // })

    // $($('#bank_name').data('select2').$container).addClass('form-control')
    
    $(function () {
        $('#history_transaction').DataTable();
    })

    $('.shortcut-highlight').on('click', function () {
        $('.shortcut-highlight').removeClass('highlight-active');
        $(this).addClass('highlight-active');

        let highlight = $(this).html();
        $('.highlight-title').html(highlight);
        
        let content = '';
        $.getJSON('/highlight/all', function (data) {
            $.each(data, function (i, data) {
                if (data.services == highlight) {
                    content += `<div class="col-lg-2 mb-5 col-sm-6 mb-lg-0">
                    <a href="#" class="rounded-lg text-center">
                        <div class="ribbon-wrapper">
                            <div class="ribbon bg-danger text-white">
                                Highlight
                            </div>
                        </div>
                        <img class="w-100" src="" alt="products">
                        <div class="p-3 bg-white shadow-sm">
                            <ul class="list-unstyled my-2 text-small text-secondary text-left font-weight-normal">
                                <div>Exova Creations</div>
                                <div class="font-weight-bold">IDR 0 - 120k</div>
                            </ul>
                        </div>
                    </a>
                </div>`;
                }
            })
        });
    });

    $(document).ready(function () {
        let products = ``;
        function price(val, pm_price, subtotal) {
            let pricing, total;
            if (val == 'QRIS') {
                pricing = pm_price * subtotal;
            } else {
                pricing = parseInt(pm_price);
            }
            total = subtotal+pricing;
            $('.serv_price').html('IDR ' + numeral(pricing).format('0,0'));
            $('.buy_price').html('IDR ' + numeral(subtotal).format('0,0'));
            $('.total').html('IDR ' + numeral(total).format('0,0'));
        }
        $.getJSON('http://localhost:8000/data/payments', function (data) {
            let buy_price, subtotal = 0;
            $.each(data[1], function (i, data) {
                buy_price = parseInt(data.price)
                subtotal += buy_price;
                products += `
                <div class="col-lg-6 py-1">
                    <div class="row">
                        <div class="mx-2 border p-2">
                            <img width="80" height="80" src="https://assets.exova.id/img/1.png">
                        </div>
                        <div class="mx-2">
                            <div class="">
                                <h5 class="m-0">`+data.name+`</h5>
                            </div>
                            <div class="">
                                <span>IDR `+numeral(buy_price).format('0,0')+`</span>
                            </div>
                            <div class="">
                                <span>Quantity : `+data.quantity+`</span>
                            </div>
                            <div class="">
                                <span>SubTotal : IDR `+numeral(data.price * data.quantity).format('0,0')+`</span>
                            </div>
                            <div class="">
                                <span>`+data.note+`</span>
                            </div>
                        </div>
                    </div>
                </div>
                `;
                $('.products').html(products);
            })
            $('.payment-method-radio').on('change', function () {
                $('.payment-method-radio').removeClass('highlight-active');
                $(this).addClass('highlight-active');
                let val = $('input[name=method]:checked').val();
                $('.method').html(val);
                $.each(data[0], function (i, data) {
                if (val == data.pm_name) {
                    let content = '';
                    content += `
                    <img width="200" height="66" src="`+data.pm_icons+`" alt="Icons">
                    <p>`+data.pm_description+`</p>
                    `;
                    $('.method-desc').html(content);
                    price(val, data.pm_price, subtotal);
                    }
                })
            })
            let val = $('input[name=method]:checked').val();
            price(val, data[0][0].pm_price, subtotal);
            let content = '';
            content += `
            <img width="200" height="66" src="`+data[0][0].pm_icons+`" alt="Icons">
            <p>`+data[0][0].pm_description+`</p>
            `;
            $('.method-desc').html(content);
        })

        // $('.snap').on('click', function () {
        //     let val = $('input[name=method]:checked').val();
        //     $.ajaxSetup({
        //         headers: {
        //             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
        //             'Access-Control-Allow-Origin': '*',
        //         }
        //     });
        //     $.ajax({
        //         url: url + "payments/pay",
        //         data: 'method=' + val,
        //         type: "POST",
        //         success: function (data) {
        //             console.log(data.link)
        //             window.location = data.link;
        //         },
        //         error: function (data) {
        //             console.log(data);
        //         }
        //     })
        // })
    })



    // Cart
    $(document).ready(function () {
    reload()
    function reload() {
        $.getJSON('cart/data', function (data) {
            let total = 0;
            $.each(data, function (i, data) {
                $('.parent').each(function () {
                    if (data.cart_id == $(this).attr('data-id')) {
                        let subtotal = parseInt(data.unit_price) * parseInt(data.quantity);
                        total += parseInt(subtotal);
                        $('#subtotal-' + data.cart_id).html('IDR ' + numeral(subtotal).format('0,0'));
                        $('#notes' + data.cart_id).html(data.note);
                    }
                })
            })
        })
        $('.next').prop('disabled', true);
        }

        $.getJSON('cart/data', function (data) {
            $.each(data, function (i, data) {
                $('.parent').each(function () {
                    if (data.cart_id == $(this).attr('data-id')) {
                        $('#catatan' + data.cart_id).on('click', function () {
                            $('#catField' + data.cart_id).css('display', 'block');
                            $(this).css('display', 'none');
                        })
                        $('#fieldcat' + data.cart_id).on('change', function () {
                            let note = $('#fieldcat' + data.cart_id).val();
                            notes(data.cart_id, note);
                            $('#catField' + data.cart_id).css('display', 'none');
                            $('#catatan' + data.cart_id).css('display', 'block');
                        })
                        $('#form-quantity' + data.cart_id).keyup(function () {
                            let id = [];
                            if ($(this).val() == 0) {
                                $(this).val(1);
                            }
                            quantity(data.cart_id, $(this).val())
                                $('.sub-check:checked').each(function () {
                                    id.push($(this).attr('data-id'))
                                })
                                total(id)
                        })
                        $('#plus-quantity' + data.cart_id).on('click', function () {
                            if ($('#form-quantity' + data.cart_id).val() >= 1) {
                                let id = [];
                                let qty = parseInt($('#form-quantity' + data.cart_id).val()) + 1;
                                $('#form-quantity' + data.cart_id).val(qty);
                                quantity(data.cart_id, qty)
                                $('.sub-check:checked').each(function () {
                                    id.push($(this).attr('data-id'))
                                })
                                total(id)
                            }
                        })
                        $('#minus-quantity' + data.cart_id).on('click', function () {
                            if ($('#form-quantity' + data.cart_id).val() > 1) {
                                let id = [];
                                let qty = parseInt($('#form-quantity' + data.cart_id).val()) - 1;
                                $('#form-quantity' + data.cart_id).val(qty);
                                quantity(data.cart_id, qty)
                                $('.sub-check:checked').each(function () {
                                    id.push($(this).attr('data-id'))
                                })
                                total(id)
                            }
                        })
                        $('#fieldcat' + data.cart_id).keyup(function () {
                            if ($(this).val().length < 125) {
                                $('#countstring' + data.cart_id).html($(this).val().length+'/'+'125');
                            }
                        })
                    }
                })
            })
        })

        function total(id) {
        $.getJSON('cart/data', function (data) {
            let total = 0;
                $.each(data, function (i, data) {
                    $.each(id, function (i, ids) {
                        if (ids == data.cart_id) {
                            let subtotal = parseInt(data.unit_price) * parseInt(data.quantity);
                            total += parseInt(subtotal);
                            $('.buy_price_cart').html('IDR '+numeral(total).format('0,0'));
                        }
                    })
                })
        })
            $('.next').prop('disabled', false);
        }

        $('.next').on('click', function () {
        let cart = [];
            $('.sub-check:checked').each(function () {
             cart.push($(this).attr('data-id'))
            })
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                    'Access-Control-Allow-Origin': '*',
                }
            });
            $.ajax({
                url: url + 'cart',
                type: "POST",
                data: { cart_id: cart },
                success: function (data) {
                    window.location = 'order/details';
                },
                error: function () {
                    //
                }
            })
        })
        
        function quantity(id, qty) {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                    'Access-Control-Allow-Origin': '*',
                }
            });
            $.ajax({
                url: url + 'cart',
                type: 'PUT',
                data: {id:id, qty:qty},
                success: function (data) {
                    reload();
                },
                error: function (data) {
                },
                beforeSend: function () {
                    $('#subtotal-' + id).html('Loading...');
                }
                
            })
        }
        function notes(id, note) {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                    'Access-Control-Allow-Origin': '*',
                }
            });
            $.ajax({
                url: url + 'cart',
                type: 'PUT',
                data: {id:id, note:note},
                success: function (data) {
                    reload();
                },
                error: function (data) {
                    console.log(data);
                }
                
            })
        }

        $('.sub-check').on('change', function () {
            let allID = [];
            if ($(this).is(':checked', true)) {
                $('.delete-cart').css('display', 'block');
                $('.sub-check:checked').each(function () {
                allID.push($(this).attr('data-id'))
                })
                total(allID);
            } else {
                $('.delete-cart').css('display', 'none');
                $('.master-check').prop('checked', false);
                $('.sub-check:checked').each(function () {
                allID.push($(this).attr('data-id'))
            })
                total(allID);
            }
            if (allID == '') {
                $('.buy_price_cart').html('IDR ' + numeral(0).format('0,0'));
                $('.next').prop('disabled', true);  
            }
        })
        $('.master-check').on('click', function () {
            let allID = [];
            let allType = [];
            if ($(this).is(':checked', true)) {
                $('.sub-check').prop('checked', true);
                $('.delete-cart').css('display', 'block');
                $('.sub-check:checked').each(function () {
                allID.push($(this).attr('data-id'))
                allType.push($(this).attr('data-type'))
            })
            total(allID);
            } else {
                $('.sub-check').prop('checked', false);
                $('.delete-cart').css('display', 'none');
            }
            total(allID);
            if (allID == '') {
                $('.buy_price_cart').html('IDR ' + numeral(0).format('0,0'));
                $('.next').prop('disabled', true);
            }
        })
        $('.buy_price_cart').html('IDR ' + numeral(0).format('0,0'));

        $('.delete-cart').on('click', function (event) {
            let allID = [];
            let allType = [];
            $('.sub-check:checked').each(function () {
                allID.push($(this).attr('data-id'))
                allType.push($(this).attr('data-type'))
            })
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                    'Access-Control-Allow-Origin': '*',
                }
            });
            $.ajax({
                url: url + 'cart',
                type: 'DELETE',
                data: 'id='+allID.join(','),
                success: function (data) {
                    Toast.fire({
                    icon: 'success',
                    title: data.status,
                    })
                    window.location = window.location;
                },
                error: function (data) {
                    console.log(data);
                }
                
            })
        })
    })

    // Input Price
    $('input[name=amount]').keyup(function () {
        $(this).val(numeral($(this).val()).format('0,0'))
    })


})(jQuery);

(function($){"use strict";$(".carousel-inner .item:first-child").addClass("active");$(".mainmenu-area #primary_menu li a").on("click",function(){$(".navbar-collapse").removeClass("in");});$.scrollUp({scrollText:'<i class="lnr lnr-arrow-up"></i>',easingType:'linear',scrollSpeed:900,animation:'fade'});$('.gallery-slide').owlCarousel({loop:true,margin:0,responsiveClass:true,nav:false,autoplay:true,autoplayTimeout:4000,smartSpeed:1000,navText:['<i class="lnr lnr-chevron-left"></i>','<i class="lnr lnr-chevron-right"></i>'],responsive:{0:{items:1,},600:{items:2},1280:{items:3},1500:{items:4}}});$('.team-slide').owlCarousel({loop:true,margin:0,responsiveClass:true,nav:true,autoplay:true,autoplayTimeout:4000,smartSpeed:1000,navText:['<i class="lnr lnr-chevron-left"></i>','<i class="lnr lnr-chevron-right"></i>'],responsive:{0:{items:1,},600:{items:2},1000:{items:3}}});$(".toggole-boxs").accordion();$('#mc-form').ajaxChimp({url:'https://quomodosoft.us14.list-manage.com/subscribe/post?u=b2a3f199e321346f8785d48fb&amp;id=d0323b0697',callback:function(resp){if(resp.result==='success'){$('.subscrie-form, .join-button').fadeOut();$('body').css('overflow-y','scroll');}}});$('.mainmenu-area a[href*="#"]').not('[href="#"]').not('[href="#0"]').click(function(event){if(location.pathname.replace(/^\//,'')==this.pathname.replace(/^\//,'')&&location.hostname==this.hostname){var target=$(this.hash);target=target.length?target:$('[name='+this.hash.slice(1)+']');if(target.length){event.preventDefault();$('html, body').animate({scrollTop:target.offset().top},1000,function(){var $target=$(target);$target.focus();if($target.is(":focus")){return false;}else{$target.attr('tabindex','-1');$target.focus();};});}}});var magnifPopup=function(){$('.popup').magnificPopup({type:'iframe',removalDelay:300,mainClass:'mfp-with-zoom',gallery:{enabled:true},zoom:{enabled:true,duration:300,easing:'ease-in-out',opener:function(openerElement){return openerElement.is('img')?openerElement:openerElement.find('img');}}});};magnifPopup();$(window).on("load",function(){$('.preloader').fadeOut(500);new WOW().init({mobile:false,});});})(jQuery);

/* particlesJS.load(@dom-id, @path-json, @callback (optional)); */
particlesJS.load('particles-js', 'particles.js/particlesjs.json', function() {
    //
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





