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
@section('scripts')
<script>
$(document).ready(function() {
    $('#agreementModal').modal({backdrop: 'static', keyboard: false});
    $('#agreementModal').modal('show');
})
</script>
@endsection