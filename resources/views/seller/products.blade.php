@extends('seller.layouts.app')
@section('content')
  <div class="row m-0">
    <span  class="col-lg-3 col-6">
      <!-- small box -->
      <div class="small-box bg-exova">
        <div class="inner">
          <h4>{{ $seller->portfolio->count() }}</h4>
          <p class="m-0">Total produk
            <span class="font-12">
            @if($growthJasa < 0)
            <i class="fa fa-arrow-down font-10"></i>
            @else
            <i class="fa fa-arrow-up font-10"></i>
            @endif
            {{ $growthJasa }}
            <sup style="font-size: 8px">%</sup></span>
          </p>
        </div>
      </div>
    </span>
    <!-- ./col -->
    <span  class="col-lg-3 col-6">
      <!-- small box -->
      <div class="small-box bg-exova-2">
        <div class="inner">
          <h4>{{ $jasa_count }}</h4>
          <p class="m-0">Tampilan
            <span class="font-12">
            @if($growthView < 0)
            <i class="fa fa-arrow-down font-10"></i>
            @else
            <i class="fa fa-arrow-up font-10"></i>
            @endif
            {{ $growthView }}
            <sup style="font-size: 8px">%</sup></span>
          </p>
        </div>
      </div>
    </span>
    <!-- ./col -->
    <span  class="col-lg-3 col-6">
      <!-- small box -->
      <div class="small-box bg-success">
        <div class="inner">
          <h4>{{ $seller->portfolio->sum('jasa_sold') }}</h4>
          <p class="m-0">Total terjual
            <span class="font-12">
            @if($growthSells < 0)
            <i class="fa fa-arrow-down font-10"></i>
            @else
            <i class="fa fa-arrow-up font-10"></i>
            @endif
            {{ $growthSells }}
            <sup style="font-size: 8px">%</sup></span>
          </p>
        </div>
      </div>
    </span>
    <!-- ./col -->
    <span  class="col-lg-3 col-6">
      <!-- small box -->
      <div class="small-box bg-danger">
        <div class="inner">
          <h4>{{ $seller->portfolio->sum('jasa_cancel') }}</h4>
          <p class="m-0">Total batal
            <span class="font-12">
            @if($growthCancel < 0)
            <i class="fa fa-arrow-down font-10"></i>
            @else
            <i class="fa fa-arrow-up font-10"></i>
            @endif
            {{ $growthCancel }}
            <sup style="font-size: 8px">%</sup></span>
          </p>
        </div>
      </div>
    </span>
    <!-- ./col -->
  </div>
<div class="row m-0">
    <div class="col-lg-6 col-sm-12">
        <div class="card">
            <div class="card-header">
                <h5>Top Produk</h5>
            </div>
            <canvas class="max-height-500" id="chart-top"></canvas>
        </div>
    </div>
    <div class="col-lg-6 col-sm-12">
        <div class="card">
            <div class="card-header">
                <h5>Tipe Pembatalan</h5>
            </div>
            <div>
                <canvas class="max-height-500" id="chart-cancel"></canvas>
            </div>
        </div>
    </div>
    <div class="col-lg-12 col-sm-12">
        <div class="card">
            <div class="card-header mb-3">
                <h5>Statistik Produk</h5>
            </div>
            <div class="table-responsive">
                <table id="table-products" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th style="width:20px;">No</th>
                            <th>Produk</th>
                            <th>Tampilan</th>
                            <th>Terjual</th>
                            <th>Dibatalkan</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($seller->portfolio as $p)
                        <tr>
                            <td class="text-center">{{ $loop->iteration }}</td>
                            <td>
                                <img width="50" height="50" src="{{ secure_asset($p->cover['small']) }}" alt="">
                                <span class="ml-3">{{ $p->jasa_name }}</span>
                            </td>
                            <td>{{ $p->views->count() }}</td>
                            <td>{{ $p->jasa_sold }}</td>
                            <td>{{ $p->jasa_cancel }}</td>
                            <td class="text-center w-150">
                                <a href="{{ url('manage/' . $p->slugs) }}" class="btn btn-exova m-1"><i class="fa fa-pencil-alt"></i></a>
                                <button data-id="{{ $p->jasa_id }}" class="btn btn-danger m-1 delete"><i class="fa fa-trash"></i></button>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection

@section('modals')

@endsection

@section('scripts')
<script>
    $(document).ready(function() {
        const ctx = $('#chart-top');
        const ctx_cancel = $('#chart-cancel');
        const labels = {!! json_encode($jasa_name) !!};
        const labels_cancel = ["Batal Otomatis", "Kamu Tolak", "Permintaan Pembeli"];
        const data = {
          labels: labels,
          datasets: [
          {
            label: 'Penjualan',
            data: {!! json_encode($jasa_jual) !!},
            backgroundColor: '#479cf7',
            pointColor: '#3b8bba',
            pointStrokeColor: '#c1c7d1',
            fill: false,
            borderColor: '#479cf7',
            tension: 0.1
          },
          {
            label: 'Tampilan',
            data: {!! json_encode($jasa_tampil) !!},
            backgroundColor: '#F8694A',
            pointColor: '#3b8bba',
            pointStrokeColor: '#c1c7d1',
            fill: false,
            borderColor: '#F8694A',
            tension: 0.1
          },
        ]
        };
        const data_cancel = {
          labels: labels_cancel,
          datasets: [
          {
            label: 'Jumlah',
            data: [{!! $cancel->where('status', 'batal_otomatis')->count() !!}, {!! $cancel->where('status', 'pesanan_ditolak')->count() !!}, {!! $cancel->where('status', 'pesanan_dibatalkan')->count() !!}],
            backgroundColor: '#479cf7',
            pointColor: '#3b8bba',
            pointStrokeColor: '#c1c7d1',
            fill: false,
            borderColor: '#479cf7',
            tension: 0.1
          },
        ]
        };
        const chartTop = new Chart(ctx, {
          type: 'bar',
          data: data,
        });
        const chartCancel = new Chart(ctx_cancel, {
          type: 'bar',
          data: data_cancel,
        });


        $('.delete').on('click', function() {
          Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
          }).then((result) => {
            if (result.isConfirmed) {
              Swal.fire(
                'Deleted!',
                'Your file has been deleted.',
                'success'
              )
              $.ajax({
                  url: "{{ url('/products') }}/" + $(this).attr('data-id'),
                  type: "DELETE",
                  headers: {
                      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                  },
                  success: function(data) {
                      $('.success-message').html(data.message);
                      $('#menu-success-2').addClass('menu-active');
                      $('.menu-hider').removeClass("menu-active");
                      setInterval(() => {
                          window.location = data.url;
                      }, 1000);
                  },
                  beforeSend: function() {
                    // 
                  },
                  error: function(data) {
                    // 
                  }
              });
            } else {
              return false;
            }
          })
      });
    })
</script>
@endsection