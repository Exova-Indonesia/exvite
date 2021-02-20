@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="col-lg-12">
            <div class="rounded-exova shadow d-flex p-4">
                <div class="m-auto">
                    <div class="row">
                        <div class="user-profile-picture">
                            <img class="profile-picture" src="" alt="Profile Picture">
                        </div>
                        <div class="mx-3 my-auto text-profile">
                            <div class="user-profile-title text-muted">User Profile</div>
                            <div class="user-profile-content name-banner"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-12 my-3">
            <div class="row">
                <div class="col-lg-3 p-2">
                    <div class="card">
                        <div class="card-header text-white bg-exova">
                            Last Activity
                        </div>
                        <div class="card-body p-0">
                            <ul class="list-group text-responsive">
                                @foreach($user->activity->slice(0, 10) as $u)
                                <li class="list-group-item">
                                    <span>{{ $u->activity }} <strong class="float-right">{{ date('h:i a', strtotime($u->created_at)) }}</strong></span>
                                </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 p-2">
                    <div class="card">
                        <div class="card-header text-white bg-exova">
                            Profil Akun
                        </div>
                        <div class="alert alert-primary m-2 text-center">
                            Tingkatkan ke akun premium
                            <a href="membership" class="btn-sm btn-danger">Sekarang</a>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-7 p-1">
                                    <div class="profile-bar">
                                        <div class="user-profile-picture-bar">
                                            <img class="profile-picture" src="" alt="Profile Picture">
                                        </div>
                                        <div class="profile-describe">
                                            <div class="edit-profile-btn">
                                                <label role="button" for="editPhoto" class="btn-sm btn-primary rounded-pill">Edit Photo</label>
                                                <input type="file" id="editPhoto" class="d-none">
                                            </div>
                                            <div class="profile status">
                                                <div class="text-responsive"><span>Bergabung Sejak</span><strong class="float-right">{{ date('F j, Y', strtotime($user->created_at)) }}</strong></div>
                                                <div class="text-responsive"><span>Exova Points</span><strong class="float-right">1390</strong></div>
                                                <div class="text-responsive"><span>Status</span><strong class="float-right">{{ $user->subscription }}</strong></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-5 p-1">
                                    <ul class="list-group">
                                        <li class="list-group-item"> <span id="name"></span> 
                                            <span id="name-btn" role="button" data-title="Ganti Nama" data-label="Nama" data-target="#Modal" data-toggle="modal">
                                                <i class="fas fa-edit text-primary"></i>
                                            </span>
                                        </li>
                                        <div id="birthday">
                                        </div>
                                        <li class="list-group-item">
                                            <span id="address"></span>
                                            <span role="button" data-title="Ganti Alamat" data-label="Alamat" data-target="#ModalAddress" data-toggle="modal">
                                                <i class="fas fa-edit text-primary"></i>
                                            </span>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 p-2">
                    <div class="card">
                        <div class="card-header text-white bg-exova">
                            Pengaturan
                        </div>
                        <div class="card-body p-0">
                            <ul class="list-group">
                                <li class="list-group-item" role="button">
                                    <div data-target="#notifikasicollapse" data-toggle="collapse" aria-expanded="false" aria-controls="notifikasicollapse">Notifikasi <span class="float-right"><i class="fas fa-angle-down"></i></span></div>
                                    <div class="collapse" id="notifikasicollapse">
                                        <div class="sub-collapse">
                                            <div class="text-responsive">
                                                Pembelian
                                                <span class="float-right">
                                                    <input id="penjualan" type="checkbox">
                                                </span>
                                            </div>
                                        </div>
                                        <div class="sub-collapse">
                                            <div class="text-responsive">
                                                Penjualan
                                                <span class="float-right">
                                                    <input id="penjualan" type="checkbox">
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li class="list-group-item" role="button">
                                    <div data-target="#kontakcollapse" data-toggle="collapse" aria-expanded="false" aria-controls="kontakcollapse">Kontak <span class="float-right"><i class="fas fa-angle-down"></i></span></div>
                                    <div class="collapse" id="kontakcollapse">
                                        <div class="sub-collapse">
                                            <div class="text-responsive" id="email" data-title="Ganti Email" data-label="Email" data-target="#Modal" data-toggle="modal">
                                                Ganti Email
                                            </div>
                                        </div>
                                        <div class="sub-collapse">
                                            <div class="text-responsive" id="phone" data-title="Ganti No. Telepon" data-label="Phone" data-target="#Modal" data-toggle="modal">
                                                Ganti No. Telepon
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li class="list-group-item" role="button">
                                    Ganti Password
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="Modal" tabindex="-1" role="dialog" aria-labelledby="ModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="ModalLabel"></h5>
                    <button type="button" class="close" id="closeModal" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div id="modal-body-content">
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Address -->
    <div class="modal fade" id="ModalAddress" tabindex="-1" role="dialog" aria-labelledby="ModalLabelAddress" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="ModalLabelAddress"></h5>
                    <button type="button" class="close" id="closeModal" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label id="label">Provinsi</label>
                        <select type="text" class="form-control" id="province">
                            <option selected disabled hidden >Pilih Alamat</option>
                            @foreach($state->provinsi as $s)
                                <option value="{{ $s->id }}">{{ $s->nama }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label id="label">Kabupaten/Kota</label>
                            <select type="text" class="form-control city" value="">
                        </select>
                    </div>
                    <div class="form-group">
                        <label id="label">Kecamatan</label>
                            <select type="text" class="form-control" id="district" value="">
                        </select>
                    </div>
                    <div class="form-group">
                        <label id="label">Alamat Lengkap</label>
                        <textarea type="text" class="form-control address"></textarea>
                    </div>
                    <div class="form-group">
                        <label id="label">Nama Alamat</label>
                        <textarea type="text" class="form-control nameaddress"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary saveaddress">Simpan</button>
                </div>
            </div>
        </div>
    </div>
    <script>
    let ReloadAll = () => {
        let reloadProfile = (data) => {
            let content = ``;
            $('.profile-picture').attr('src', data.avatar);
            $('#name-btn').attr('data-content', data.name);
            $('#email').attr('data-content', data.email);
            $('#phone').attr('data-content', data.phone);
            $('#name').html(data.name);
            $('.name-banner').html('Hi, ' + data.name);
            if(data.birthday) {
                let d = new Date(data.birthday)
                content += `
                    <li class="list-group-item border-bottom">`+d.toDateString()+`</li>
                `;
            } else {
                content += `
                    <li role="button" class="list-group-item border-bottom text-exova" data-title="Tambahkan Tanggal Lahir" data-label="Tanggal Lahir" data-target="#Modal" data-toggle="modal">
                        Tambahkan Tanggal Lahir
                    </li>
                `;
            }
            if(data.sex) {
                content += `
                    <li class="list-group-item border-bottom">`+data.sex_type.value+`</li>
                `;
            } else {
                content += `
                    <li role="button" class="list-group-item text-exova border-bottom" data-title="Tambahkan Jenis Kelamin" data-label="Jenis Kelamin" data-target="#Modal" data-toggle="modal">
                        Tambahkan Jenis Kelamin
                    </li>
                `;
            }
            $('#birthday').html(content);

            $('#address').html(data.address.address + ', ' + data.address.district + ', ' + data.address.city + ', ' + data.address.state);
        }
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                'Access-Control-Allow-Origin': '*',
            }
        });
        $.ajax({
            url: "{{ route('profile.data') }}",
            type: "GET",
            success: function (data) {
                reloadProfile(data);
            },
            error: function () {
                //
            },
            beforeSend: function() {
                $('.profile-picture').attr('src', `{{ asset('images/icons/loader.gif') }}`);
                $('.name-banner').html('Loading...');
                $('#birthday').html(`<li class="list-group-item">Loading...</li>`);
                $('#name').html('Loading...');
                $('#address').html('Loading...');
            },
        })
    }

    $(document).ready(function() {

        $('#province').on('change', () => {
            let content = ``;
            let state = $('#province').val();
            $.getJSON('https://dev.farizdotid.com/api/daerahindonesia/kota?id_provinsi=' + state, function(data) {
                $.each(data.kota_kabupaten, function(i, index) {
                    content += `
                        <option value="` + index.id + `">`+ index.nama +`</option>
                    `;
                    $('.city').html(content);
                });
            });
        })

        $('.city').on('change', () => {
            let content = ``;
            let city = $('.city').val();
            $.getJSON('https://dev.farizdotid.com/api/daerahindonesia/kecamatan?id_kota=' + city, function(data) {
                $.each(data.kecamatan, function(i, index) {
                    content += `
                        <option value="` + index.id + `">`+ index.nama +`</option>
                    `;
                    $('#district').html(content);
                });
            });
        })

        const Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 3000
        });

        $('#ModalAddress').on('show.bs.modal', function(event) {
            let button, title, label, modal, content;
                button = $(event.relatedTarget);
                title = button.data('title');
                label = button.data('label');
                modal = $(this);
                modal.find('.modal-title').html(title);

            $('.saveaddress').on('click', () => {
                let province, city, district, address;
                province = $('#province').val();
                city = $('.city').val();
                district = $('#district').val();
                address = $('.address').val();
                name = $('.nameaddress').val();

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                        'Access-Control-Allow-Origin': '*',
                    }
                });
                $.ajax({
                    url: "{{ route('profile.update', 1) }}",
                    type: "PUT",
                    data: { type:label, province:province,
                        city:city, district:district, 
                        address:address, name:name },
                    success: function (data) {
                        ReloadAll();
                        Toast.fire({
                        icon: 'success',
                        title: data.status,
                        })
                    },
                    error: function (data) {
                        console.log(data)
                    },
                })
            })
        });

        $('#Modal').on('show.bs.modal', function(event) {
            let button, title, label, modal, content;
            button = $(event.relatedTarget);
            title = button.data('title');
            label = button.data('label');
            content = button.data('content');
            modal = $(this);
            if(label == 'Tanggal Lahir') {
                content = `
                    <div class="modal-body">
                        <div id="form-group" class="form-group">
                            <label id="label">`+label+`</label>
                            <input id="content" type="date" class="form-control content">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary save">Simpan</button>
                    </div>
                `;
                $('#modal-body-content').html(content);
            } else if(label == 'Jenis Kelamin') {
                content = `
                    <div class="modal-body">
                        <div id="form-group" class="form-group d-flex">
                            <select name="content" class="form-control content">
                                <option value="1">Pria</option>
                                <option value="2">Wanita</option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary save">Simpan</button>
                    </div>
                `;
                $('#modal-body-content').html(content);
            } else if(label == 'Nama') {
                content = `
                    <div class="modal-body">
                        <div id="form-group" class="form-group">
                            <label id="label">`+label+`</label>
                            <input type="text" class="form-control content" value="`+content+`">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary save">Simpan</button>
                    </div>
                `;
                $('#modal-body-content').html(content);
            } else if(label == 'Email') {
                content = `
                    <div class="modal-body">
                        <div id="form-group" class="form-group">
                            <label id="label">`+label+`</label>
                            <input type="email" class="form-control content email" value="`+content+`">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary save" disabled>Simpan</button>
                    </div>
                `;
                $('#modal-body-content').html(content);
            } else if(label == 'Phone') {
                content = `
                    <div class="modal-body">
                        <div id="form-group" class="form-group">
                            <label id="label">`+label+`</label>
                            <input type="text" class="form-control content phone" value="`+content+`">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary save">Simpan</button>
                    </div>
                `;
                $('#modal-body-content').html(content);
            }
            modal.find('.modal-title').html(title);

            $('.email').on('keyup', () => {
                let _interval = null;
                let content = $('.email').val();
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                        'Access-Control-Allow-Origin': '*',
                    }
                });
                clearInterval(_interval)
                _interval = setInterval(function() {
                    $.ajax({
                        url: "{{ route('profile.check', 1) }}",
                        type: "PUT",
                        data: { type:label, content:content },
                        success: function (data) {
                            if(data.code == 200) {
                                Toast.fire({
                                icon: 'success',
                                title: data.status,
                                })
                                $('.save').attr('disabled', false);
                            } else if(data.code == 400) {
                                Toast.fire({
                                icon: 'error',
                                title: data.status,
                                })
                                $('.save').attr('disabled', true);
                            }
                        },
                        error: function (data) {
                            // console.log(data)
                        },
                    })
                    clearInterval(_interval)
                }, 1000)
            })

            $('.save').on('click', () => {
                let content = $('.content').val();
                console.log(content)
                console.log(label)
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                        'Access-Control-Allow-Origin': '*',
                    }
                });
                $.ajax({
                    url: "{{ route('profile.update', 1) }}",
                    type: "PUT",
                    data: { type:label, content:content },
                    success: function (data) {
                        ReloadAll();
                        Toast.fire({
                        icon: 'success',
                        title: data.status,
                        })
                    },
                    error: function (data) {
                        // console.log(data)
                    },
                })
            })
        });
    });

    ReloadAll();


    </script>
@endsection