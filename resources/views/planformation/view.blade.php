@extends('layouts.admin')

@section('content')


@section('content-wrapper')
<div class="col-sm-6">
    <h1 class="m-0 text-dark">Actions plan formation</h1>
  </div><!-- /.col -->
  <div class="col-sm-6">
    <ol class="breadcrumb float-sm-right">
      <li class="breadcrumb-item"><a href="/PlanFormation">Actions plan formation</a></li>
      <li class="breadcrumb-item active">Liste</li>
    </ol>
  </div><!-- /.col -->
@endsection

{{-- jquery scripts --}}
<script src={{ asset('js/jquery.js') }}></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
{{-- jquery scripts --}}

<!-- CARD -->
<div class="card card-dark">
  <!-- card-header -->
  <div class="card-header">
    <a class="btn bu-icon bu-sm btn-sm" href="/add-pf"><i class="fa fa-plus"></i></a>

    <div class="d-flex h-100">
      <h3 class="card-title">Actions&nbsp;de&nbsp;formation</h3>
      <div class="container h-100">
        <form action="/searchplan" method="GET">
          <div class="searchbar bu-sm">
            <input class="search_input" type="text" name="search_input" placeholder="Réf. Plan/Intervenant/Thème" autocomplete="off">
            <button type="submit"  class="search_icon btn"><i class="fas fa-search"></i></button>
          </div>
        </form>
      </div>
    </div>
  </div>

  <!-- /.card-header -->
  <div class="card-body table-striped p-0">
    <table class="table table-md">
      <thead class="thead">
        <tr>
          <th>État</th>
          {{-- <th>N</th> --}}
          <th>Réf. plan<span>&nbsp;&nbsp;<i class="fas fa-tag"></i></span></th>
          <th>N° action</th>
          <th>Intervenant<span>&nbsp;&nbsp;<i class="fas fa-tag"></i></span></th>
          <th>Module</th>
          <th width="230px">Commentaire</th>
          <th class="action">Action</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($plan as $pf)
        <tr>
          @php
            $id_plan = \App\PlanFormation::where('id_plan', $pf->id_plan)->first();
          @endphp

          @php $nom_interv = \App\Intervenant::select('intervenants.nom', 'intervenants.prenom')
              ->join('plan_formations', 'plan_formations.id_inv', 'intervenants.id_interv')
              ->where('plan_formations.n_form', $pf->n_form)
              ->first();
          @endphp

          @php $nom_theme = \App\PlanFormation::select('themes.nom_theme')
              ->join('themes', 'plan_formations.id_thm', 'themes.id_theme')
              ->where('plan_formations.n_form', $pf->n_form)
              ->first();
          @endphp

          @php $refpdf = \App\PlanFormation::select('plans.refpdf')
              ->join('plans', 'plan_formations.id_plan', 'plans.id_plan')
              ->where('plan_formations.n_form', $pf->n_form)
              ->first();
          @endphp

          <td class="{{ ($pf->etat == "réalisé") ? 'font-weight-bold badge-success' : ($pf->etat == "planifié" ? 'font-weight-bold badge-warning' : ($pf->etat == "modifié"  ? 'font-weight-bold badge-primary' : 'font-weight-bold badge-danger')) }}">{{ ucfirst($pf->etat) }}</td>
          {{-- <td>{{ $pf["n_form"] }}</td> --}}
          <td>{{ $refpdf["refpdf"] }}</td>
          <td>{{ $pf->n_action }}</td>
          <td>{{ $nom_interv['nom']}} {{$nom_interv['prenom'] }}</td>
          <td>{{ $nom_theme['nom_theme'] }}</td>
          <td class="th-last">{{ $pf->commentaire ? substr($pf->commentaire, 0, 50).'...' : "--" }}</td>

          {{-- <td class="action">
            <a class="btn btn-sm bu-icon" href="/detail-pf/{{ $pf->n_form }}"><i class="fa fa-eye"></i></a>
            <a class="btn btn-sm bu-icon" href="/edit-pf/{{ $pf->n_form }}"><i class="fa fa-edit"></i></a>
            <a class="btn btn-sm bu-icon" a="/del-pf/{{ $pf->n_form }}" onclick="confirmDelete({{$pf->n_form}}, 'pf/')"><i class="fa fa-trash-alt"></i></a>

            <a class="btn btn-sm bu-icon" id="buPrintM1" href="/print-m1/{{ $nrc }}"><i class="fa fa-print"></i></a>
          </td> --}}
          <td class="action py-0 align-middle">
            <div class="btn-group btn-group-sm">
            <a href="/detail-action-formation/{{ $pf->n_form }}" class="btn btn-secondary"><i class="fas fa-list-alt"></i></a>
            <a href="/detail-pf/{{ $pf->n_form }}" class="btn btn-primary"><i class="fas fa-eye"></i></a>
            <a href="/edit-pf/{{ $pf->n_form }}" class="btn btn-warning"><i class="fas fa-edit"></i></a>
            <a href="#" class="btn btn-danger" onclick="confirmDelete({{$pf->n_form}}, 'pf/', {{$id_plan->id_plan}})"><i class="fas fa-trash-alt"></i></a>
            </div>
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div><!-- ./card-body -->

  <div class="card-footer text-center">
    @if (!count($plan))
      <tr>
        <td>
          <h3 class="text-secondary">Aucun résultat</h3>
        </td>
      </tr>
    @endif
  </div>
</div><!-- ./CARD -->



{{-- TOASTR NOTIFICATIONS --}}
@if (Session::has('added'))
<script>
  $(document).ready(function() {
    toastr.options.preventDuplicates = true;
    toastr.options.closeButton = true;
    toastr.options.showEasing = 'swing';
    toastr.options.hideEasing = 'linear';
    toastr.options.closeEasing = 'linear';
    toastr.success("{{ Session::get("added") }}");
  });
</script>
@endif
@if (Session::has('updated'))
<script>
  $(document).ready(function() {
    toastr.options.preventDuplicates = true;
    toastr.options.closeButton = true;
    toastr.options.showEasing = 'swing';
    toastr.options.hideEasing = 'linear';
    toastr.options.closeEasing = 'linear';
    toastr.success("{{ Session::get("updated") }}");
  });
</script>
@endif
@if (Session::has('deleted'))
<script>
  $(document).ready(function() {
    toastr.options.preventDuplicates = true;
    toastr.options.closeButton = true;
    toastr.options.showEasing = 'swing';
    toastr.options.hideEasing = 'linear';
    toastr.options.closeEasing = 'linear';
    toastr.success("{{ Session::get("deleted") }}");
  });
</script>
@endif
@if (Session::has('success'))
<script>
  $(document).ready(function() {
    toastr.options.preventDuplicates = true;
    toastr.options.closeButton = true;
    toastr.options.showEasing = 'swing';
    toastr.options.hideEasing = 'linear';
    toastr.options.closeEasing = 'linear';
    toastr.success("{{ Session::get("success") }}");
  });
</script>
@endif
@if (Session::has('warning'))
<script>
  $(document).ready(function() {
    toastr.options.preventDuplicates = true;
    toastr.options.closeButton = true;
    toastr.options.showEasing = 'swing';
    toastr.options.hideEasing = 'linear';
    toastr.options.closeEasing = 'linear';
    toastr.warning("{{ Session::get("warning") }}");
  });
</script>
@endif
@if (Session::has('info'))
<script>
  $(document).ready(function() {
    toastr.options.preventDuplicates = true;
    toastr.options.closeButton = true;
    toastr.options.showEasing = 'swing';
    toastr.options.hideEasing = 'linear';
    toastr.options.closeEasing = 'linear';
    toastr.info("{{ Session::get("info") }}");
  });
</script>
@endif
@if (Session::has('error'))
<script>
  $(document).ready(function() {
    toastr.options.preventDuplicates = true;
    toastr.options.closeButton = true;
    toastr.options.showEasing = 'swing';
    toastr.options.hideEasing = 'linear';
    toastr.options.closeEasing = 'linear';
    toastr.error("{{ Session::get("error") }}");
  });
</script>
@endif
{{-- TOASTR NOTIFICATIONS --}}



@endsection
