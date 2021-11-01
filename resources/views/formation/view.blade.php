@extends('layouts.admin')

@section('content')

@section('content-wrapper')
<div class="col-sm-6">
    <h1 class="m-0 text-dark">Formations</h1>
  </div><!-- /.col -->
  <div class="col-sm-6">
    <ol class="breadcrumb float-sm-right">
      <li class="breadcrumb-item"><a href="/formation">Formation</a></li>
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
    <a class="btn bu-icon bu-sm btn-sm" href="/add-form"><i class="fa fa-plus"></i></a>
    <div class="d-flex h-100">  <h3 class="card-title">Formations</h3>
    <div class="container h-100">
      <form action="/search-form" method="GET">
        <div class="searchbar bu-sm">
          <input class="search_input" type="search" name="search_input" placeholder="Réference plan..">
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
          <th>Réf. PF</th>
          <th>N. Action</th>
          <th class="th-last">Thème</th>
          <th>Groupe</th>
          <th>Nb. bénificiaires</th>
          <th>Commentaire</th>
          <th class="action">Action</th>
        </tr>
      </thead>

      @php
        $data = App\Plan::select('themes.nom_theme', 'plan_formations.*' , 'plans.refpdf' , 'formations.*')
        ->join('plan_formations','plan_formations.id_plan' , 'plans.id_plan' )
        ->join('themes', 'plan_formations.id_thm', 'themes.id_theme')
        ->join('formations', 'plan_formations.n_form', 'formations.n_form')
        ->get();
      @endphp
      <tbody>
        @foreach ($data as $fm)
          <tr>
            <td class="text-bold">{{ $fm['refpdf'] }}</td>
            <td class="">{{ $fm['n_action'] }}</td>
            <td class="">{{ $fm['nom_theme'] }}</td>
            <td class="">{{ $fm->groupe }}</td>
            <td class="">{{ $fm->nb_benif }}</td>
            <td class="th-last d-inline-block text-truncate">{{ $fm->commentaire }}</td>
            <td class="action py-0 align-middle">
              <div class="btn-group btn-group-sm">
                @if (Auth::user()->type_user != "comptable")
                <a href="/detail-form/{{ $fm->id_form }}" class="btn btn-primary"><i class="fas fa-eye"></i></a>
                <a href="/edit-form/{{ $fm->id_form }}" class="btn btn-warning"><i class="fas fa-edit"></i></a>
                <a href="#" class="btn btn-danger" onclick="confirmDelete({{$fm->id_form}}, 'form/')"><i class="fas fa-trash-alt"></i></a>
                @endif
  
                <a id="buPrintM4" href="/print-m4/{{ $fm->id_form }}" class="btn btn-info"><i class="fa fa-print"></i></a>
              </div>
            </td>
          </tr>
        @endforeach
      </tbody>

    </table>

  </div><!-- ./card-body -->

  <div class="card-footer text-center">
      @if (!count($formation))
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
