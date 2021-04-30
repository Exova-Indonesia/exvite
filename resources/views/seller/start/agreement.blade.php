@extends('seller.layouts.start')
@section('content')
<form action="{{ route('studio.update', auth()->user()->id) }}" method="POST" enctype="multipart/form-data">
@csrf
@method('put')
<!-- Modal -->
<div class="modal fade" id="agreementModal" tabindex="-1" role="dialog" aria-labelledby="agreementModalTitle" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="agreementModalTitle">Kontrak Persetujuan</h5>
      </div>
      <div class="modal-body">
        <div class="agreement-content">
        <!-- Isi Disini -->
        </div>
        <div class="form-check icon-check">
            <input class="form-check-input" type="checkbox" name="is_agree" id="agree" checked="">
            <label class="form-check-label" for="agree">Saya setuju dengan semua ketentuan yang berlaku</label>
            <i class="icon-check-1 far fa-square color-gray-dark font-16"></i>
            <i class="icon-check-2 far fa-check-square font-16 color-highlight"></i>
        </div>
      </div>
      <div class="modal-footer m-auto">
        <button type="submit" class="btn btn-primary">Setuju & Lanjutkan</button>
      </div>
    </div>
  </div>
</div>
</form>
@endsection
@section('src-scripts')
    <script src="https://unpkg.com/filepond/dist/filepond.js"></script>
    <script src="https://unpkg.com/filepond-plugin-file-encode/dist/filepond-plugin-file-encode.min.js"></script>
    <script src="https://unpkg.com/filepond-plugin-file-validate-size/dist/filepond-plugin-file-validate-size.min.js"></script>
    <script src="https://unpkg.com/filepond-plugin-image-exif-orientation/dist/filepond-plugin-image-exif-orientation.min.js"></script>
    <script src="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.min.js"></script>
    <script src="https://unpkg.com/filepond-plugin-file-rename/dist/filepond-plugin-file-rename.js"></script>
    <script src="https://unpkg.com/filepond-plugin-file-validate-type/dist/filepond-plugin-file-validate-type.js"></script>
@endsection
@section('src-styles')
    <link href="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.css" rel="stylesheet">
    <link href="https://unpkg.com/filepond/dist/filepond.css" rel="stylesheet" />
@endsection
@section('scripts')
<script>
$(document).ready(function() {
    $('#agreementModal').modal({backdrop: 'static', keyboard: false});
    $('#agreementModal').modal('show');
})
</script>
@endsection