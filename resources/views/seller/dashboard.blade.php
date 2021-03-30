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
              @owner
              <button
                role="button" data-toggle="modal" data-target="#exampleModal"
                class="mt-3 btn btn-xs font-600 btn-border border-highlight color-highlight"
                >Edit Profil
                <i class="fa fa-edit"></i>
              </button>
              <button
                role="button"
                class="mt-3 ms-2 btn btn-xs font-600 btn-border border-highlight color-highlight"
              >
               Promotions
              </button>
                @else
              <button
                href="#"
                class="mt-3 btn btn-xs font-600 btn-border border-highlight color-highlight"
                >Pesan</button
              >
              <button
                href="#"
                data-menu="menu-follow"
                class="mt-3 ms-2 btn btn-xs font-600 btn-border border-highlight color-highlight"
              >
                <i class="fa fa-user"></i
                ><i class="ms-2 font-11 fa fa-check"></i>
              </button>
                @endowner
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
              Owned by <a href="{{ url('/users/' . strtolower(str_replace(' ', '-', $seller->owner['name']))) }}" class="color-theme font-600">{{ $seller->owner['name'] }}</a>
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
          <div class="section-title">
            <h2 class="s-title d-block">Terlaris</h2>
          </div>
          <div class="d-flex">
            @forelse($seller->portfolio->sortby('jasa_sold', true)->take(4) as $f)
            <div class="col-lg-2 col-sm-6">
              <a
                href="{{ url('products/' . strtolower(str_replace(' ','-', $f->jasa_name))) }}"
                title="{{ $f->jasa_name }}"
                data-gallery="gallery"
              >
                <img
                  src="{{ $f->cover['medium'] }}"
                  class="img-fluid studio-products border border-transparent"
                />
              </a>
            </div>
            @empty
                {{ 'Kosong' }}
            @endforelse
          </div>
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
            src="{{ $seller->logo['small'] }}"
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
  </div>
</div>
@endsection

@section('modals')
<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit Profil</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="text-center mb-5 logo-field">
          <img
            src="../images/empty.png"
            data-src="{{ $seller->logo->small }}"
            width="125"
            class="rounded-circle shadow-xl preload-img"
          />
          <div>
            <span class="btn btn-exova rounded-pill change-logo">Ganti Logo</span>
          </div>
        </div>
        <div class="input-style input-style-always-active has-borders has-icon mb-4">    
          <input type="text" class="form-control" name="studio_slogan" id="slogan" value="{{ $seller->slogan }}">
          <label for="slogan" class="color-theme opacity-50 text-uppercase font-700 font-10">Slogan</label>
        </div>
        <div class="input-style input-style-always-active has-borders has-icon mb-4">    
          <input type="text" class="form-control" name="province" id="prov" >
          <label for="prov" class="color-theme opacity-50 text-uppercase font-700 font-10">Provinsi</label>
        </div>
        <div class="input-style input-style-always-active has-borders has-icon mb-4">    
          <input type="text" class="form-control" name="disctrict" id="dist" >
          <label for="dist" class="color-theme opacity-50 text-uppercase font-700 font-10">Kabupaten</label>
        </div>
        <div class="input-style input-style-always-active has-borders has-icon mb-4">    
          <input type="text" class="form-control" name="villages" id="village" >
          <label for="village" class="color-theme opacity-50 text-uppercase font-700 font-10">Kecamatan</label>
        </div>
        <div class="input-style input-style-always-active has-borders has-icon mb-4">    
          <input type="text" class="form-control" name="address_name" id="addr_name" >
          <label for="addr_name" class="color-theme opacity-50 text-uppercase font-700 font-10">Nama Alamat</label>
        </div>
        <div class="input-style input-style-always-active has-borders has-icon mb-4">    
          <textarea type="name" class="form-control" name="description" id="deskripsi">{{ $seller->description }}</textarea>
          <label for="deskripsi" class="color-theme opacity-50 text-uppercase font-700 font-10">Deskripsi</label>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
        <button type="button" class="btn btn-exova">Save changes</button>
      </div>
    </div>
  </div>
</div>
@endsection

@section('scripts')
<script>
  $(document).ready(function() {
    $('.change-logo').click(function() {
      let content = ``;
      content += `
        <input type="file" name="studio_logo" accept="image/png, image/jpeg"/>
      `;
      $('.logo-field').html(content);
        FilePond.registerPlugin(
        FilePondPluginFileEncode,
        FilePondPluginFileValidateType,
        FilePondPluginImageExifOrientation,
        FilePondPluginImagePreview,
      );
          FilePond.create(
        document.querySelector('input[name="studio_logo"]'),
        {
          labelIdle: `Drag & Drop your picture or `,
          imagePreviewHeight: 175,
          allowReplace: true,
          imageCropAspectRatio: '1:1',
          stylePanelLayout: 'compact circle',
          styleLoadIndicatorPosition: 'center bottom',
          styleProgressIndicatorPosition: 'center bottom',
          styleButtonRemoveItemPosition: 'left bottom',
          styleButtonReplaceItemPosition: 'left bottom',
          styleButtonProcessItemPosition: 'center bottom',
          labelIdle: `<div><span class="filepond--label-action">Pilih</span> atau seret file </div>`,
          labelFileTypeNotAllowed: `Format tidak sesuai`,
          allowFileEncode: true,
          allowFileTypeValidation: true,
          credits: false,
          allowRevert: true,
          allowReplace: true,
          allowFileSizeValidation: true,
          maxTotalFileSize: '10MB',
          acceptedFileTypes: ['image/png', 'image/jpeg', 'image/jpg'],
          labelMaxTotalFileSizeExceeded: 'Maximum total size exceeded',
          labelMaxTotalFileSize: 'Maximum total file size is {filesize}',
        }
      );
          FilePond.setOptions({
          server: { 
              url: "{{ route('upload.logo') }}",
              headers: { 
                  "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
              },
          },
      });
    });
  });
</script>
@endsection