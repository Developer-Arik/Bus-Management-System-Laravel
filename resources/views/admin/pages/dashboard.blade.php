@extends('admin.master')
@section('style')
    <meta name="rst" value="{{ $RecentSaleingStatistics }}">
    <meta name="mst" value="{{ $MonthSaleingStatistics }}">
@endsection
@section('body')
  <nav class="breadcrumb sl-breadcrumb">
    <a class="breadcrumb-item" href="{{ route('admin.dashboard') }}">Starlight</a>
    <span class="breadcrumb-item active">Dashboard</span>
  </nav>
  <div class="sl-pagebody">
    <div class="row row-sm">
      <div class="col-sm-6 col-xl-4">
        <div class="card pd-20 bg-primary">
          <div class="d-flex justify-content-between align-items-center mg-b-10">
            <h6 class="tx-11 tx-uppercase mg-b-0 tx-spacing-1 tx-white">Today's Sales</h6>
            <a href="" class="tx-white-8 hover-white"><i class="icon ion-android-more-horizontal"></i></a>
          </div><!-- card-header -->
          <div class="d-flex align-items-center justify-content-between">
            {{-- <span class="sparkline2">5,3,9,6,5,9,7,3,5,2</span> --}}
            <h3 class="mg-b-0 tx-white tx-lato tx-bold">৳{{ $TodaySale }}</h3>
          </div><!-- card-body -->
          <div class="d-flex align-items-center justify-content-between mg-t-15 bd-t bd-white-2 pd-t-10">
            <div>
              <span class="tx-11 tx-white-6">Gross Sales</span>
              <h6 class="tx-white mg-b-0">৳{{ $GrossSale }}</h6>
            </div>
          </div><!-- -->
        </div><!-- card -->
      </div><!-- col-3 -->
      <div class="col-sm-6 col-xl-4 mg-t-20 mg-sm-t-0">
        <div class="card pd-20 bg-info">
          <div class="d-flex justify-content-between align-items-center mg-b-10">
            <h6 class="tx-11 tx-uppercase mg-b-0 tx-spacing-1 tx-white">This Week's Sales</h6>
            <a href="" class="tx-white-8 hover-white"><i class="icon ion-android-more-horizontal"></i></a>
          </div><!-- card-header -->
          <div class="d-flex align-items-center justify-content-between">
            {{-- <span class="sparkline2">5,3,9,6,5,9,7,3,5,2</span> --}}
            <h3 class="mg-b-0 tx-white tx-lato tx-bold">৳{{ $WeeksSale }}</h3>
          </div><!-- card-body -->
          <div class="d-flex align-items-center justify-content-between mg-t-15 bd-t bd-white-2 pd-t-10">
            <div>
              <span class="tx-11 tx-white-6">Gross Sales</span>
              <h6 class="tx-white mg-b-0">৳{{ $GrossSale }}</h6>
            </div>
          </div><!-- -->
        </div><!-- card -->
      </div><!-- col-3 -->
      <div class="col-sm-6 col-xl-4 mg-t-20 mg-xl-t-0">
        <div class="card pd-20 bg-purple">
          <div class="d-flex justify-content-between align-items-center mg-b-10">
            <h6 class="tx-11 tx-uppercase mg-b-0 tx-spacing-1 tx-white">This Month's Sales</h6>
            <a href="" class="tx-white-8 hover-white"><i class="icon ion-android-more-horizontal"></i></a>
          </div><!-- card-header -->
          <div class="d-flex align-items-center justify-content-between">
            {{-- <span class="sparkline2">5,3,9,6,5,9,7,3,5,2</span> --}}
            <h3 class="mg-b-0 tx-white tx-lato tx-bold">৳{{ $MonthSale }}</h3>
          </div><!-- card-body -->
          <div class="d-flex align-items-center justify-content-between mg-t-15 bd-t bd-white-2 pd-t-10">
            <div>
              <span class="tx-11 tx-white-6">Gross Sales</span>
              <h6 class="tx-white mg-b-0">৳{{ $GrossSale }}</h6>
            </div>
          </div><!-- -->
        </div><!-- card -->
      </div><!-- col-3 -->
    </div><!-- row -->
    <p class="tx-11 tx-uppercase tx-spacing-2 mg-t-40 mg-b-10 tx-gray-600">Statistics</p>
    <div class="row row-sm">
        <div class="col-sm-6 col-xl-6">
            <div class="card pd-20 pd-sm-40">
                <div class="chartjs-size-monitor" style="position: absolute; inset: 0px; overflow: hidden; pointer-events: none; visibility: hidden; z-index: -1;"><div class="chartjs-size-monitor-expand" style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;"><div style="position:absolute;width:1000000px;height:1000000px;left:0;top:0"></div></div><div class="chartjs-size-monitor-shrink" style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;"><div style="position:absolute;width:200%;height:200%;left:0; top:0"></div></div></div>
                  <h6 class="card-body-title">Recent Selling</h6>
                  <p id="tpp" class="mg-b-20 mg-sm-b-30">Today Profit Percentage : </p>
                  <canvas id="chartBar1" height="450" width="603" style="display: block; height: 300px; width: 402px;" class="chartjs-render-monitor"></canvas>
            </div>
        </div>
        <div class="col-sm-6 col-xl-6">
            <div class="card pd-20 pd-sm-40">
                <div class="chartjs-size-monitor" style="position: absolute; inset: 0px; overflow: hidden; pointer-events: none; visibility: hidden; z-index: -1;"><div class="chartjs-size-monitor-expand" style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;"><div style="position:absolute;width:1000000px;height:1000000px;left:0;top:0"></div></div><div class="chartjs-size-monitor-shrink" style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;"><div style="position:absolute;width:200%;height:200%;left:0; top:0"></div></div></div>
                  <h6 class="card-body-title">Recent Month Selling Statististics</h6>
                  <p id="tpm" class="mg-b-20 mg-sm-b-30">Today Profit Percentage : </p>
                  <canvas id="chartBar2" height="450" width="603" style="display: block; height: 300px; width: 402px;" class="chartjs-render-monitor"></canvas>
            </div>
        </div>
    </div>
    </div><!-- sl-pagebody -->
@endsection
@section('script')
<script>
    var ctx = document.getElementById('chartBar1').getContext('2d');
    var arr = JSON.parse($("meta[name=rst]").attr('value').toString());
    $("#tpp").html(arr.profitRateToday<0 ? "Today Loss Percentage : "+arr.lossRateToday.toString()+"%" : "Today Profit Percentage : "+arr.profitRateToday.toString()+"%");

    new Chart(ctx, {
        type: 'line',
        data: {
        labels: arr.labels,
        datasets: [{
            label: 'Sellings',
            data: [...arr.ammount],
            fill: false,
            borderColor: '#27AAC8'
        }]
        },
        options: {
            legend: {
                display: false,
                labels: {
                    display: false
                }
            },
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero:true,
                        fontSize: 10,
                        max: Math.max(...arr.ammount)
                    }
                }],
                xAxes: [{
                    ticks: {
                        beginAtZero:true,
                        fontSize: 11
                    }
                }]
            }
        }
    });


    var ctx = document.getElementById('chartBar2').getContext('2d');
    var arr = JSON.parse($("meta[name=mst]").attr('value').toString());
    $("#tpm").html(arr.profitRateToday<0 ? "Loss Percentage This Month : "+arr.lossRateToday.toString()+"%" : "Profit Percentage This Month : "+arr.profitRateToday.toString()+"%");

    new Chart(ctx, {
        type: 'line',
        data: {
        labels: arr.labels,
        datasets: [{
            label: 'Sellings',
            data: [...arr.ammount],
            fill: false,
            borderColor: '#27AAC8'
        }]
        },
        options: {
            legend: {
                display: false,
                labels: {
                    display: false
                }
            },
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero:true,
                        fontSize: 10,
                        max: Math.max(...arr.ammount)
                    }
                }],
                xAxes: [{
                    ticks: {
                        beginAtZero:true,
                        fontSize: 11
                    }
                }]
            }
        }
    });
</script>
@endsection
