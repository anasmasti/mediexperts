@extends('layouts.admin')

@section('content')

@section('content-wrapper')
<div class="col-sm-6">
    <h1 class="m-0 text-dark">Demande financement</h1>
  </div><!--/.col-->
  <div class="col-sm-6">
    <ol class="breadcrumb float-sm-right">
      <li class="breadcrumb-item"><a href="/df">Demande financement</a></li>
      <li class="breadcrumb-item active">Liste</li>
    </ol>
  </div><!--/.col-->
@endsection

{{-- jquery scripts --}}
<script src={{ asset('js/jquery.js') }}></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
{{-- jquery scripts --}}

<!-- CARD -->
<div class="card card-dark">
  <!--card-header-->
  <div class="card-header">
  <a class="btn bu-icon bu-sm btn-sm" href="/add-df"><i class="fa fa-plus"></i></a>
  <div class="d-flex h-100"> <h3 class="card-title">Demande&nbsp;financement</h3>
    <div class="container">
      <form action="/searchdf" method="GET">
        <div class="searchbar bu-sm">
          <input class="search_input" type="text" name="searchdf" placeholder="Rechercher par Année">
          <button type="submit"  class="search_icon btn"><i class="fas fa-search"></i></button>
        </div>
      </form>
    </div>
  </div>
</div>

  <!--card-body-->
  <div class="card-body table-striped p-0">
    <table class="table table-md">
      <thead class="thead">
        <tr>
          <th>ÉTAT</th>
          <th>Type mission</th>
          <th>Entreprise&nbsp;&nbsp;<i class="fas fa-tag"></i></th>
          <th>Année</th>
          <th>Commentaire</th>
          <th class="action">Action</th>
        </tr>
      </thead>

      <tbody>
        @foreach ($df as $d)
        <tr>
            @foreach($client as $cl)
              @if($cl->nrc_entrp==$d->nrc_e)
                <?php $nrc = $cl->nrc_entrp ?>
                <?php $name = $cl->raisoci ?>
              @endif
            @endforeach
            <?php $A = false; $B = false; ?>
            @foreach($drb as $dr)
              @if($d->n_df==$dr->n_df)
                <?php $A = true; ?>
              @endif
            @endforeach

            @foreach($misinv as $mis  )
              @if($d->n_df==$mis->n_df)
                <?php $B = true; ?>
              @endif
            @endforeach

          @php
            $entrp = \App\Client::select('clients.nrc_entrp', 'clients.raisoci')
              ->join('demande_financements', 'clients.nrc_entrp', 'demande_financements.nrc_e')
              ->where('clients.nrc_entrp', $d->nrc_e)
              ->first();
          @endphp

          <td class="progress-bar progress-bar-striped {{ mb_strtolower($d->etat=='approuvé') ? 'bg-light' : (mb_strtolower($d->etat=='annulé') ? 'bg-danger' : 'bg-warning progress-bar-animated') }}">
            @if (mb_strtolower($d->etat) == "annulé")
              <i class="fa fa-times"></i>
            @elseif (mb_strtolower($d->etat) == "initié")
              <i class="fa fa-battery-quarter"></i>
            @elseif (mb_strtolower($d->etat) == "instruction dossier")
              <i class="fa fa-hourglass-half"></i>
            @elseif (mb_strtolower($d->etat) == "déposé")
              <i class="fa fa-folder-open"></i>
            @elseif (mb_strtolower($d->etat) == "accordé")
              <i class="fa fa-signature"></i>
            @elseif (mb_strtolower($d->etat) == "réalisé")
              <i class="fa fa-check-square"></i>
            @elseif (mb_strtolower($d->etat) == "approuvé")
              <i class="fa fa-check-circle"></i>
            @endif
            <strong>{{ ucfirst($d->etat) }}</strong>
          </td>
          {{-- <td class="td-1">{{ $d->n_df }}</td> --}}
          <td class="td-2">{{ ucfirst($d->type_miss) }}</td>
          <td class="td-1">{{$name}}</td>
          <td>{{ $d->annee_exerc }}</td>
          <td class="th-last">{{ $d->commentaire ? substr($d->commentaire, 0, 40)."..." : "--" }}</td>

          <td class="action py-0 align-middle">
            <div class="btn-group btn-group-sm">
            <a class="btn btn-secondary" href="/drb-df-gc/{{ $d->n_df }}"><i class="fa fa-list"></i></a>
            <a class="btn btn-primary" href="/detail-df/{{ $d->n_df }}"><i class="fa fa-eye"></i></a>
            <a class="btn btn-warning" href="/edit-df/{{ $d->n_df }}"><i class="fa fa-edit"></i></a>
            {{-- check child data --}}

          @if ($A==true | $B==true)
            <a href="#" class="btn btn-danger" onclick="IsChild()"><i class="fa fa-trash-alt"></i></a>
          @elseif ($A==false | $B==false)
            <a href="#" class="btn btn-danger" a="/del-df/{{ $d->n_df }}" onclick="confirmDelete({{$d->n_df}}, 'df/')"><i class="fa fa-trash-alt"></i></a>
          @endif

          <a class="btn btn-dark" href="/print-facture-df/{{ $d->n_df }}">
            <i class="fa fa-print"></i>
            <abbr></abbr>
          </a>

          </td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div><!--/.card-body-->

  <div class="card-footer">
  </div>

</div>
<!-- CARD -->



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
