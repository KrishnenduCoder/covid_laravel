<!DOCTYPE html>
<html lang="en">

<head>
    {{--  Favicon  --}}
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('images/favicon/apple-touch-icon.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('images/favicon/favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('images/favicon/favicon-16x16.png') }}">
    <link rel="manifest" href="{{ asset('images/favicon/site.webmanifest') }}">
    <link rel="shortcut icon" href="{{ asset('images/favicon/favicon.ico') }}">
    {{--  Favicon: End  --}}
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Covid Report - @yield('title')</title>

    {{--    Bootstrap core CSS--}}
    <link href="{{ asset('vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    {{--  Font awesome  --}}
    <link rel="stylesheet" href="{{ asset('assets/font-awesome/css/font-awesome.min.css') }}">
    {{--  Custom styles for this template  --}}
    <link href="{{ asset('app/css/simple-sidebar.css') }}" rel="stylesheet">
    <link href="{{ asset('app/css/style.css') }}" rel="stylesheet">
    {{--  Datatable CSS  --}}
    <link href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css" rel="stylesheet">
</head>

<body>

<div class="d-flex" id="wrapper">
    <!-- Sidebar -->
    <div class="bg-light border-right" id="sidebar-wrapper">
        <div class="sidebar-heading">
            <span class="sidebar-title">COVID REPORT</span>
        </div>
        <div class="list-group list-group-flush">
            <a href="{{ url('/') }}" class="list-group-item list-group-item-action bg-light" data-toggle="tooltip" data-placement="right" title="Home"> <i class="fa fa-home"></i> <span class="leftcol-title">HOME</span></a>
            <a href="{{ url('/india') }}" class="list-group-item list-group-item-action bg-light" data-toggle="tooltip" data-placement="right" title="India"> <i class="fa fa-globe"></i> <span class="leftcol-title">INDIA</span></a>
            <a href="#" class="list-group-item list-group-item-action bg-light" data-toggle="tooltip" data-placement="right" title="Prevention"> <i class="fa fa-shield"></i> <span class="leftcol-title">PREVENTIONS</span></a>
            <a href="#" class="list-group-item list-group-item-action bg-light" data-toggle="tooltip" data-placement="right" title="Symptoms"> <i class="fa fa-sun-o"></i> <span class="leftcol-title">SYMPTOMS</span></a>
            <a href="#" class="list-group-item list-group-item-action bg-light" data-toggle="tooltip" data-placement="right" title="Myth-Busters"> <i class="fa fa-user-secret"></i> <span class="leftcol-title">MYTH BUSTERS</span></a>
            <a href="#" class="list-group-item list-group-item-action bg-light" data-toggle="tooltip" data-placement="right" title="FAQ"> <i class="fa fa-question-circle-o"></i> <span class="leftcol-title">FAQ</span></a>
            <span class="list-group-item list-group-item-action bg-light"> </span>
        </div>
    </div>
    <!-- /#sidebar-wrapper -->

    <!-- Page Content -->
    <div id="page-content-wrapper">

        <nav class="navbar navbar-expand-lg navbar-light bg-light border-bottom">
            <button class="btn btn-primary" id="menu-toggle">Toggle Menu</button>

            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
        </nav>

        <div class="container-fluid">
            @yield('pageheader')
            @yield('content')
        </div>
    </div>
    <!-- /#page-content-wrapper -->

</div>
<!-- /#wrapper -->

<!-- Bootstrap core JavaScript -->
<script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
{{--  Chart JS --}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script>
{{--  Datatable JS  --}}
<script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
{{--  Menu Toggle Script  --}}
<script>
    $("#menu-toggle").click(function(e) {
        e.preventDefault();
        $("#wrapper").toggleClass("toggled");
    });

    // TOOLTIP
    $(document).ready(function(){
        $('[data-toggle="tooltip"]').tooltip();
    });

    // Datatable all country list
    $(document).ready( function () {
        $('#allcountry-stat-list').DataTable({
            order: [[1, 'desc']],
            paging:   false,
            scrollY: 300,
            searching: false,
        });
    } );
</script>

@yield('chartScripts')

</body>
</html>
