@extends('seller.layouts.app')
@section('content')
  <div class="row m-0">
    <span  class="col-lg-3 col-6">
      <!-- small box -->
      <div class="small-box bg-exova">
        <div class="inner">
          <h4>{{ $visitors->count() }}</h4>
          <p class="m-0">Pengunjung
            <span class="font-12">
            @if($visitors->setGrowth() < 0)
            <i class="fa fa-arrow-down font-10"></i>
            @else
            <i class="fa fa-arrow-up font-10"></i>
            @endif
            {{ $visitors->setGrowth() }}
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
          <h4>Rp{{ number_format($revenue->sum('paid'), 0) }}</h4>
          <p class="m-0">Pendapatan 
            <span class="font-12">
            @if($revenue->setRevenueGrowth() < 0)
            <i class="fa fa-arrow-down font-10"></i>
            @else
            <i class="fa fa-arrow-up font-10"></i>
            @endif
            {{ $revenue->setRevenueGrowth() }}
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
          <h4>23</h4>
          <p class="m-0">Pesanan baru
            <span class="font-12"><i class="fa fa-arrow-up font-10"></i>80<sup style="font-size: 8px">%</sup></span>
          </p>
        </div>
      </div>
    </span>
    <!-- ./col -->
    <span  class="col-lg-3 col-6">
      <!-- small box -->
      <div class="small-box bg-danger">
        <div class="inner">
          <h4>12</h4>
          <p class="m-0">Pesanan batal
            <span class="font-12"><i class="fa fa-arrow-up font-10"></i>80<sup style="font-size: 8px">%</sup></span>
          </p>
        </div>
      </div>
    </span>
    <!-- ./col -->
  </div>

<div class="row m-0">
    <div class="col-lg-8 col-sm-12">
        <div class="card">
            <div class="card-header">
                <h5>Traffic</h5>
            </div>
            <canvas class="max-height-370" id="chart-statistics"></canvas>
        </div>
    </div>
    <div class="col-lg-4 col-sm-12">
        <div class="card">
            <div class="card-header">
                <h5>Pencapaian</h5>
                </div>
                    <div class="statistik-border">
                        <div class="ranked">
                        <h2>Total Point Anda</h2>
                        <h3><a>0</a></h3>
                        <h3> Newbie </h3>
                        <img src="https://assets.exova.id/img/rank/1.png" title="Rank">
                        <h4> 50 points menuju Junior </h4>
                        <div class="rank-step">
                        <ul class="p-0">
                            <li>
                            <img src="https://assets.exova.id/img/rank/1.png" title="Rank">
                            <p>Newbie</p>
                            </li>
                            <li>
                            <img src="https://assets.exova.id/img/rank/2.png" title="Rank">
                            <p>Junior</p>
                            </li>
                            <li>
                            <img src="https://assets.exova.id/img/rank/3.png" title="Rank">
                            <p>Senior</p>
                            </li>
                            <li>
                            <img src="https://assets.exova.id/img/rank/4.png" title="Rank">
                            <p>Master</p>
                            </li>
                        </ul>
                    </div>
                </div>   
            </div>
        </div>
    </div>
    <div class="col-lg-6 col-sm-12">
        <div class="card">
            <div class="card-header">
                <h5>Traffic by Gender</h5>
            </div>
            <canvas class="max-height-370" id="sex-statistics"></canvas>
        </div>
    </div>
    <div class="col-lg-6 col-sm-12">
        <div class="card">
            <div class="card-header">
                <h5>Pendapatan Bulanan</h5>
            </div>
            <canvas class="max-height-370" id="revenue-statistics"></canvas>
        </div>
    </div>
    <div class="col-lg-12 col-sm-12">
        <div class="card">
            <div class="card-header mb-3">
                <h5>Statistik Pendapatan <button class="btn btn-exova float-right"><i class="fa fa-print"></i> Cetak</button></h5>
            </div>
            <div class="table-responsive">
                <table id="table-products" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th style="width:20px;">No</th>
                            <th>Nama Orderan</th>
                            <th>Pendapatan Bersih</th>
                            <th>Pendapatan Kotor</th>
                            <th>Tanggal</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($success as $s)
                        <tr>
                            <td class="text-center">{{ $loop->iteration }}</td>
                            <td>{{ $s->orders['products']['jasa_name'] }}</td>
                            <td>Rp{{ number_format($s->paid, 0) }}</td>
                            <td>Rp{{ number_format($s->amount, 0) }}</td>
                            <td>{{  date('F j, Y', strtotime($s->created_at)) }}</td>
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
        const ctx = $('#chart-statistics');
        const ctxSex = $('#sex-statistics');
        const ctxRev = $('#revenue-statistics');
        const labels = ["Senin", "Selasa", "Rabu", "Kamis", "Jumat", "Sabtu", "Minggu"];
        const sex = ["Wanita", "Pria"];
        const rev = ["Januari", "Februari", "Januari", "Februari", "Januari", "Februari"];
        const data = {
          labels: labels,
          datasets: [
          {
            label: 'Pengunjung',
            data: [55, 49, 10, 56, 45, 34, 12],
            fill: false,
            backgroundColor: '#479cf7',
            pointColor: '#3b8bba',
            borderColor: '#479cf7',
            tension: 0.1
          },
        ]
        };
        const myLineChart = new Chart(ctx, {
          type: 'line',
          data: data,
        });
        const dataSex = {
          labels: sex,
          datasets: [
          {
            label: 'Pengunjung',
            data: [55, 49],
            fill: false,
            backgroundColor: ['#479cf7', '#F8694A'],
            pointColor: '#3b8bba',
            tension: 0.1,
            hoverOffset: 4
          },
        ]
        };
        const dataRev = {
          labels: rev,
          datasets: [
          {
            label: 'Pengunjung',
            data: [55, 49],
            fill: false,
            backgroundColor: ['#479cf7'],
            pointColor: '#3b8bba',
            tension: 0.1,
            hoverOffset: 4
          },
        ]
        };
        const myPieChart = new Chart(ctxSex, {
          type: 'doughnut',
          data: dataSex,
        });
        const myBarChart = new Chart(ctxRev, {
          type: 'bar',
          data: dataRev,
        });
    })
</script>
@endsection