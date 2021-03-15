@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="alert-top">
        </div>    
        <div class="col-lg-12">
            <div class="rounded-exova shadow d-flex p-4">
                <div class="m-auto">
                    <div class="row">
                        <div class="user-profile-picture">
                            <img class="profile-picture" src="" alt="Profile Picture">
                        </div>
                        <div class="mx-3 my-auto text-profile">
                            <div class="user-profile-title text-muted">@lang('profile.title')</div>
                            <div class="user-profile-content name-banner"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-12 my-3">
            <div class="row">
                <div class="col-lg-3 col-sm-12 p-2">
                    <div class="card">
                        <div class="card-header text-white bg-exova">
                            @lang('profile.card-1.title')
                        </div>
                        <div class="card-body p-0">
                            <ul class="list-group text-responsive">
                                @forelse($user->activity->sortByDesc('created_at')->where('availability', 0)->take(10) as $u)
                                <li class="list-group-item">
                                    <span>{{ $u->activity }} <strong class="float-right">{{ date('h:i a', strtotime($u->created_at)) }}</strong></span>
                                </li>
                                @empty
                                    <div class="p-5 text-center">
                                        <img class="my-2" src="{{ asset('images/icons/noactivity.svg') }}" alt="No Activity">
                                        <span class="text-muted">Tidak ada aktivitas apapun</span>
                                    </div>
                                @endforelse
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-sm-12 p-2">
                    <div class="card">
                        <div class="card-header text-white bg-exova">
                            @lang('profile.card-2.title')
                        </div>
                        <div class="alert alert-primary m-2 text-center">
                            @lang('profile.card-2.membership')
                            <a href="{{ url('/#membership') }}" class="btn-sm btn-danger">@lang('profile.card-2.button.membership')</a>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-7 col-sm-12 p-1">
                                    <div class="profile-bar">
                                        <div class="user-profile-picture-bar">
                                            <img class="profile-picture" src="" alt="Profile Picture">
                                        </div>
                                        <div class="profile-describe">
                                            <div class="edit-profile-btn">
                                                <form id="editphotoSend" type="POST" enctype="multipart/form-data">
                                                <label role="button" for="editPhoto" class="btn-sm btn-primary rounded-pill">@lang('profile.card-2.button.editprofil')</label>
                                                <p class="text-muted profile-picture-label m-0"></p>
                                                    @csrf
                                                    <input type="file" id="editPhoto" name="content" class="d-none">
                                                </form>
                                            </div>
                                            <div class="profile status">
                                                <div class="text-responsive"><span>@lang('profile.card-2.since')</span><strong class="float-right">{{ date('F j, Y', strtotime($user->created_at)) }}</strong></div>
                                                <div class="text-responsive"><span>@lang('profile.card-2.points')</span><strong class="float-right">{{ $user->points->sum('value') ?? '0' }}</strong></div>
                                                <div class="text-responsive"><span>@lang('profile.card-2.status')</span><strong class="float-right">{{ $user->subs->plan->plan_name ?? 'Standard' }}</strong></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-5 col-sm-12 p-1">
                                    <ul class="list-group">
                                        <li class="list-group-item"> <span id="name"></span> 
                                            <span id="name-btn" role="button" data-title="Ganti Nama" data-label="Nama" data-target="#Modal" data-toggle="modal">
                                                <i class="fas fa-edit text-primary"></i>
                                            </span>
                                        </li>
                                        <div id="birthday">
                                        </div>
                                        <li class="list-group-item border-bottom">
                                            <div id="add_address">
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-12 p-2">
                    <div class="card">
                        <div class="card-header text-white bg-exova">
                            @lang('profile.card-3.title')
                        </div>
                        <div class="card-body p-0">
                            <ul class="list-group">
                                <li class="list-group-item" role="button">
                                    <div data-target="#notifikasicollapse" data-toggle="collapse" aria-expanded="false" aria-controls="notifikasicollapse">@lang('profile.card-3.notifikasi.title') <span class="float-right"><i class="fas fa-angle-down"></i></span></div>
                                    <div class="collapse" id="notifikasicollapse">
                                        <form id="notifications">
                                            @csrf
                                            <input type="hidden" name="type" value="Notif">
                                            <div class="sub-collapse">
                                                <div class="text-responsive">
                                                    @lang('profile.card-3.notifikasi.pembelian')
                                                    <span class="float-right">
                                                        <input class="notifications" data-label="pembelian" name="pembelian" type="checkbox" @if( Auth::user()->notif->pembelian == 0) value="1" checked @else value="0" @endif>
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="sub-collapse">
                                                <div class="text-responsive">
                                                    @lang('profile.card-3.notifikasi.penjualan')
                                                    <span class="float-right">
                                                        <input class="notifications" data-label="penjualan" name="penjualan" type="checkbox" @if( Auth::user()->notif->penjualan == 0) value="1" checked @else value="0" @endif>
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="sub-collapse">
                                                <div class="text-responsive">
                                                    @lang('profile.card-3.notifikasi.pengingat')
                                                    <span class="float-right">
                                                        <input class="notifications" data-label="pengingat" name="pengingat" type="checkbox" @if( Auth::user()->notif->pengingat == 0) value="1" checked @else value="0" @endif>
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="sub-collapse">
                                                <div class="text-responsive">
                                                    @lang('profile.card-3.notifikasi.promo')
                                                    <span class="float-right">
                                                        <input class="notifications" data-label="promo" name="promo" type="checkbox" @if( Auth::user()->notif->promo == 0) value="1" checked @else value="0" @endif>
                                                    </span>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </li>
                                <li class="list-group-item bg-transparent" role="button">
                                    <div data-target="#kontakcollapse" data-toggle="collapse" aria-expanded="false" aria-controls="kontakcollapse">@lang('profile.card-3.kontak.title') <span class="float-right"><i class="fas fa-angle-down"></i></span></div>
                                    <div class="collapse" id="kontakcollapse">
                                        <div class="sub-collapse">
                                            <div class="text-responsive email" data-title="Ganti Email" data-label="Email" data-target="#Modal" data-toggle="modal">
                                                @lang('profile.card-3.kontak.email')
                                            </div>
                                        </div>
                                        <div class="sub-collapse">
                                            <div class="text-responsive" id="phone" data-title="Ganti No. Telepon" data-label="Phone" data-target="#Modal" data-toggle="modal">
                                                @lang('profile.card-3.kontak.phone')
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li class="list-group-item bg-transparent" role="button">
                                    <div data-target="#historycollapse" data-toggle="collapse" aria-expanded="false" aria-controls="historycollapse">@lang('profile.card-3.aktivitas.title') <span class="float-right"><i class="fas fa-angle-down"></i></span></div>
                                    <div class="collapse" id="historycollapse">
                                        <div class="sub-collapse">
                                            <div class="text-responsive">
                                                @lang('profile.card-3.aktivitas.title')
                                                <span class="float-right">
                                                    <input class="notifications" data-label="aktivitas" name="aktivitas" type="checkbox" @if( Auth::user()->notif->aktivitas == 0) value="1" checked @else value="0" @endif>
                                                </span>
                                            </div>
                                        </div>
                                        <div class="sub-collapse">
                                            <div class="text-responsive deleteAktivitas" data-label="deleteAktivitas">
                                                @lang('profile.card-3.aktivitas.delete')
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li class="list-group-item bg-transparent" role="button">
                                    <div data-target="#searchcollapse" data-toggle="collapse" aria-expanded="false" aria-controls="searchcollapse">@lang('profile.card-3.search.title') <span class="float-right"><i class="fas fa-angle-down"></i></span></div>
                                    <div class="collapse" id="searchcollapse">
                                        <div class="sub-collapse">
                                            <div class="text-responsive">
                                                @lang('profile.card-3.search.title')
                                                <span class="float-right">
                                                    <input class="notifications" data-label="pencarian" name="pencarian" type="checkbox" @if( Auth::user()->notif->pencarian == 0) value="1" checked @else value="0" @endif>
                                                </span>
                                            </div>
                                        </div>
                                        <div class="sub-collapse">
                                            <div class="text-responsive deleteAktivitas" data-label="deletePencarian">
                                                @lang('profile.card-3.search.delete')
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li class="list-group-item" role="button" data-target="#ResetPassword" data-toggle="modal">
                                    @lang('profile.card-3.password.title')
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

    <!-- Modal Reset Password -->
    <div class="modal fade" id="ResetPassword" tabindex="-1" role="dialog" aria-labelledby="ResetPassword" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="ResetPassword">Reset Password</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="{{ route('password.email') }}">
                        @csrf
                        <div class="form-group row">
                            <label for="email" class="col-md-2 col-form-label text-md-right">{{ __('Email') }}</label>

                            <div class="col-md-10">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                            </div>
                        </div>

                    <div class="modal-footer">
                        <div class="form-group row mb-0">
                            <div class="col-md-12 offset-md-12">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Kirim Link Reset Password') }}
                                </button>
                            </div>
                        </div>
                    </form>                        
                    </div>
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
                            @foreach($state as $s)
                                <option value="{{ $s->id }}">{{ $s->name }}</option>
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
                        <label id="label">Desa</label>
                            <select type="text" class="form-control villages" value="">
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
@endsection
@section('scripts')
    <script>
        let url = "http://localhost:8000/";
    let ReloadAll = () => {
        let reloadProfile = (data) => {
            let content = ``;
            $('.profile-picture').attr('src', data.avatar['large']);
            $('#name-btn').attr('data-content', data.name);
            if(data.email == '') {
                let email;
                email = `
                <div class="d-flex">
                    <div class="m-auto">
                        <div class="alert text-center alert-danger">
                                @lang('profile.email.title')
                            <a class="btn btn-exova email" data-title="Ganti Email" data-label="Email" data-target="#Modal" data-toggle="modal">@lang('profile.email.button.email')</a>
                        </div>
                    </div>
                </div>
                `;
                $('.alert-top').html(email);
            } else if(data.email_verified_at == null) {
                email = `
                <div class="d-flex">
                    <div class="m-auto">
                        <div class="alert text-center alert-danger">
                                @lang('profile.verify.title')
                            <a class="btn btn-exova" onclick="event.preventDefault();
                            document.getElementById('verify-form').submit();">@lang('profile.verify.button.verify')</a>
                            <form id="verify-form" action="{{ route('verification.resend') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </div>
                    </div>
                </div>  
                `;
                $('.alert-top').html(email);
            }
            if(data.email) {
                $('.email').attr('data-content', data.email);
            } else {
                $('.email').attr('data-content', '');
            }
            if(data.phone) {
                $('#phone').attr('data-content', data.phone);
            } else {
                $('#phone').attr('data-content', '');
            }
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
            if(data.address.address || data.address.district || data.address.city || data.address.state) {
                $('#add_address').html(`<strong> `+ data.address.address_name +` </strong> <br> <span> ` + data.address.address + ', ' + data.address.district + ', ' + data.address.city + ', ' + data.address.state +`</span>
                <span role="button" data-title="Ganti Alamat" data-label="Alamat" data-target="#ModalAddress" data-toggle="modal">
                    <i class="fas fa-edit text-primary"></i>
                </span>`);
            } else {
                $('#add_address').html(`<span role="button" class="text-exova" data-title="Ganti Alamat" data-label="Alamat" data-target="#ModalAddress" data-toggle="modal">
                    Tambahkan Alamat
                </span>`);
            }
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
            $.getJSON(url + 'regencies/' + state, function(data) {
                $.each(data, function(i, index) {
                    content += `
                        <option value="` + index.id + `">`+ index.name +`</option>
                    `;
                    $('.city').html(content);
                });
            });
        })

        $('.city').on('change', () => {
            let content = ``;
            let city = $('.city').val();
            $.getJSON(url + 'districts/' + city, function(data) {
                $.each(data, function(i, index) {
                    content += `
                        <option value="` + index.id + `">`+ index.name +`</option>
                    `;
                    $('#district').html(content);
                });
            });
        })

        $('#district').on('change', () => {
            let content = ``;
            let districts = $('#district').val();
            $.getJSON(url + 'villages/' + districts, function(data) {
                $.each(data, function(i, index) {
                    content += `
                        <option value="` + index.id + `">`+ index.name +`</option>
                    `;
                    $('.villages').html(content);
                });
            });
        })

        const Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 3000
        });

        @error('email')
            Toast.fire({
            icon: 'error',
            title: '{{ $message }}',
            })
        @enderror

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
                            <input type="email" class="form-control content emails" value="`+content+`">
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

            $('.emails').on('keyup', () => {
                let _interval = null;
                let content = $('.emails').val();
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
                        if(data.code == 400) {
                            Toast.fire({
                            icon: 'error',
                            title: data.status,
                            })
                        } else {
                            Toast.fire({
                            icon: 'success',
                            title: data.status,
                            })
                        } 
                    },
                    error: function (data) {
                        // console.log(data)
                    },
                })
            })
        });
        $('#editphotoSend').on('change', function(e) {
            e.preventDefault();
            $.ajax({
                url: "{{ route('profile.store') }}",
                type: "POST",
                data: new FormData(this),
                cache: false,
                processData: false,
                contentType: false,
                enctype: 'multipart/form-data',
                dataType: 'json',
                xhr: function() {
                    let xhr = $.ajaxSettings.xhr();
                    xhr.upload.addEventListener('progress', function(event) {
                        if(event.lengthComputable) {
                            let percent = Math.ceil(event.loaded / event.total * 100);
                            $('.profile-picture').attr('src', `{{ asset('images/icons/loader.gif') }}`);
                            $('.profile-picture-label').html('Mengupload ' + percent + '%');
                        }
                    }, true)
                    return xhr;
                },
                success: function (data) {
                    ReloadAll();
                    Toast.fire({
                    icon: 'success',
                    title: data.status,
                    });
                    $('.profile-picture-label').html('');
                    $('#editphotoSend').val('');
                },
                error: function (data) {
                    // console.log(data)
                },
            })
        })
        $('.notifications').on('change', function(event) {
                let label, content;
                label = $(this).attr('data-label');
                if($(this).is(':checked')) {
                    content = 0;
                } else {
                    content = 1;
                }
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
                        //
                    },
                    error: function (data) {
                        // console.log(data)
                    },
            })
        });
        $('.deleteAktivitas').on('click', function(event) {
                let label, content;
                label = $(this).attr('data-label');
                content = 1;
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
                        // window.location = window.location;
                        Toast.fire({
                            icon: 'success',
                            title: data.status,
                        })

                    },
                    error: function (data) {
                        // console.log(data)
                    },
            })
        });
    });

    ReloadAll();


    </script>
@endsection