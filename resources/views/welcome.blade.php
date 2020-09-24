<!DOCTYPE html>
<html lang="en">
<!-- Mirrored from themesbrand.com/agroxa/green/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 24 Jun 2020 07:26:16 GMT -->

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=0,minimal-ui" />
    <title>Survey app</title>
    <meta content="Admin Dashboard" name="description" />
    <meta content="Themesbrand" name="author" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    {{-- <link rel="shortcut icon" href="{{asset('images/logo.png')}}" /> --}}
    <link rel="stylesheet" href="{{asset('plugins/morris/morris.css')}}">
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('css/metismenu.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('css/icons.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('css/style.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('plugins/datatables/responsive.bootstrap4.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('plugins/datatables/buttons.bootstrap4.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('plugins/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet" type="text/css">
    <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/bootstrap.daterangepicker/2/daterangepicker.css"/>


</head>
<body>
    <div id="app">
        <main-component />

    </div>



<script src="{{ asset('js/app.js') }}"></script>
<script src="{{asset('js/jquery.min.js')}}"></script>
<!-- Charting library -->
<script src="https://unpkg.com/echarts/dist/echarts.min.js"></script>
<!-- Chartisan -->
<script src="https://unpkg.com/@chartisan/echarts/dist/chartisan_echarts.js"></script>


<script src="{{asset('js/bootstrap.bundle.min.js')}}"></script>
<script src="{{asset('js/metisMenu.min.js')}}"></script>
<script src="{{asset('js/jquery.slimscroll.js')}}"></script>
<script src="{{asset('js/waves.min.js')}}"></script>
<script src="{{asset('plugins/jquery-sparkline/jquery.sparkline.min.js')}}"></script>
<!-- Peity JS -->
<script src="{{asset('plugins/peity/jquery.peity.min.js')}}"></script>
<script src="{{asset('plugins/morris/morris.min.js')}}"></script>
<script src="{{asset('plugins/raphael/raphael-min.js')}}"></script>
<script src="{{asset('pages/dashboard.js')}}"></script>
<script src="{{asset('pages/chartjs.init.js')}}"></script>
<script src="{{asset('plugins/chartist/js/chartist.min.js')}}"></script>
<!-- Data tables js -->
<script src="{{ asset('plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('plugins/datatables/dataTables.bootstrap4.min.js') }}"></script><!-- Buttons examples -->
<script src="{{ asset('plugins/datatables/dataTables.buttons.min.js') }}"></script>
<script src="{{ asset('plugins/datatables/buttons.bootstrap4.min.js') }}"></script>
<script src="{{ asset('plugins/datatables/jszip.min.js') }}"></script>
<script src="{{ asset('plugins/datatables/pdfmake.min.js') }}"></script>
<script src="{{ asset('plugins/datatables/vfs_fonts.js') }}"></script>
<script src="{{ asset('plugins/datatables/buttons.html5.min.js') }} "></script>
<script src="{{ asset('plugins/datatables/buttons.print.min.js') }}"></script>
<script src="{{ asset('plugins/datatables/buttons.colVis.min.js') }}"></script><!-- Responsive examples -->
<script src="{{ asset('plugins/datatables/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('plugins/datatables/responsive.bootstrap4.min.js') }}"></script><!-- Datatable init js -->
<script src="{{asset('plugins/select2/js/select2.min.js')}}"></script>

<!-- Date picker js -->
<script src="{{asset('plugins/bootstrap-md-datetimepicker/js/moment-with-locales.min.js')}}"></script>
<script src="{{asset('plugins/bootstrap-md-datetimepicker/js/bootstrap-material-datetimepicker.js')}}"></script>
<script src="{{asset('plugins/moment/moment.js')}}"></script>
<script src="{{asset('plugins/x-editable/js/bootstrap-editable.min.js')}}"></script>
<script src="{{asset('pages/xeditable.js')}}"></script>

<!-- App js -->
<script src="{{ asset('js/application.js') }}"></script>
<script src="{{ asset('pages/datatables.init.js') }}"></script><!-- App js -->
<!-- Include Required Prerequisites -->
<script type="text/javascript" src="//cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>

<!-- Include Date Range Picker -->
<script type="text/javascript" src="//cdn.jsdelivr.net/bootstrap.daterangepicker/2/daterangepicker.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.6.0/Chart.bundle.js" charset="utf-8"></script>


</body>
</html>
