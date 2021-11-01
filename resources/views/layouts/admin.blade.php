<!DOCTYPE html>

<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="x-ua-compatible" content="ie=edge" >
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <link rel="icon" href="{{ URL::asset('logo3.png') }}">
  <title>{{ config('app.name') }}</title>
  <!-- UKIT Packages-->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/uikit@3.6.17/dist/css/uikit.min.css" />
  <!-- UIkit JS -->
  <script src="https://cdn.jsdelivr.net/npm/uikit@3.6.17/dist/js/uikit.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/uikit@3.6.17/dist/js/uikit-icons.min.js"></script>
  <!-- IonIcons -->
  {{-- <link href="https://unpkg.com/ionicons@4.5.1/dist/css/ionicons.css" rel="stylesheet"> --}}
  <!-- Bootstrap 4 -->
  {{-- <link rel="stylesheet" href={{ asset('/css/bootstrap.min.css') }}> --}}
  <!-- Theme Admin -->
  <link rel="stylesheet" href={{ asset('/css/admin.css') }}>
  {{-- <link rel="stylesheet" href="https://adminlte.io/themes/dev/AdminLTE/dist/css/adminlte.min.css"> --}}
  {{-- <link rel="stylesheet" href={{ asset('admin-lte/plugins/iCheck/all.css') }}> --}}
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <!-- App style -->
  <link rel="stylesheet" href={{ asset('/css/style.css') }}>
  <link rel="stylesheet" href={{ asset('/css/app.css') }}>
  <link rel="stylesheet" href={{ asset('/css/custom.css') }}>
  <link rel="stylesheet" href={{ asset('/css/modal.css') }}>

  {{-- <link rel="stylesheet" href={{ asset('/css/animate.css') }}> --}}
  <!-- Sweet Alert Animation -->
  {{-- <link rel="stylesheet" href="{{asset('https://daneden.github.io/animate.css/animate.min.css')}}"> --}}
  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet">

</head>

<style>
  .nav-dashboard {
    background-color: #3490dc !important;
    color: #fff !important;
  }
  .menu-open a:hover {
    background-color: #ffc107 !important;
    color: #000 !important;
  }
</style>


<body class="hold-transition sidebar-mini">
  <div class="wrapper">

    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-light">
      <!-- Left navbar links -->
      <ul class="navbar-nav">
        <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#"><i class="fa fa-bars"></i></a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
        <a href="/home" class="nav-link">Accueil</a>
        </li>
        {{-- <li class="nav-item d-none d-sm-inline-block">
        <a href="#" class="nav-link">Database</a>
        </li> --}}
      </ul>

      <!-- SEARCH FORM -->
      {{-- <form class="form-inline ml-3">
        <div class="input-group input-group-sm">
        <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
        <div class="input-group-append">
          <button class="btn btn-navbar" type="submit">
          <i class="fa fa-search"></i>
          </button>
        </div>
        </div>
      </form> --}}
      <!-- Right Side Of Navbar -->
      <ul class="navbar-nav ml-auto" >
          <!-- Authentication Links -->
          @guest
            <li class="nav-item">
              <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
            </li>
            @if (Route::has('register'))
              <li class="nav-item">
                <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
              </li>
            @endif
          @else
          <button class="uk-button uk-button-default" type="button">{{ Auth::user()->firstname }} {{ Auth::user()->name }}</button>
<div uk-dropdown>
    <ul class="uk-nav uk-dropdown-nav">
        <li class=uk-dropdown="animation: uk-animation-slide-top-small; duration: 500">
          <a href="/logout">

                  {{ __('Déconnexion') }}
          </a>
        </li>
    </ul>
</div>
            <!--<li class="nav-item dropdown">
              <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                {{ Auth::user()->name }} <span class="caret"></span>
              </a>
              <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                <a class="dropdown-item"  href="{{ route('logout') }}"
                   onclick="event.preventDefault();
                         document.getElementById('logout-form').submit();">

                  {{ __('Déconnexion') }}
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none; ">
                  @csrf
                </form>
              </div>
            </li>-->
          @endguest
      </ul>
      <!-- Right navbar links -->
      {{-- <ul class="navbar-nav ml-auto">
        <!-- Messages Dropdown Menu -->
        <li class="nav-item">
        <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#">
          <i class="fa fa-th-large"></i>
        </a>
        </li>
      </ul> --}}
    </nav>
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
      <!-- Brand Logo -->
      <a href="/home" class="brand-link bg-dark">
      <img src="{{ URL::asset('logo3.png') }}" alt="Medi Experts" style="opacity: .8;" class=" brand-image img-circle elevation-3">
      <span class="brand-text font-weight-light ">Mediexperts</span>
      </a>

      <!-- Sidebar -->
      <div class="sidebar">
      <div class="user-panel mt-3 d-flex">
        <div class=" mb-3 d-flex">
          <div class="image">
            <!--<img src="{{ URL::asset(Auth::user()->photo) }}" class="img-circle elevation-2" alt="User Image"> -->
          </div>
          <div class="info">
          @if (Auth::user()->type_user == "user")
            <h6 class="d-block text-light text-capitalize">{{ Auth::user()->firstname }} {{ Auth::user()->name }}</h6>
            <span class="right badge badge-warning">Utilisateur</span>
          @elseif (Auth::user()->type_user == "admin")
            <h6 class="d-block text-light text-capitalize">{{ Auth::user()->firstname }} {{ Auth::user()->name }}</h6>
            <span class="right badge badge-danger">Administrateur</span>
          @elseif (Auth::user()->type_user == "cc")
          <h6 class="d-block text-light text-capitalize">{{ Auth::user()->firstname }} {{ Auth::user()->name }}</h6>
            <span class="right badge badge-info">Utilisateur Creation Clients</span>
          @else
            <h6 class="d-block text-light text-capitalize">{{ Auth::user()->firstname }} {{ Auth::user()->name }}</h6>
            <span class="right badge badge-info">{{ ucfirst(Auth::user()->type_user) }}</span>
          @endif
          </div>
        </div>
      <!-- Sidebar user panel (optional) -->
      </div>

      
      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column nav-compact" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
             with font-awesome or any other icon font library -->
          @if (Auth::user()->type_user == "user" || Auth::user()->type_user == "admin")
             {{-- dashboard --}}
          <li class="nav-item">
          <a href="/" class="nav-link nav-dashboard">
            <i class="nav-icon fa fa-tachometer-alt"></i>
            <p>Tableau de bord</p>
          </a>
          </li>
         @endif
          @if (Auth::user()->type_user == "admin")
          {{-- users --}}
          <li class="nav-item">
          <a href="/users" class="nav-link">
            <i class="nav-icon fa fa-users"></i>
            <p>Utilisateurs</p>
          </a>
          </li>
          @endif

          <!-- PAGES MENU -->
          {{-- <ul class="nav nav-treeview"> --}}

          <li class="nav-item has-treeview menu-open">
          @if (Auth::user()->type_user == "user" || Auth::user()->type_user == "admin")
            <!-- ANY TABLE SUB MENU -->
            <ul class="nav nav-treeview ">
              <li class="nav-item has-treeview">
                <a href="#" class="nav-link">
                  <i class="nav-icon fa fa-hand-holding-usd"></i>
                  <p>Giacs<i class="fa fa-angle-left right"></i></p>
                </a>
                <!-- * ITEMS SUB MENU -->
                <ul class="nav nav-treeview ml-3">
                  <li class="nav-item">
                    <a href="/add-gc" class="nav-link">
                    <i class="fa fa-plus-circle nav-icon"></i>
                    <p>Ajout</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="/giac" class="nav-link">
                    <i class="fa fa-list nav-icon"></i>
                    <p>Liste</p>
                    </a>
                  </li>
                </ul><!-- * ITEMS SUB MENU -->
              </li>
            </ul><!-- /.ANY TABLE SUB MENU -->

            <!-- ANY TABLE SUB MENU -->
            <ul class="nav nav-treeview">
              <li class="nav-item has-treeview ">
              <a href="#" class="nav-link ">
                <i class="nav-icon fa fa-briefcase"></i>
                <p>Cabinet<i class="fa fa-angle-left right"></i></p>
              </a>
                <!-- * ITEMS SUB MENU -->
                <ul class="nav nav-treeview ml-3">
                  <li class="nav-item ">
                  <a href="/add-cab" class="nav-link">
                    <i class="fa fa-plus-circle nav-icon"></i>
                    <p>Ajout</p>
                  </a>
                  </li>
                  <li class="nav-item">
                  <a href="/cabinet" class="nav-link">
                    <i class="fa fa-list nav-icon"></i>
                    <p>Liste</p>
                  </a>
                  </li>
                </ul><!-- * ITEMS SUB MENU -->
              </li>
            </li><!-- /.ANY TABLE SUB MENU -->
            </ul>

            <ul class="nav nav-treeview ">
              <li class="nav-item has-treeview">
                <a href="#" class="nav-link">
                  <i class="nav-icon fa fa-chalkboard-teacher"></i>
                  <p>Intervenants<i class="fa fa-angle-left right"></i></p>
                </a>
                <!-- * ITEMS SUB MENU -->
                <ul class="nav nav-treeview ml-3">
                  <li class="nav-item">
                    <a href="/add-inv" class="nav-link">
                    <i class="fa fa-plus-circle nav-icon"></i>
                    <p>Ajout</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="/intervenant" class="nav-link">
                    <i class="fa fa-list nav-icon"></i>
                    <p>Liste</p>
                    </a>
                  </li>
                </ul><!-- * ITEMS SUB MENU -->
              </li>
            </ul><!-- /.ANY TABLE SUB MENU -->
            @endif
            
            <!-- ANY TABLE SUB MENU -->
            <ul class="nav nav-treeview">
            <li class="nav-item has-treeview">
              <a href="#" class="nav-link">
                <i class="nav-icon fa fa-handshake"></i>
                <p>Clients<i class="fa fa-angle-left right"></i></p>
              </a>
                <!-- * ITEMS SUB MENU -->
                <ul class="nav nav-treeview ml-3">
                  <li class="nav-item">
                    <a href="/import-client" class="nav-link">
                    <i class="fa fa-upload nav-icon"></i>
                    <p>Importer un fichier</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="/add-cl" class="nav-link">
                    <i class="fa fa-plus-circle nav-icon"></i>
                    <p>Ajout</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="/client" class="nav-link">
                    <i class="fa fa-list nav-icon"></i>
                    <p>Liste</p>
                    </a>
                  </li>
                </ul><!-- * ITEMS SUB MENU -->
                @if (Auth::user()->type_user == "admin" || Auth::user()->type_user == "user")
              {{-- ACTIONNAIRE --}}
                <!-- ANY TABLE SUB MENU -->
                <ul class="nav nav-treeview">
                  <li class="nav-item has-treeview">
                  <a href="#" class="nav-link">
                    <i class="nav-icon fa fa-sitemap"></i>
                    <p>Actionnaires<i class="fa fa-angle-left right"></i></p>
                  </a>
                    <!-- * ITEMS SUB MENU -->
                  <ul class="nav nav-treeview ml-3">
                  <li class="nav-item">
                    <a href="/add-act" class="nav-link">
                    <i class="fa fa-plus-circle nav-icon"></i>
                    <p>Ajout</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="/actionnaire" class="nav-link">
                    <i class="fa fa-list nav-icon"></i>
                    <p>Liste</p>
                    </a>
                  </li>
                  </ul><!-- * ITEMS SUB MENU -->
              </li>
                </ul><!-- /.ANY TABLE SUB MENU -->
              {{-- ACTIONNAIRE --}}
            @endif
            </ul><!-- /.ANY TABLE SUB MENU -->
            @if (Auth::user()->type_user == "user" || Auth::user()->type_user == "admin")
            <ul class="nav nav-treeview ">
              <li class="nav-item has-treeview">
                <a href="#" class="nav-link">
                  <i class="nav-icon fa fa-book-reader"></i>
                  <p>Personnels<i class="fa fa-angle-left right"></i></p>
                </a>
                <!-- * ITEMS SUB MENU -->
                <ul class="nav nav-treeview ml-3">
                  <li class="nav-item">
                    <a href="/import" class="nav-link">
                    <i class="fa fa-upload nav-icon"></i>
                    <p>Importer une liste</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="/add-pers" class="nav-link">
                    <i class="fa fa-plus-circle nav-icon"></i>
                    <p>Ajout</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="/personnel" class="nav-link">
                    <i class="fa fa-list nav-icon"></i>
                    <p>Liste</p>
                    </a>
                  </li>
              </ul><!-- * ITEMS SUB MENU -->
              </li>
            </ul><!-- /.ANY TABLE SUB MENU -->


            <ul class="nav nav-treeview ">
              <li class="nav-item has-treeview">
                <a href="#" class="nav-link">
                  <i class="nav-icon fa fa-calendar-alt"></i>
                  <p>Plans formation<i class="fa fa-angle-left right"></i></p>
                </a>
                <!-- * ITEMS SUB MENU -->
                <ul class="nav nav-treeview ml-3">
                  <li class="nav-item">
                    <a href="/add-plan" class="nav-link">
                    <i class="fa fa-plus-circle nav-icon"></i>
                    <p>Ajout</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="/plan" class="nav-link">
                    <i class="fa fa-list nav-icon"></i>
                    <p>Liste</p>
                    </a>
                  </li>
                </ul><!-- * ITEMS SUB MENU -->
              </li>
            </ul><!-- /.ANY TABLE SUB MENU -->

            <ul class="nav nav-treeview ">
              <li class="nav-item has-treeview">
                <a href="#" class="nav-link">
                  <i class="nav-icon fa fa-clipboard-list"></i>
                  <p>Actions plan formation<i class="fa fa-angle-left right"></i></p>
                </a>
                <!-- * ITEMS SUB MENU -->
                <ul class="nav nav-treeview ml-3">
                  <li class="nav-item">
                    <a href="/add-pf" class="nav-link">
                    <i class="fa fa-plus-circle nav-icon"></i>
                    <p>Ajout</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="/PlanFormation" class="nav-link">
                    <i class="fa fa-list nav-icon"></i>
                    <p>Liste</p>
                    </a>
                  </li>
                </ul><!-- * ITEMS SUB MENU -->
              </li>
            </ul><!-- /.ANY TABLE SUB MENU -->

            <ul class="nav nav-treeview ">
              <li class="nav-item has-treeview">
                <a href="#" class="nav-link">
                  <i class="nav-icon fa fa-chalkboard"></i>
                  <p>Détails actions<i class="fa fa-angle-left right"></i></p>
                </a>
                <!-- * ITEMS SUB MENU -->
                <ul class="nav nav-treeview ml-3">
                  <li class="nav-item">
                    <a href="/add-form" class="nav-link">
                    <i class="fa fa-plus-circle nav-icon"></i>
                    <p>Ajout</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="/formation" class="nav-link">
                    <i class="fa fa-list nav-icon"></i>
                    <p>Liste</p>
                    </a>
                  </li>
                </ul><!-- * ITEMS SUB MENU -->
              </li>
            </ul><!-- /.ANY TABLE SUB MENU -->

            <ul class="nav nav-treeview ">
              <li class="nav-item has-treeview">
                <a href="#" class="nav-link">
                  <i class="nav-icon fa fa-dollar-sign"></i>
                  <p>Demandes financement<i class="fa fa-angle-left right"></i></p>
                </a>
                <!-- * ITEMS SUB MENU -->
                <ul class="nav nav-treeview ml-3">
                  <li class="nav-item">
                    <a href="/add-df" class="nav-link">
                    <i class="fa fa-plus-circle nav-icon"></i>
                    <p>Ajout</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="/df" class="nav-link">
                    <i class="fa fa-list nav-icon"></i>
                    <p>Liste</p>
                    </a>
                  </li>
                </ul><!-- * ITEMS SUB MENU -->
              </li>
            </ul><!-- /.ANY TABLE SUB MENU -->
            <ul class="nav nav-treeview ">
              <li class="nav-item has-treeview">
                <a href="#" class="nav-link">
                  <i class="nav-icon fa fa-file-invoice-dollar"></i>
                  <p>Dem. rembours. GIAC<i class="fa fa-angle-left right"></i></p>
                </a>
                <!-- * ITEMS SUB MENU -->
                <ul class="nav nav-treeview ml-3">
                  {{-- <li class="nav-item">
                    <a href="/add-drb-gc" class="nav-link">
                    <i class="fa fa-plus-circle nav-icon"></i>
                    <p>Ajout</p>
                    </a>
                  </li> --}}
                  <li class="nav-item">
                    <a href="/drb-gc" class="nav-link">
                    <i class="fa fa-list nav-icon"></i>
                    <p>Liste</p>
                    </a>
                  </li>
                </ul><!-- * ITEMS SUB MENU -->
              </li>
            </ul><!-- /.ANY TABLE SUB MENU -->
            <ul class="nav nav-treeview ">
              <li class="nav-item has-treeview">
                <a href="#" class="nav-link">
                  <i class="nav-icon fa fa-file-invoice-dollar"></i>
                  <p>Dem. rembours. OFPPT<i class="fa fa-angle-left right"></i> </p>
                </a>
                <!-- * ITEMS SUB MENU -->
                <ul class="nav nav-treeview ml-3">

                  <li class="nav-item">
                    <a href="/list-drb" class="nav-link">
                    <i class="fa fa-list nav-icon"></i>
                    <p>Liste</p>
                    </a>
                  </li>
                </ul><!-- * ITEMS SUB MENU -->
              </li>
            </ul><!-- /.ANY TABLE SUB MENU -->

            <ul class="nav nav-treeview ">
              <li class="nav-item has-treeview">
                <a href="#" class="nav-link">
                  <i class="nav-icon fa fa-table"></i>
                  <p>Missions intervenant<i class="fa fa-angle-left right"></i></p>
                </a>
                <!-- * ITEMS SUB MENU -->
                <ul class="nav nav-treeview ml-3">
                  <li class="nav-item">
                    <a href="/add-mis-inv" class="nav-link">
                    <i class="fa fa-plus-circle nav-icon"></i>
                    <p>Ajout</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="/mis-inv" class="nav-link">
                    <i class="fa fa-list nav-icon"></i>
                    <p>Liste</p>
                    </a>
                  </li>
                </ul><!-- * ITEMS SUB MENU -->
              </li>
            </ul><!-- /.ANY TABLE SUB MENU -->

            <ul class="nav nav-treeview ">
              <li class="nav-item has-treeview">
                <a href="#" class="nav-link">
                  <i class="nav-icon fa fa-book"></i>
                  <p>Domaines<i class="fa fa-angle-left right"></i></p>
                </a>
                <!-- * ITEMS SUB MENU -->
                <ul class="nav nav-treeview ml-3">
                  <li class="nav-item">
                    <a href="/add-domain" class="nav-link">
                    <i class="fa fa-plus-circle nav-icon"></i>
                    <p>Ajout</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="/domain" class="nav-link">
                    <i class="fa fa-list nav-icon"></i>
                    <p>Liste</p>
                    </a>
                  </li>
                </ul><!-- * ITEMS SUB MENU -->
              </li>
            </ul><!-- /.ANY TABLE SUB MENU -->

            <ul class="nav nav-treeview ">
              <li class="nav-item has-treeview">
                <a href="#" class="nav-link">
                  <i class="nav-icon fa fa-book-open"></i>
                  <p>Thèmes<i class="fa fa-angle-left right"></i></p>
                </a>
                <!-- * ITEMS SUB MENU -->
                <ul class="nav nav-treeview ml-3">
                  <li class="nav-item">
                    <a href="/add-theme" class="nav-link">
                    <i class="fa fa-plus-circle nav-icon"></i>
                    <p>Ajout</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="/theme" class="nav-link">
                    <i class="fa fa-list nav-icon"></i>
                    <p>Liste</p>
                    </a>
                  </li>
                </ul><!-- * ITEMS SUB MENU -->
              </li>
            </ul><!-- /.ANY TABLE SUB MENU -->

          </li>
          @endif
          <!-- /.PAGES MENU -->
        </ul>
        </nav><!-- /.sidebar-menu -->
       
      </div><!-- /.sidebar -->
    </aside>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">

              @yield('content-wrapper')

            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div><!-- /.content-header -->

      <!-- /.content-header -->

      <!-- Main content -->
      <div class="content">
      <div class="container-fluid">
        @yield('content')
      </div><!-- /.container-fluid -->
      </div><!-- /.content -->
    <!-- /.content-wrapper -->

    {{-- infos modal --}}
    <div id="infoModal" class="modal fade">
        <div class="modal-dialog modal-dialog-centered modal-confirm">
            <div class="modal-content">
                <div class="modal-header flex-column">
                    <div class="icon-box icon-box-warning">
                        <i class="material-icons">warning</i>
                    </div>
                    <p class="modal-title h1 pt-3 w-100" id="modalWarningTitle">Avertissement!</p>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                </div>
                <div class="modal-body" id="modalWarningMessage">
                    <p id="modalWarningMessage">
                        {{-- auto filled --}}
                    </p>
                </div>
                <button class="btn btn-warning" data-dismiss="modal">
                    OK
                </button>
            </div>
        </div>
    </div>

    {{-- delete modal --}}
    <div id="deleteModal" class="modal fade">
        <div class="modal-dialog modal-dialog-centered modal-confirm">
            <div class="modal-content">
                <div class="modal-header flex-column">
                    <div class="icon-box icon-box-danger">
                        <i class="material-icons">close</i>
                    </div>
                    <p class="modal-title h1 pt-3 w-100" id="modalDeleteTitle">
                        {{-- title filled from confirmDelete function --}}
                    </p>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                </div>
                <div class="modal-body">
                    <p id="modalDeleteMessage">
                        {{-- message filled from confirmDelete function --}}
                    </p>
                </div>
                <div class="modal-footer justify-content-center">
                    <a href="#" id="deleteBtn" class="btn btn-danger">
                        <i class="material-icons">delete_forever</i>
                        Supprimer
                    </a>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">
                        <i class="material-icons">cancel</i>
                        Annuler
                    </button>
                </div>
            </div>
        </div>
    </div>

    {{-- delete multiple modal --}}
    <div id="deleteMultipleModal" class="modal fade">
        <div class="modal-dialog modal-dialog-centered modal-confirm">
            <div class="modal-content">
                <div class="modal-header flex-column">
                    <div class="icon-box icon-box-danger">
                        <i class="material-icons">close</i>
                    </div>
                    <p class="modal-title h1 pt-3 w-100" id="modalDeleteMultipleTitle">
                        {{-- title filled from confirmDelete function --}}
                    </p>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                </div>
                <div class="modal-body">
                    <p id="modalDeleteMultipleMessage">
                        {{-- message filled from confirmDelete function --}}
                    </p>
                </div>
                <div class="modal-footer justify-content-center">
                    <a href="#" id="deleteMultipleBtn" class="btn btn-danger" onclick="submitMultipleDelete()">
                        <i class="material-icons">delete_forever</i>
                        Supprimer
                    </a>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">
                        <i class="material-icons">cancel</i>
                        Annuler
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Control Sidebar -->
    {{-- <aside class="control-sidebar control-sidebar-dark">
      <!-- Control sidebar content goes here -->
      <div class="p-3">
      <h5>Title</h5>
      <p>Sidebar content</p>
      </div>
    </aside> --}}
    <!-- /.control-sidebar -->

    <!-- Main Footer -->
    {{-- <footer class="main-footer">
      <!-- To the right -->
      <div class="float-right d-none d-sm-inline">

      </div>
      <!-- Default to the left -->
      <strong><a href="#" style="color:#dab515;">Mediexperts&nbsp;</a>
      Copyright &copy; 2021</strong>
    </footer> --}}

    <footer class="main-footer">
      <strong class="">&copy; Mediexperts</strong>
      <strong>{{ date('Y') }}</strong>
      <div class="float-right d-none d-sm-inline-block">
      <b>Version : </b> <strong>2.5</strong>
      </div>
    </footer>

    </div>
    <!-- ./wrapper -->
    <div id="toastsContainerTopRight" class="toasts-top-right fixed">
        {{-- toasts --}}
    </div>

</body>
</html>

<!-- REQUIRED SCRIPTS -->

<!-- jQuery -->

<!-- Bootstrap 4 -->

{{-- <script src={{ asset("js/bootstrap.bundle.js") }}></script> --}}
<!-- AdminLTE App -->

<!-- APP -->

<script src={{ asset('js/jquery.js') }}></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>

<script src={{ asset('js/bootstrap.js') }}></script>
<script src={{ asset('js/admin.js') }}></script>
<script src={{ asset('js/myjs.js') }}></script>


<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

<!-- Delete confirmation Sweet Alert -->
<script>
  function confirmDelete(id, link, parentId = null) {
    $("#deleteModal").modal('show');
    $("#modalDeleteTitle").html("Êtes-vous sur ?");
    $("#modalDeleteMessage").html("Une fois supprimé, vous ne pourrez plus récupérer cet enregistrement!");
    
    if (parentId == null) {
      document.getElementById('deleteBtn').href = `/del-${link}${id}`;
    } else {
      document.getElementById('deleteBtn').href = `/del-${link}${id}/${parentId}`;
    }
  }
  function confirmMultipleDelete(link) {
    $("#deleteMultipleModal").modal('show');
    $('#formMultipleDelete').attr('action', `/del-mult-${link}`);
    $("#modalDeleteMultipleTitle").html("Supprimer la sélection ?");
    $("#modalDeleteMultipleMessage").html("Vous ne pourrez plus récupérer ces enregistrements");
  }
  function submitMultipleDelete() {
    $('#formMultipleDelete').submit();
  }
  function IsChild() {
    $("#infoModal").modal('show');
    $("#modalWarningTitle").html("Avertissement!");
    $("#modalWarningMessage").html("Impossible de supprimer cet enregistrement. Car il contient une relation avec une autre table");
  }
//   function IsChild() {
//     swal("Avertissement!", "Impossible de supprimer cet enregistrement. Car il contient une relation avec une autre table", "warning");
//   }

</script>





{{-- <script src="admin.js" charset="utf-8"></script> --}}

<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.1/Chart.min.js" charset="utf-8"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/highcharts/6.0.6/highcharts.js" charset="utf-8"></script>
<script src="https://cdn.jsdelivr.net/npm/fusioncharts@3.12.2/fusioncharts.js" charset="utf-8"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/echarts/4.0.2/echarts-en.min.js" charset="utf-8"></script>
<script src="https://cdn.jsdelivr.net/npm/frappe-charts@1.1.0/dist/frappe-charts.min.iife.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/d3/5.7.0/d3.min.js"></script>
{{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/c3/0.6.7/c3.min.js"></script> --}}

<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js" charset="utf-8"></script>

<script src="{{ asset('/js/NumberToLetter.js') }}"></script>



{{-- <script src={{ asset("js/app.js") }}></script> --}}
<script src={{ mix("js/app.js") }}></script>

<!-- IONICONS -->
<script src="https://unpkg.com/ionicons@4.5.1/dist/ionicons.js"></script>
