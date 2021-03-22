<!DOCTYPE html>

<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <title>AdminLTE 3 | {{ config('app.name') }}</title>
  <!-- IonIcons -->
  <link rel="stylesheet" href={{ asset('http://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css') }}>
  <!-- Theme AdminLTE -->
  <link rel="stylesheet" href={{ asset('css/adminlte.min.css') }}>
  {{-- <link rel="stylesheet" href={{ asset('css/adminlte.css') }}> --}}
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href={{ asset('css/font-awesome.min.css') }}>
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
  <!-- Theme style -->
  <link rel="stylesheet" href={{ asset('css/bootstrap.min.css') }}>
  <!-- App style -->
  {{-- <link rel="stylesheet" href={{ asset('css/style.css') }}> --}}

</head>
<body>

<div class="wrapper">
    <nav class="main-header navbar navbar-expand bg-dark navbar-light border-bottom">
        <!-- Left navbar links -->
        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#"><i class="fa fa-bars"></i></a>
          </li>
          <li class="nav-item d-none d-sm-inline-block">
            <a href="/dashboard" class="nav-link">Home</a>
          </li>
          <li class="nav-item d-none d-sm-inline-block">
            <a href="#" class="nav-link">Database</a>
          </li>
        </ul>


        <!-- Right navbar links -->
        <ul class="navbar-nav ml-auto">
          <!-- Messages Dropdown Menu -->
          <li class="nav-item">
            <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#">
              <i class="fa fa-th-large"></i>
            </a>
          </li>
        </ul>
    </nav>
</div><!--/.wrapper-->

</body>

</html>

        <!-- REQUIRED SCRIPTS -->

        <!-- jQuery -->
        {{-- <script src={{ asset("js/jquery.js") }}></script> --}}
        <script src={{ asset("js/jquery.min.js") }}></script>
        <!-- Bootstrap 4 -->
        {{-- <script src={{ asset("js/bootstrap.js") }}></script>
        <script src={{ asset("js/bootstrap.min.js") }}></script> --}}
        {{-- <script src={{ asset("js/bootstrap.bundle.js") }}></script> --}}
        <script src={{ asset("js/bootstrap.bundle.min.js") }}></script>
        <!-- AdminLTE App -->
        {{-- <script src={{ asset("js/adminlte.js") }}></script> --}}
        <script src={{ asset("js/adminlte.min.js") }}></script>
        <!-- APP -->
        {{-- <script src={{ asset("js/app.js") }}></script> --}}
        <script src={{ asset('js/myjs.js') }}></script>
