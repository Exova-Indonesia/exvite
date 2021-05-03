@extends('seller.layouts.app')
@section('content')
  <div class="row m-0">
    <span  class="col-lg-3 col-6">
      <!-- small box -->
      <div class="small-box bg-exova">
        <div class="inner">
          <h4>{{ $visitors->where('studio_id', studio()->id)->count() }}</h4>
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
          <h4>{{ rupiah($revenue->sum('paid')) }}</h4>
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
          <h4>{{ $lover->count() }}</h4>
          <p class="m-0">Langganan baru 
            <span class="font-12">
            @if($lover->setGrowth() < 0)
            <i class="fa fa-arrow-down font-10"></i>
            @else
            <i class="fa fa-arrow-up font-10"></i>
            @endif
            {{ $lover->setGrowth() }}
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
          <h4>{{ $lover->count('deleted_at') ?? 0 }}</h4>
          <p class="m-0">Langganan hilang 
            <span class="font-12">
            @if($lover->setGone() < 0)
            <i class="fa fa-arrow-down font-10"></i>
            @else
            <i class="fa fa-arrow-up font-10"></i>
            @endif
            {{ $lover->setGone() }}
            <sup style="font-size: 8px">%</sup></span>
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
                <h5>Pengunjung Harian</h5>
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
                        <h3>{{ $points }}</h3>
                        <h3> Newbie </h3>
                        <img src="{{ $ranks->where('points', '>', $points)->first()->icon }}" title="{{ $ranks->where('points', '>', $points)->first()->name }}">
                        <h4> {{ $ranks->where('points', '>', $points)->first()->points - $points }} points menuju {{ $ranks->where('points', '>', $ranks->where('points', '>', $points)->first()->points)->first()->name }} </h4>
                        <div class="rank-step">
                        <ul class="p-0">
                        @foreach($ranks as $r)
                          <li>
                          <img src="{{ $r->icon }}" title="{{ $r->name }}">
                          <p>{{ $r->name }}</p>
                          </li>
                        @endforeach
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
                <h5>Statistik Pendapatan <a href="{{ route('export.excel') }}" class="btn btn-exova float-right"><i class="fa fa-print"></i> Cetak</a></h5>
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
                            <td>{{ rupiah($s->paid) }}</td>
                            <td>{{ rupiah($s->amount) }}</td>
                            <td>{{ parse_date($s->created_at) }}</td>
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
        const labels = {!! json_encode($visitors->getLabels()) !!};
        const sex = ["Wanita", "Pria"];
        const rev = {!! json_encode($revenue->getLabels()) !!};
        const data = {
          labels: labels,
          datasets: [
          {
            label: 'Pengunjung',
            data: {!! json_encode($visitors->getData()) !!},
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
            data: ["{{ $visitors->setByGender(2) }}", "{{ $visitors->setByGender(1) }}"],
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
            data: {!! json_encode($revenue->getData()) !!},
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