(function ($) {
    "use strict";
    let url = "https://exvite.test/";
    $(document).ready(function () {
        $("#search").keyup(function (e) {
            let query = $(this).val();
            if (!$(this).val()) {
                $("#result").css("display", "none");
                $("#result").html();
            } else {
                if (e.keyCode === 13) {
                    window.location =
                        url + "search/" + $(this).val().replace(/\s/g, "");
                }
                $.ajaxSetup({
                    headers: {
                        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                            "content"
                        ),
                    },
                });
                $.ajax({
                    url: url + "autocomplete",
                    type: "POST",
                    data: "query=" + query,
                    success: function (data) {
                        $("#result").css("display", "block");
                        $("#result").html(data);
                    },
                    error: function (data) {
                        $("#result").css("display", "none");
                        // console.log(data);
                    },
                });
            }
        });
    });

    $("#button-addon4").on("click", function () {
        $.ajaxSetup({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
        });
        $.ajax({
            url: url + "search",
            type: "POST",
            data: "query=" + $("#search").val(),
            success: function (data) {},
            error: function (data) {
                $("#result").css("display", "none");
                console.log(data);
            },
        });
    });

    // $("#search").on("click", function () {
    //     $("#result").css("display", "block");
    //     let content = `
    //         <ul class="autocomplete d-flex">
    //             <li class="nav-link text-capitalize"><a href="">Wedding Photography</a></li>
    //             <li class="nav-link text-capitalize"><a href="">Casual Videography</a></li>
    //         </ul>
    //     `;
    //     $("#result").html(content);
    // });
    // $("#search").on("blur", function () {
    //     $("#result").css("display", "none");
    // });

    /*==================================================================
    [ Validate ]*/
    let input = $(".validate-input .input100");

    $(".validate-form").on("submit", function () {
        let check = true;

        for (let i = 0; i < input.length; i++) {
            if (validate(input[i]) == false) {
                showValidate(input[i]);
                check = false;
            }
        }

        return check;
    });

    $(".validate-form .input100").each(function () {
        $(this).focus(function () {
            hideValidate(this);
        });
    });

    function validate(input) {
        if (
            $(input).attr("type") == "email" ||
            $(input).attr("name") == "email"
        ) {
            if (
                $(input)
                    .val()
                    .trim()
                    .match(
                        /^([a-zA-Z0-9_\-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([a-zA-Z0-9\-]+\.)+))([a-zA-Z]{1,5}|[0-9]{1,3})(\]?)$/
                    ) == null
            ) {
                return false;
            }
        } else {
            if ($(input).val().trim() == "") {
                return false;
            }
        }
    }

    function showValidate(input) {
        let thisAlert = $(input).parent();

        $(thisAlert).addClass("alert-validate");
    }

    function hideValidate(input) {
        let thisAlert = $(input).parent();

        $(thisAlert).removeClass("alert-validate");
    }

    const Toast = Swal.mixin({
        toast: true,
        position: "top-end",
        showConfirmButton: false,
        timer: 3000,
    });
    function delay(callback, ms) {
        let timer = 0;
        return function () {
            let context = this,
                args = arguments;
            clearTimeout(timer);
            timer = setTimeout(function () {
                callback.apply(context, args);
            }, ms || 0);
        };
    }
    $(".saldo_withdraw").keyup(
        delay(function () {
            let amount = $(this).val();
            let select = $("#select_form").find(":selected").val();
            $.ajaxSetup({
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                        "content"
                    ),
                    "Access-Control-Allow-Origin": "*",
                },
            });
            $.ajax({
                url: url + "wallet/" + select,
                type: "POST",
                data: "amount=" + amount,
                dataType: "json",
                success: function (data) {
                    if (data.statuscode == 400) {
                        Toast.fire({
                            icon: "error",
                            title: data.error,
                        });
                        $(".submit-wdrw").attr("disabled", "disabled");
                    } else {
                        $(".submit-wdrw").removeAttr("disabled");
                    }
                },
                beforeSend: function () {
                    //
                },
                error: function () {
                    //
                },
            });
        }, 500)
    );

    $(".saldo_withdraw").keyup(
        delay(function () {
            let amount = $(this).val();
            $.ajaxSetup({
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                        "content"
                    ),
                    "Access-Control-Allow-Origin": "*",
                },
            });
            $.ajax({
                url: url + "wallet/minimum",
                type: "POST",
                data: "amount=" + amount,
                dataType: "json",
                success: function (data) {
                    if (data.statuscode == 400) {
                        Toast.fire({
                            icon: "error",
                            title: data.error,
                        });
                        $(".submit-wdrw").attr("disabled", "disabled");
                    }
                },
                beforeSend: function () {
                    //
                },
                error: function () {
                    //
                },
            });
        }, 500)
    );

    $(".saldo_send").keyup(
        delay(function () {
            let amount = $(this).val();
            let select = $("#select_send").find(":selected").val();
            $.ajaxSetup({
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                        "content"
                    ),
                    "Access-Control-Allow-Origin": "*",
                },
            });
            $.ajax({
                url: url + "wallet/" + select,
                type: "POST",
                data: "amount=" + amount,
                dataType: "json",
                success: function (data) {
                    if (data.statuscode == 400) {
                        Toast.fire({
                            icon: "error",
                            title: data.error,
                        });
                        $(".submit-trf").attr("disabled", "disabled");
                    } else {
                        $(".submit-trf").removeAttr("disabled");
                    }
                },
                beforeSend: function () {
                    //
                },
                error: function () {
                    //
                },
            });
        }, 500)
    );

    $("#check").click(function () {
        let user = $("#transfer_to").val();
        $.ajaxSetup({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
                "Access-Control-Allow-Origin": "*",
            },
        });
        $.ajax({
            url: url + "wallet/cekuser",
            type: "POST",
            data: "wallet_id=" + user,
            dataType: "json",
            success: function (data) {
                if (data.statuscode == 400) {
                    $("#transfer_user").html(
                        `<i class="fas fa-exclamation text-danger"></i> ` +
                            data.status
                    );
                } else {
                    $("#transfer_user").html(
                        `<i class="fa fa-user text-success"></i> ` + data.status
                    );
                }
            },
            beforeSend: function () {
                //
            },
            error: function () {
                //
            },
        });
    });

    $("#add_banks").on("click", function () {
        $("#addbanks_form").css("display", "block");
    });

    $.getJSON(url + "js/banks.json", function (data) {
        let banks = data;
        $.each(banks, function (i, data) {
            $("#bank_code").append(
                '<option value="' + data.code + '">' + data.name + "</option>"
            );
        });
    });

    // $('#bank_name').select2({
    //     placeholder: "Pilih Nama Bank",
    //     ajax: {
    //         url: 'http://exvite.test/js/banks.json',
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
        $("#history_transaction").DataTable();
    });

    $(document).ready(function () {
        $("#table-products").DataTable();
    });

    // $(".shortcut-highlight").on("click", function () {
    //     $(".shortcut-highlight").removeClass("highlight-active");
    //     $(this).addClass("highlight-active");

    //     let highlight = $(this).html();
    //     $(".highlight-title").html("Exova " + highlight);

    //     let content = "";
    //     $.getJSON("/highlight/all", function (data) {
    //         $.each(data, function (i, data) {
    //             if (data.type == highlight) {
    //                 content +=
    //                     `<div class="col-lg-2 mb-5 col-sm-6 mb-lg-0">
    //                 <a href="#" class="rounded-lg text-center">
    //                     <div class="ribbon-wrapper">
    //                         <div class="ribbon bg-danger text-white">
    //                             Highlight
    //                         </div>
    //                     </div>
    //                     <img class="w-100 p-2" src="` +
    //                     data.product["jasa_thumbnail"] +
    //                     `" alt="products">
    //                     <div class="p-2 bg-white shadow-sm">
    //                         <ul class="list-unstyled text-small text-secondary text-left font-weight-normal">
    //                             <div>` +
    //                     data.product["jasa_name"] +
    //                     `</div>
    //                             <div class="font-weight-bold">IDR ` +
    //                     numeral(data.product["jasa_price"]).format("0,0") +
    //                     `</div>
    //                         </ul>
    //                     </div>
    //                 </a>
    //             </div>`;
    //             }
    //             $(".highlight-content").html(content);
    //         });
    //     });
    // });

    // Cart
    $(document).ready(function () {
        reload();
        function reload() {
            $.getJSON(url + "cart/data", function (data) {
                let total = 0;
                $.each(data, function (i, data) {
                    $(".parent").each(function () {
                        if (data.cart_id == $(this).attr("data-id")) {
                            let subtotal =
                                parseInt(data.unit_price) *
                                parseInt(data.quantity);
                            total += parseInt(subtotal);
                            $("#subtotal-" + data.cart_id).html(
                                "IDR " + numeral(subtotal).format("0,0")
                            );
                            $("#notes" + data.cart_id).html(data.note);
                        }
                    });
                });
            });
        }

        $.getJSON(url + "cart/data", function (data) {
            $.each(data, function (i, data) {
                $(".parent").each(function () {
                    if (data.cart_id == $(this).attr("data-id")) {
                        $("#catatan" + data.cart_id).on("click", function () {
                            $("#catField" + data.cart_id).css(
                                "display",
                                "block"
                            );
                            $(this).css("display", "none");
                        });
                        $("#fieldcat" + data.cart_id).on("change", function () {
                            let note = $("#fieldcat" + data.cart_id).val();
                            notes(data.cart_id, note);
                            $("#catField" + data.cart_id).css(
                                "display",
                                "none"
                            );
                            $("#catatan" + data.cart_id).css(
                                "display",
                                "block"
                            );
                        });
                        $("#form-quantity" + data.cart_id).keyup(function () {
                            let id = [];
                            if ($(this).val() == 0) {
                                $(this).val(1);
                            }
                            quantity(data.cart_id, $(this).val());
                            $(".sub-check:checked").each(function () {
                                id.push($(this).attr("data-id"));
                            });
                            total(id);
                        });
                        $("#plus-quantity" + data.cart_id).on(
                            "click",
                            function () {
                                if (
                                    $("#form-quantity" + data.cart_id).val() >=
                                    1
                                ) {
                                    let id = [];
                                    let qty =
                                        parseInt(
                                            $(
                                                "#form-quantity" + data.cart_id
                                            ).val()
                                        ) + 1;
                                    $("#form-quantity" + data.cart_id).val(qty);
                                    quantity(data.cart_id, qty);
                                    $(".sub-check:checked").each(function () {
                                        id.push($(this).attr("data-id"));
                                    });
                                    total(id);
                                }
                            }
                        );
                        $("#minus-quantity" + data.cart_id).on(
                            "click",
                            function () {
                                if (
                                    $("#form-quantity" + data.cart_id).val() > 1
                                ) {
                                    let id = [];
                                    let qty =
                                        parseInt(
                                            $(
                                                "#form-quantity" + data.cart_id
                                            ).val()
                                        ) - 1;
                                    $("#form-quantity" + data.cart_id).val(qty);
                                    quantity(data.cart_id, qty);
                                    $(".sub-check:checked").each(function () {
                                        id.push($(this).attr("data-id"));
                                    });
                                    total(id);
                                }
                            }
                        );
                        $("#fieldcat" + data.cart_id).keyup(function () {
                            if ($(this).val().length < 125) {
                                $("#countstring" + data.cart_id).html(
                                    $(this).val().length + "/" + "125"
                                );
                            }
                        });
                    }
                });
            });
        });

        $(".next").on("click", function () {
            let cart = [];
            $(".parent").each(function () {
                cart.push($(this).attr("data-id"));
            });
            $.ajaxSetup({
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                        "content"
                    ),
                    "Access-Control-Allow-Origin": "*",
                },
            });
            $.ajax({
                url: url + "cart",
                type: "POST",
                data: { cart_id: cart },
                success: function (data) {
                    if (data.status) {
                        Toast.fire({
                            icon: "error",
                            title: data.status,
                        });
                    } else {
                        window.location = "order";
                    }
                },
                error: function () {
                    //
                },
            });
        });
    });

    // Input Price
    $("input[name=amount]").keyup(function () {
        $(this).val(numeral($(this).val()).format("0,0"));
    });
})(jQuery);

function countdown(deadline) {
    let countDownDate = new Date(deadline).getTime();
    // Get today's date and time
    let now = new Date().getTime();

    // Find the distance between now and the count down date
    let distance = countDownDate - now;

    // Time calculations for days, hours, minutes and seconds
    let days = Math.floor(distance / (1000 * 60 * 60 * 24));
    let hours = Math.floor(
        (distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60)
    );
    let minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));

    // If the count down is finished, write some text
    if (distance < 0) {
        return "0d " + "0h " + "0m";
    }

    return days + "d " + hours + "h " + minutes + "m ";
}

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
        selector: "[data-component=intro]",
        step: 1,
        title: "Selamat datang di Exova Indonesia",
        content:
            "Yuk biar makin kenal sama exova, ikutin tour ini bentar aja ;)",
        image: "",
    },
    {
        selector: "[data-component=intro_2]",
        step: 2,
        title: "Di Exova bisa ngapain aja sih ?",
        content:
            "Oke, jadi di Exova itu kalian bisa menjual ataupun membeli produk/jasa",
        image: "",
    },
    {
        selector: "[data-component=services_page]",
        step: 3,
        title: "Terus layanan Exova ada apa aja ?",
        content:
            "Saat ini baru ada 2 layanan Exova yaitu, Exova Jasa dan Exova Creations",
        image: "",
    },
    {
        selector: "[data-component=jasa]",
        step: 4,
        title: "Apaan tuh Exova Jasa ?",
        content:
            "Exova Jasa adalah sebuah layanan dimana kamu bisa jual jasa kamu ataupun beli jasa dari penjual lainnya",
        image: "",
    },
    {
        selector: "[data-component=creations]",
        step: 5,
        title: "Lalu apaan tuh Exova Creations ?",
        content:
            "Exova Creations adalah layanan yang bisa kamu gunakan untuk membuat undangan online, membuat website pribadi kamu, mendesain produk kamu, dan juga membuat website company profile",
        image: "",
    },
    {
        selector: "[data-component=wallet]",
        step: 6,
        title: "Satu lagi kenalan yuk sama Exova Wallet",
        content:
            "Dengan Exova Wallet Kamu bisa dengan mudah menerima refund transaksi, saling kirim uang dengan teman, dan juga untuk menampung pendapatan kamu tentunya",
        image: "",
    },
    {
        selector: "[data-component=withdraw]",
        step: 7,
        title: "Withdraw",
        content: "Kamu bisa mencairkan saldo kamu ke rekening kamu",
        image: "",
    },
    {
        selector: "[data-component=send]",
        step: 7,
        title: "Send",
        content:
            "Dengan fitur Send ini kamu bisa kirim uang untuk temen, pacar, gebetan, sahabat, atau keluarga kamu",
        image: "",
    },
    {
        selector: "[data-component=mywallet]",
        step: 8,
        title: "My Wallet",
        content:
            "Tentu saja dengan Kamu klik ini, Kamu akan diarahkan ke detail dari Wallet Kamu",
        image: "",
    },
    {
        selector: "[data-component=wallethistory]",
        step: 9,
        title: "History Transaksi",
        content: "Kamu bisa melacak history transaksi kamu dengan fitur ini",
        image: "",
    },
    {
        selector: "[data-component=highlight]",
        step: 10,
        title: "Higlight",
        content:
            "Fitur highlight adalah fitur promosi berbayar milik Exova, kamu bisa menggunakan fitur ini dengan gratis jika kamu langganan membership",
        image: "",
    },
    {
        selector: "[data-component=membership]",
        step: 11,
        title: "Membership",
        content:
            "Fitur membership akan memberikan kamu banyak keuntungan, dengan berlangganan fitur ini kamu akan dapat keuntungan sesuai paket yang kamu pilih",
        image: "",
    },
    {
        selector: "[data-component=faq]",
        step: 12,
        title: "Frequently Asked Question",
        content: "Kamu bisa temukan jawaban atas pertanyaan kamu disini yaa",
        image: "",
    },
    {
        selector: "[data-component=kontak]",
        step: 13,
        title: "Kontak Kami",
        content:
            "Atau kamu juga bisa hubungi Kami jika ada pertanyaan yang ingin ditanyakan, kami tersedia 24/7 kok ;)",
        image: "",
    },
    {
        selector: "[data-component=follow]",
        step: 14,
        title: "Yuk Ikutin Kami",
        content:
            "Dapetin berita dan konten menarik setiap harinya dengan mengikuti kami di sosial media",
        image: "",
    },
    {
        selector: "[data-component=team]",
        step: 15,
        title: "Salam kenal ya",
        content:
            "Dan terakhir ini adalah Kami yang ada dibalik Exova Indonesia :)",
        image: "",
    },
];

//let tourguide = new Tourguide({steps: steps});
//tourguide.start();
