@extends('admin.layouts.master')
@section('content')

<div class="row">
    <!-- Total Users Card -->
    <div class="col-lg-3 col-md-6 col-sm-6">
        <div class="card card-stats">
            <div class="card-body">
                <div class="row align-items-center">
                    <div class="col-5">
                        <div class="icon-big text-center text-primary">
                            <i class="fas fa-users"></i>
                        </div>
                    </div>
                    <div class="col-7 text-right">
                        <p class="card-category">Total Users</p>
                        <h4 class="card-title">{{ $total_user }}</h4>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Total Bolões Ativos Card -->
    <div class="col-lg-3 col-md-6 col-sm-6">
        <div class="card card-stats">
            <div class="card-body">
                <div class="row align-items-center">
                    <div class="col-5">
                        <div class="icon-big text-center text-success">
                            <i class="fas fa-trophy"></i>
                        </div>
                    </div>
                    <div class="col-7 text-right">
                        <p class="card-category">Bolões Ativos</p>
                        <h4 class="card-title">{{ $boloens->count() }}</h4>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Total de Equipes Montadas Card -->
    <div class="col-lg-3 col-md-6 col-sm-6">
        <div class="card card-stats">
            <div class="card-body">
                <div class="row align-items-center">
                    <div class="col-5">
                        <div class="icon-big text-center text-info">
                            <i class="fas fa-users-cog"></i>
                        </div>
                    </div>
                    <div class="col-7 text-right">
                        <p class="card-category">Equipes Montadas</p>
                        <h4 class="card-title">{{ $total_teams }}</h4>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bolões que Atingiram a Meta Card -->
    <div class="col-lg-3 col-md-6 col-sm-6">
        <div class="card card-stats">
            <div class="card-body">
                <div class="row align-items-center">
                    <div class="col-5">
                        <div class="icon-big text-center text-warning">
                            <i class="fas fa-check-circle"></i>
                        </div>
                    </div>
                    <div class="col-7 text-right">
                        <p class="card-category">Meta Atingida</p>
                        <h4 class="card-title">{{ $meta_atingida }}</h4>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection
@section('script')

<script>

var options = {
    series: [{
      name: "Plus Transactions",
      data: [
        @foreach ($report['months'] as $trxDate)
            {{ @$plusTrx->where('months', $trxDate)->first()->amount ?? 0 }},
        @endforeach
      ]
  }, {
    name: 'Minus Transactions',
    data: [
      @foreach ($report['months'] as $trxDate)
          {{ @$minusTrx->where('months', $trxDate)->first()->amount ?? 0 }},
      @endforeach
    ]
  }],
    chart: {
    height: 350,
    type: 'line',
    zoom: {
      enabled: false
    }
  },
  dataLabels: {
    enabled: false
  },
  stroke: {
    curve: 'straight'
  },
  title: {
    text: 'Batting Statistics (Last 12 Month)',
    align: 'left'
  },
  grid: {
    row: {
      colors: ['#f3f3f3', 'transparent'],
      opacity: 0.5
    },
  },
  xaxis: {
    categories:  @json($months)
  }
};

  var chart = new ApexCharts(document.querySelector("#chart"), options);
  chart.render();


  var options = {
      series: [{
      name: 'Total Deposit',
      data: [
        @foreach ($months as $month)
            {{ getAmount(@$depositsMonth->where('months', $month)->first()->depositAmount) }},
        @endforeach
        ]
    }, {
      name: 'Total Withdraw',
      data: [
        @foreach ($months as $month)
            {{ getAmount(@$withdrawalMonth->where('months', $month)->first()->withdrawAmount) }},
        @endforeach
      ]
    }],
      chart: {
      type: 'bar',
      height: 350,
      toolbar: {
          show: false
      }
    },
    title: {
      text: 'Monthly Deposit & Withdraw Report (Last 12 Month)',
      align: 'left'
    },
    plotOptions: {
      bar: {
        horizontal: false,
        columnWidth: '55%',
        endingShape: 'rounded'
      },
    },
    dataLabels: {
      enabled: false
    },
    stroke: {
      show: true,
      width: 2,
      colors: ['transparent']
    },
    xaxis: {
      categories: @json($months),
    },
    fill: {
      opacity: 1
    },
    tooltip: {
      y: {
        formatter: function (val) {
          return "{{ __($general->currency) }} " + val + " "
        }
      }
    }
  };

  var chart3 = new ApexCharts(document.querySelector("#chart3"), options);
  chart3.render();

</script>
@stop
