@extends('layouts.admin')

@section('content')


@section('content-wrapper')
<div class="col-sm-6">
    <h1 class="m-0 text-dark">Demande rembourssement GIAC</h1>
  </div><!-- /.col -->
  <div class="col-sm-6">
    <ol class="breadcrumb float-sm-right">
      <li class="breadcrumb-item"><a href="/drb-gc">D.R GIAC</a></li>
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
    {{-- <a class="btn bu5 bu-sm btn-sm" href="/add-drb-gc"><i class="fa fa-plus"></i></a> --}}
    <div class="d-flex">
      <h3 class="card-title">Demandes&nbsp;remboursement&nbsp;GIAC</h3>

      <div class="container">
        <form action="/searchdrb" method="GET">
          <div class="searchbar bu-sm">
            <input class="search_input" type="text" name="searchdrb" placeholder="Rechercher par N°..">
            <button type="submit" class="search_icon btn"><i class="fas fa-search"></i></button>
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
          <th>ÉTAT</th>
          <th>Entreprise&nbsp;&nbsp;<i class="fas fa-tag"></i></th>
          <th>Type mission&nbsp;&nbsp;<i class="fas fa-tag"></i></th>
          <th>Année</th>
          <th>Commentaire</th>
          <th class="action">Action</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($drb as $dr)
        @php
          $demande = \App\DemandeFinancement::select('clients.raisoci', 'clients.nrc_entrp', 'demande_financements.*')
            ->join('clients', 'demande_financements.nrc_e', 'clients.nrc_entrp')
            ->join('demande_remboursement_giacs', 'demande_financements.n_df', 'demande_remboursement_giacs.n_df')
            ->where('demande_remboursement_giacs.n_df', $dr->n_df)
            ->first();
          $entrp = \App\Client::select('clients.nrc_entrp', 'clients.raisoci')
            ->join('demande_financements', 'clients.nrc_entrp', 'demande_financements.nrc_e')
            ->where('clients.nrc_entrp', $demande['nrc_entrp'])
            ->first();
        @endphp
        <tr>
          <td class="d-flex flex-nowrap progress-bar progress-bar-striped {{ mb_strtolower($dr->etat=='remboursé') ? 'bg-light' : 'bg-warning progress-bar-animated' }}">
            @if (mb_strtolower($dr->etat) == "initié")
            <i class="fa fa-battery-quarter"></i>
            @elseif (mb_strtolower($dr->etat) == "payé")
            <i class="fa fa-dollar-sign"></i>
            @elseif (mb_strtolower($dr->etat) == "instruction dossier")
            <i class="fa fa-hourglass-half"></i>
            @elseif (mb_strtolower($dr->etat) == "déposé")
            <i class="fa fa-folder-open"></i>
            @elseif (mb_strtolower($dr->etat) == "remboursé")
            <i class="fa fa-check-circle"></i>
            @endif
            <strong>{{ ucfirst($dr->etat) }}</strong>
          </td>
          <td>
            <a class="text-dark" href="/detail-cl/{{$demande['nrc_entrp']}}">
              {{ $demande['raisoci'] }}
            </a>
          </td>
          <td class="td-3">
            <a class="text-dark" href="/detail-df/{{$demande['n_df']}}">
              {{ ucfirst($demande['type_miss']) }}
            </a>
          </td>
          <td class="td-1">{{ $demande['annee_exerc'] }}</td>
          <td class="th-last d-inline-block text-truncate">{{ $dr->commentaire }}</td>

          <td class="action py-0 align-middle">
            <div class="btn-group btn-group-sm">
              <a class="btn btn-primary" href="/detail-drb-gc/{{ $dr->n_drb }}"><i class="fa fa-eye"></i></a>

              @if (Auth::user()->type_user != "comptable")
              <a class="btn btn-warning" href="/edit-drb-gc/{{ $dr->n_drb }}"><i class="fa fa-edit"></i></a>
              <a class="btn btn-danger" href="#" onclick="confirmDelete({{$dr->n_drb}}, 'drb-gc/')"><i class="fa fa-trash-alt"></i></a>
              @endif

              <a class="btn btn-info" href="/print-facture-drb/{{$dr->n_drb}}/{{$entrp['nrc_entrp']}}"><i class="fa fa-print"></i></a>
            </div>
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div><!-- ./card-body -->

  <div class="card-footer">
    @if (!count($drb))
      <tr>
        <td>
          <h3 class="text-secondary text-center">Aucun résultat</h3>
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
