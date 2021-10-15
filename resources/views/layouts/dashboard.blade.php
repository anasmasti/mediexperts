@extends('layouts.admin')

@section('content')

<div class="content-header">

  @if (Auth::user()->type_user == "admin" || Auth::user()->type_user != "comptable")
    <div class="row mb-2">
        <div class="col-sm-6">
        <h1 class="m-0 text-dark">Tableau de bord</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Tableau de bord</li>
        </ol>
        </div><!-- /.col -->
    </div><!-- /.row -->
  @endif
</div>


<div class="container-fluid">
<div class="row">

      @if (Auth::user()->type_user == "admin" || Auth::user()->type_user == "user")
      @if (Auth::user()->type_user == "admin")
        <div class="col-lg-3 col-6">
          <!-- small card -->
          <div class="small-box bg-primary">
            <div class="inner">
            <h3>{{$user}}</h3>
              <p>Utilisateurs</p>
            </div>
            <div class="icon">
              <i class="fas fa-users"></i>
            </div>
            <a href="/users" class="small-box-footer">
            Voir plus <i class="fa fa-arrow-circle-right"></i>
            </a>
          </div>
        </div>
      @endif
        <!-- ./col -->
        <div class="col-lg-3 col-6">
          <!-- small card -->
          <div class="small-box bg-success">
            <div class="inner">
              <h3>{{$client}}</h3>
              <p>Client</p>
            </div>
            <div class="icon">
                <i class="fas fa-handshake"></i>

            </div>
            <a href="/client" class="small-box-footer">
              Voir plus <i class="fa fa-arrow-circle-right"></i>
            </a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-6">
            <!-- small card -->
            <div class="small-box bg-secondary">
              <div class="inner">
                <h3>{{$actionnaire}}</h3>
                <p>Actionnaire</p>
              </div>
              <div class="icon">
                <i class="fa fa-sitemap"></i>
              </div>
              <a href="/actionnaire" class="small-box-footer">
              Voir plus <i class="fa fa-arrow-circle-right"></i>
              </a>
            </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-6">
          <!-- small card -->
          <div class="small-box bg-danger">
            <div class="inner">
              <h3> {{$client}} </h3>
              <p>Cabinet</p>
            </div>
            <div class="icon">
                <i class="fa fa-briefcase"></i>
            </div>
            <a href="/cabinet" class="small-box-footer">
            Voir plus <i class="fa fa-arrow-circle-right"></i>
            </a>
          </div>
        </div>
    <!-- ./col -->
    <div class="col-lg-3 col-6">
        <!-- small card -->
        <div class="small-box bg-warning">
          <div class="inner">
          <h3>{{$giac}}</h3>
            <p>Giac</p>
          </div>
          <div class="icon">
              <i class="fa fa-hand-holding-usd"></i>
          </div>
          <a href="/giac" class="small-box-footer">
          Voir plus <i class="fa fa-arrow-circle-right"></i>
          </a>
        </div>
    </div>
    <!-- ./col -->

    <div class="col-lg-3 col-6">
        <!-- small card -->
        <div class="small-box bg-light">
          <div class="inner">
            <h3>{{$intervenant}}</h3>
            <p>Intervenant</p>
          </div>
          <div class="icon">
            <i class="fas fa-chalkboard-teacher"></i>
          </div>
          <a href="/intervenant" class="small-box-footer">
          Voir plus <i class="fa fa-arrow-circle-right"></i>
          </a>
        </div>
    </div>
    <!-- ./col -->

    <!-- ./col -->
    <div class="col-lg-3 col-6">
            <!-- small card -->
        <div class="small-box bg-primary">
          <div class="inner">
            <h3>{{$plan}}</h3>
            <p>Plan formation</p>
          </div>
          <div class="icon">
            <i class="fas fa-calendar-alt"></i>
          </div>
          <a href="/PlanFormation" class="small-box-footer">
          Voir plus <i class="fa fa-arrow-circle-right"></i>
          </a>
        </div>
    </div>
    <!-- ./col -->

    <!-- ./col -->
    <div class="col-lg-3 col-6">
            <!-- small card -->
        <div class="small-box bg-success">
          <div class="inner">
            <h3>{{$formation}}</h3>
            <p>Détails actions</p>
          </div>
          <div class="icon">
            <i class="fas fa-chalkboard"></i>
          </div>
          <a href="/formation" class="small-box-footer">
          Voir plus <i class="fa fa-arrow-circle-right"></i>
          </a>
        </div>
    </div>
    <!-- ./col -->

    <div class="col-lg-3 col-6">
        <!-- small card -->
        <div class="small-box bg-secondary">
          <div class="inner">
            <h3>{{$df}}</h3>
            <p>Demande financement</p>
          </div>
          <div class="icon">
            <i class="fas fa-dollar-sign"></i>
          </div>
          <a href="/df" class="small-box-footer">
          Voir plus <i class="fa fa-arrow-circle-right"></i>
          </a>
        </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-6">
        <!-- small card -->
        <div class="small-box bg-danger">
          <div class="inner">
            <h3>{{$drb1}}</h3>
            <p>Dem. Rembour. GIAC</p>
          </div>
          <div class="icon">
            <i class="fas fa-file-invoice-dollar"></i>
          </div>
          <a href="/drb-gc" class="small-box-footer">
          Voir plus <i class="fa fa-arrow-circle-right"></i>
          </a>
        </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-6">
      <!-- small card -->
      <div class="small-box bg-warning">
        <div class="inner">
          <h3>{{$drb2}}</h3>
          <p>Dem. Rembour. OFPPT</p>
        </div>
        <div class="icon">
          <i class="fas fa-file-invoice-dollar"></i>
        </div>
        <a href="/drb-of" class="small-box-footer">
        Voir plus <i class="fa fa-arrow-circle-right"></i>
        </a>
      </div>
    </div>
    <div class="col-lg-3 col-6">
      <!-- small card -->
      <div class="small-box bg-light">
          <div class="inner">
              <h3>{{$misinv}}</h3>
              <p>Mission intervenant</p>
          </div>
          <div class="icon">
              <i class="fas fa-table"></i>
          </div>
          <a href="/df" class="small-box-footer">
          Voir plus <i class="fa fa-arrow-circle-right"></i>
          </a>
      </div>
    </div>
    <!-- ./col -->
    </div><!-- ./ROW -->

</div>{{-- container fluid --}}


{{-- --------------------------------------------------------------------------------- --}}
  <div class="content-header">
      <div class="row mb-2">
          <div class="col-sm-6">
              <h1 class="m-0 text-dark">Nomenclature</h1>
          </div><!-- /.col -->
      </div><!-- /.row -->
  </div>
    {{-- ------ --}}
    <div class="container-fluid">

        <div class="row">
                <div class="col-lg-6 col-sm-12 col-md-6">
                <div class="info-box mb-3">
                    <span class="info-box-icon bg-success elevation-1"><i class="fas fa-book"></i></span>

                    <div class="info-box-content">
                    <span class="info-box-text">Domaines</span>
                    <span class="info-box-number">{{ $domaine }}</span>
                    </div>
                    <div class="float-right">
                        <a href="/add-domain" class="btn btn-success btn-sm"><i class="fas fa-plus"></i></a>
                        <a href="/domain" class="btn btn-success btn-sm"><i class="fas fa-th-list"></i></a>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
                </div>
                <!-- /.col -->
                <div class="col-lg-6 col-sm-12 col-md-6">
                <div class="info-box mb-3">
                    <span class="info-box-icon bg-secondary elevation-1"><i class="fas fa-book-open"></i></span>

                    <div class="info-box-content">
                    <span class="info-box-text">Thèmes</span>
                    <span class="info-box-number">{{ $theme }}</span>
                    </div>
                    <div class="float-right">
                        <a href="/add-theme" class="btn btn-secondary btn-sm"><i class="fas fa-plus"></i></a>
                        <a href="/theme" class="btn btn-secondary btn-sm"><i class="fas fa-th-list"></i></a>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
                </div>
            <!-- /.col -->

                {{-- <div class="col-lg-4 col-sm-12 col-md-4">
                    <div class="info-box mb-3">
                        <span class="info-box-icon bg-primary elevation-1"><i class="fas fa-chalkboard"></i></span>

                        <div class="info-box-content">
                        <span class="info-box-text">Formations</span>
                        <span class="info-box-number">{{ $formation }}</span>
                        </div>
                        <div class="float-right">
                            <a href="/add-form" class="btn btn-primary btn-sm"><i class="fas fa-plus"></i></a>
                            <a href="/formation" class="btn btn-primary btn-sm"><i class="fas fa-th-list"></i></a>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                </div> --}}
            <!-- /.col -->


        </div>
    </div><!-- /.container-fluid -->

  @endif

    {{-- --------------------------------------------------------------------------------- --}}

    @if (Auth::user()->type_user != "comptable")
    <div class="content-header">
      <h1 class="m-0 text-dark">Formulaires plan formation</h1>
    </div>
    @else
    <div class="content-header">
      <h1 class="m-0 text-dark">Factures plan formation</h1>
    </div>
    @endif
    {{-- ------ --}}
    <div class="container-fluid">
        <div class="row">

        

        <div class="{{(Auth::user()->type_user != "comptable") ? 'col-lg-4 col-sm-12 col-md-4' : 'col-12'}}">
          <div class="info-box mb-3 bg-light">
            <span class="info-box-icon"><i class="fas fa-print"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Formulaires 1</span>
              <span class="info-box-number"><a href="/client">Imprimer</a></span>
            </div>
            <!-- /.info-box-content -->
          </div>
        </div>

        <div class="col-lg-4 col-sm-12 col-md-4">
          <div class="info-box mb-3 bg-light">
            <span class="info-box-icon"><i class="fas fa-print"></i></span>
            <div class="info-box-content">
              <span class="info-box-text">Formulaires 2</span>
              <span class="info-box-number"><a href="/print-f2">Imprimer</a></span>
            </div>
            <!-- /.info-box-content -->
          </div>
        </div>

          <div class="col-lg-4 col-sm-12 col-md-4">
            <div class="info-box mb-3 bg-light">
              <span class="info-box-icon"><i class="fas fa-print"></i></span>
              <div class="info-box-content">
                <span class="info-box-text">Formulaires 3</span>
                <span class="info-box-number"><a href="/cabinet">Imprimer</a></span>
              </div>
              <!-- /.info-box-content -->
            </div>
          </div>


          <div class="col-lg-4 col-sm-12 col-md-4">
            <div class="info-box mb-3 bg-light">
              <span class="info-box-icon"><i class="fas fa-print"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Formulaires 4</span>
                <span class="info-box-number"><a href="/print-f4">Imprimer</a></span>
              </div>
              <!-- /.info-box-content -->
            </div>
          </div>

          <div class="col-lg-4 col-sm-12 col-md-4">
            <div class="info-box mb-3 bg-light">
              <span class="info-box-icon"><i class="fas fa-print"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Modèles 1</span>
                <span class="info-box-number"><a href="/print-m1">Imprimer</a></span>
              </div>
              <!-- /.info-box-content -->
            </div>
          </div>
          @if (Auth::user()->type_user == "admin" || Auth::user()->type_user == "user")
          <div class="col-lg-4 col-sm-12 col-md-4">
            <div class="info-box mb-3 bg-light">
              <span class="info-box-icon"><i class="fas fa-print"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Modèles 3</span>
                <div class="d-flex">
                <span class="info-box-number"><a href="/print-m3">Imprimer</a></span>
                <span class="mx-2">
                -
                </span>
                <span class="info-box-number"><a href="/avis-modif"> Modifier</a></span>
                </div>
              </div>
              <!-- /.info-box-content -->
            </div>
            @endif
          </div>
          

          <div class="col-lg-4 col-sm-12 col-md-4">
            <div class="info-box mb-3 bg-light">
              <span class="info-box-icon"><i class="fas fa-print"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Modèles 4 (Factures)</span>
                <span class="info-box-number"><a href="/formation">Imprimer</a></span>
              </div>
              <!-- /.info-box-content -->
            </div>
          </div>

          @if (Auth::user()->type_user == "admin" || Auth::user()->type_user == "user")
          <div class="col-lg-4 col-sm-12 col-md-4">
            <div class="info-box mb-3 bg-light">
              <span class="info-box-icon"><i class="fas fa-print"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Modèles 5</span>
                <span class="info-box-number"><a href="/print-m5">Imprimer</a></span>

              </div>
              <!-- /.info-box-content -->
            </div>
          </div>

          <div class="col-lg-4 col-sm-12 col-md-4">
            <div class="info-box mb-3 bg-light">
              <span class="info-box-icon"><i class="fas fa-print"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Modèles 6</span>
                <span class="info-box-number"><a href="/print-m6">Imprimer</a></span>
              </div>
              <!-- /.info-box-content -->
            </div>
          </div>

          <div class="col-lg-4 col-sm-12 col-md-4">
            <div class="info-box mb-3 bg-light">
              <span class="info-box-icon"><i class="fas fa-print"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Fiche d'éval. synthètique</span>
                <span class="info-box-number"><a href="/print-fiche-evaluation">Imprimer</a></span>
              </div>
              <!-- /.info-box-content -->
            </div>
          </div>

          <div class="col-lg-4 col-sm-12 col-md-4">
            <div class="info-box mb-3 bg-light">
              <span class="info-box-icon"><i class="fas fa-print"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Plan de formation</span>
                <span class="info-box-number"><a href="/print-pf">Imprimer</a></span>
              </div>
              <!-- /.info-box-content -->
            </div>
          </div>

          <div class="col-lg-4 col-sm-12 col-md-4">
            <div class="info-box mb-3 bg-light">
              <span class="info-box-icon"><i class="fas fa-print"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Avis d'affichage</span>
                <span class="info-box-number"><a href="/print-avis-aff">Imprimer</a></span>
              </div>
              <!-- /.info-box-content -->
            </div>
          </div>

          <div class="col-lg-4 col-sm-12 col-md-4">
            <div class="info-box mb-3 bg-light">
              <span class="info-box-icon"><i class="fas fa-print"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Attes. référence plan formation</span>
                <span class="info-box-number"><a href="/print-att-reference-plan">Imprimer</a></span>
              </div>
              <!-- /.info-box-content -->
            </div>
          </div>

          @endif


        </div>
    </div><!-- /.container-fluid -->
    @if (Auth::user()->type_user == "admin" || Auth::user()->type_user == "user")
    <div class="content-header">
      <h1 class="m-0 text-dark">Documents GIAC</h1>
    </div>
    {{-- ------ --}}
    <div class="container-fluid">
      <div class="row">

        <div class="col-lg-4 col-sm-12 col-md-4">
          <div class="info-box mb-3 bg-light">
            <span class="info-box-icon"><i class="fas fa-print"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Factures Proforma</span>
              <span class="info-box-number"><a href="/df">Imprimer</a></span>
            </div>
            <!-- /.info-box-content -->
          </div>
        </div>

        <div class="col-lg-4 col-sm-12 col-md-4">
          <div class="info-box mb-3 bg-light">
            <span class="info-box-icon"><i class="fas fa-print"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Factures G10</span>
              <span class="info-box-number"><a href="/drb-gc">Imprimer</a></span>
            </div>
            <!-- /.info-box-content -->
          </div>
        </div>

        <div class="col-lg-4 col-sm-12 col-md-4">
          <div class="info-box mb-3 bg-light">
            <span class="info-box-icon"><i class="fas fa-print"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Attes. référence cabinet</span>
              <span class="info-box-number"><a href="/print-att-reference-df-cab">Imprimer</a></span>
            </div>
            <!-- /.info-box-content -->
          </div>
        </div>

        <div class="col-lg-4 col-sm-12 col-md-4">
          <div class="info-box mb-3 bg-light">
            <span class="info-box-icon"><i class="fas fa-print"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Attes. référence intervenant</span>
              <span class="info-box-number"><a href="/print-att-reference-df-inv">Imprimer</a></span>
            </div>
            <!-- /.info-box-content -->
          </div>
        </div>
        <div class="col-lg-4 col-sm-12 col-md-4">
          <div class="info-box mb-3 bg-light">
            <span class="info-box-icon"><i class="fas fa-print"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">G6</span>
              <span class="info-box-number"><a href="/print-g6">Imprimer</a></span>
            </div>
            <!-- /.info-box-content -->
          </div>
        </div>

      </div>
    </div>
    @endif
    {{-- --------------------------------------------------------------------------------- --}}

  @if (Auth::user()->type_user == "admin" || Auth::user()->type_user == "user")
    <div class="content-header">
      <div class="row mb-2">
          <div class="col-sm-6">
              <h1 class="m-0 text-dark">Statistiques</h1>
          </div><!-- /.col -->
      </div><!-- /.row -->
    </div>

    <div class="container-fluid">
        <div class="row">  <!-- ./col -->
            <div class="col-lg-6 col">
                <div class="card text-white bg-light">
                    <div class="card-body">
                        {!! $chart1->container() !!}
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col">
                <div class="card text-white bg-light">
                    <div class="card-body">
                    {!! $chart2->container() !!}
                    </div>
            </div>
            </div>
        </div>
    </div><!-- /.container-fluid -->

    {{-- <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-12">
            <div class="card card-info">
                <div class="card-header">
                <h3 class="card-title">Line Chart</h3>

                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                    </button>
                    <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i></button>
                </div>
                </div>
                <div class="card-body">
                <div class="chart"><div class="chartjs-size-monitor"><div class="chartjs-size-monitor-expand"><div class=""></div></div><div class="chartjs-size-monitor-shrink"><div class=""></div></div></div>
                    <canvas id="lineChart" style="height: 250px; min-height: 250px; display: block; width: 321px;" width="642" height="500" class="chartjs-render-monitor"></canvas>
                </div>
                </div>
                <!-- /.card-body -->
            </div>
        </div>
      </div>
    </div> --}}







  {!! $chart1->script() !!}
  {!! $chart2->script() !!}
  @endif

@endsection
