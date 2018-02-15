@extends('backoffice.layouts.index')
@section('js')
<script src="{{url('backoffice/dist/js/loader.js')}}" type="text/javascript"></script>
<script type="text/javascript">
    google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {

        var data = google.visualization.arrayToDataTable([
          ['Task', 'Hours per Day'],
          ['Memiliki Sertifikat', {!! $certificate_user !!}],
          ['Tidak Memiliki Sertifikat', {{ $user - $certificate_user }}],
        ]);

        var options = {
          title: 'Persentase keleseluruhan user yg telah memiliki sertifikat'
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart'));

        chart.draw(data, options);
      }
</script>
<script type="text/javascript">
var ctx = document.getElementById("myChart").getContext('2d');
var units = {!! json_encode($data_units); !!};
var myChart = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: units,
        datasets: [{
            label: 'User Memiliki Sertifikat',
            data: {!! json_encode($user_have_certificates); !!},
            backgroundColor: 'rgba(54, 162, 235, 0.2)',
            borderWidth: 1
        },{
            label: 'User Tidak Memiliki Sertifikat',
            data: {!! json_encode($user_have_not_certificates); !!},
            backgroundColor: 'rgba(255, 99, 132, 0.2)',
            borderWidth: 1
        }]
    },
    options: {
        scales: {
            yAxes: [{
                ticks: {
                    beginAtZero:true
                }
            }]
        }
    }
});
</script>
@stop
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        @if (count($certificate_warnings) > 0)
        <div class="alert alert-warning alert-dismissible fade in" role="alert">
            <button aria-label="Close" class="close" data-dismiss="alert" type="button">
                <span aria-hidden="true">
                    ×
                </span>
            </button>
            @foreach ($certificate_warnings as $certificate_warning)
            @if (Auth::user()->level == \App\Models\User::SUPERADMIN)
                <a href="{{ route('backoffice.certificate.form', $certificate_warning->id) }}">
            @endif
            <p>
                Sertifikat {{ $certificate_warning->name }} dengan User {{ $certificate_warning->user->name }} akan kadaluarsa di tanggal {{ $certificate_warning->date_expired }}
            </p>
            @if (Auth::user()->level == \App\Models\User::SUPERADMIN)
                </a>
            @endif
            @endforeach
        </div>
        @endif
        @if (count($certificate_expireds) > 0)
        <div class="alert alert-danger alert-dismissible fade in" role="alert">
            <button aria-label="Close" class="close" data-dismiss="alert" type="button">
                <span aria-hidden="true">
                    ×
                </span>
            </button>
            @foreach ($certificate_expireds as $certificate_expired)
            @if (Auth::user()->level == \App\Models\User::SUPERADMIN)
                <a href="{{ route('backoffice.certificate.form', $certificate_expired->id) }}">
            @endif
            <p>
                Sertifikat {{ $certificate_expired->name }} Telah Kadaluarsa dengan user {{ $certificate_expired->user->name }}
            </p>
            @if (Auth::user()->level == \App\Models\User::SUPERADMIN)
                </a>
            @endif
            @endforeach
        </div>
        @endif
    </section>
    <!-- Main content -->
    <section class="content">
        @if (Auth::user()->level != \App\Models\User::USER)
        <!-- Small boxes (Stat box) -->
        <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-aqua">
                <div class="inner">
                    <h3>
                        {{ $certificate }}
                    </h3>
                    <p>
                        Sertifikat
                    </p>
                </div>
                <div class="icon">
                    <i class="fa fa-credit-card">
                    </i>
                </div>
            </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-green">
                <div class="inner">
                    <h3>
                        {{ $history }}
                    </h3>
                    <p>
                        History
                    </p>
                </div>
                <div class="icon">
                    <i class="fa fa-history">
                    </i>
                </div>
            </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-red">
                <div class="inner">
                    <h3>
                        {{ $user }}
                    </h3>
                    <p>
                        User
                    </p>
                </div>
                <div class="icon">
                    <i class="fa fa-user">
                    </i>
                </div>
            </div>
        </div>
        @endif
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-yellow">
                <div class="inner">
                    <h3>
                        {{ $training }}
                    </h3>
                    <p>
                        Diklat
                    </p>
                </div>
                <div class="icon">
                    <i class="fa fa-address-card-o">
                    </i>
                </div>
            </div>
        </div>

        <div class="row">
            <section class="col-lg-12 connectedSortable">
                @if (Auth::user()->level != \App\Models\User::USER)
                    <div class="box box-info">
                        <div class="box-body">
                            <div id="piechart" style="width: 100%; height: 350px;"></div>
                        </div>
                    </div>

                    <div class="box box-info">
                        <div class="box-body">
                            <canvas id="myChart" width="400" height="400"></canvas>
                        </div>
                    </div>
                @endif
            </section>
        </div>
    </section>
    <!-- /.box -->
</div>
<!-- /.content -->
@stop
