<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta content="IE=edge" http-equiv="X-UA-Compatible">
        <title>
            PLN Backoffice
        </title>
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <meta content="{{ csrf_token() }}" name="csrf-token">
        <link href="{{url('backoffice/bower_components/bootstrap/dist/css/bootstrap.min.css')}}" rel="stylesheet">
        <link href="{{url('backoffice/bower_components/font-awesome/css/font-awesome.min.css')}}" rel="stylesheet">
        <link href="{{url('backoffice/bower_components/Ionicons/css/ionicons.min.css')}}" rel="stylesheet">
        <link href="{{url('backoffice/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css')}}" rel="stylesheet">
        <link href="{{url('backoffice/bower_components/PACE/pace.css')}}" rel="stylesheet">
        <link href="{{url('backoffice/dist/css/AdminLTE.min.css')}}" rel="stylesheet">
        <link href="{{url('backoffice/dist/css/skins/_all-skins.min.css')}}" rel="stylesheet">
        <link href="{{url('backoffice/dist/css/datatable.css')}}" rel="stylesheet">
        <link href="{{url('backoffice/sweetalert/sweetalert2.css')}}" rel="stylesheet" type="text/css">
        <link href="{{url('backoffice/bootstrap-daterangepicker/daterangepicker.css')}}" rel="stylesheet" type="text/css">
        <style type="text/css">
            .box-header {
            color: #444;
            display: block;
            padding: 30px;
            position: relative;
        }
        label.required::before {
          content: '*';
          margin-right: 4px;
          color: red;
        }
        </style>
        @yield('css')
    </head>
    <body class="hold-transition skin-blue sidebar-mini">
        <div class="wrapper">
            @include('backoffice._partials.header')
            <!-- Left side column. contains the logo and sidebar -->
            @include('backoffice._partials.side')
            <!-- Content Wrapper. Contains page content -->
            @yield('content')
            <!-- /.content-wrapper -->
            @include('backoffice._partials.footer')
            <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
        </div>
        <!-- ./wrapper -->
        <!-- jQuery 3 -->
        <script src="{{url('backoffice/bower_components/jquery/dist/jquery.min.js')}}"></script>
        <!-- jQuery UI 1.11.4 -->
        <script src="{{url('backoffice/bower_components/jquery-ui/jquery-ui.min.js')}}"></script>
        <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
        <script>
            $.widget.bridge('uibutton', $.ui.button);
        </script>
        <!-- Bootstrap 3.3.7 -->
        <script src="{{url('backoffice/bower_components/bootstrap/dist/js/bootstrap.min.js')}}"></script>
        <!-- datepicker -->
        <script src="{{url('backoffice/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js')}}"></script>
        <!-- FastClick -->
        <script src="{{url('backoffice/bower_components/fastclick/lib/fastclick.js')}}"></script>
        <!-- PACE -->
        <script src="{{url('backoffice/bower_components/PACE/pace.min.js')}}"></script>
        <!-- AdminLTE App -->
        <script src="{{url('backoffice/dist/js/adminlte.min.js')}}"></script>
        <script src="{{url('backoffice/dist/js/datatable.js')}}"></script>
        <script src="{{url('backoffice/dist/js/chart.js')}}"></script>
        <script src="{{url('backoffice/dist/js/chart-bundle.js')}}"></script>
        <script src="{{url('backoffice/sweetalert/sweetalert2.min.js')}}"></script>
        <script src="{{url('backoffice/bootstrap-daterangepicker/moment.min.js')}}"></script>
        <script src="{{url('backoffice/bootstrap-daterangepicker/daterangepicker.js')}}"></script>
        @include('sweet::alert')
        <script type="text/javascript">
            var date = new Date();
            var firstDay = new Date(date.getFullYear(), date.getMonth(), 1);
            var lastDay = new Date(date.getFullYear(), date.getMonth() + 1, 0);
            var valuetanggal = $('.searchdate').attr('data-tanggal');
            $('.demo').daterangepicker({
                format: 'yyyy-mm-dd',
                ranges: {
                    'Kemarin': [moment().add(-1, 'day'), date],
                    '1 Bulan': [moment().add(-1, 'month'), date],
                    '2 Bulan': [moment().add(-2, 'month'), date],
                    '3 Bulan': [moment().add(-3, 'month'), date],
                    '6 Bulan': [moment().add(-6, 'month'), date],
                    '1 Tahun': [moment().add(-1, 'year'), date]
                },
                showDropdowns: true,
                showWeekNumbers: true,
                showISOWeekNumbers: true,
                linkedCalendars: false,
                alwaysShowCalendars: true,
                startDate: firstDay,
                endDate: lastDay
            }, function(start, end, label) {}).val(valuetanggal);
        </script>
        <script type="text/javascript">
            $(document).ready(function(){
                $('#myTable').DataTable();
                $('.display').dataTable();
            });
        </script>
        @yield('script')
        @yield('js')
    </body>
</html>
