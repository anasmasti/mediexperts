@extends('layouts.admin')

@section('content')

@section('content-wrapper')
<div class="col-sm-6">
    <h1 class="m-0 text-dark">Demande remboursement OFPPT</h1>
  </div><!-- /.col -->
  <div class="col-sm-6">
    <ol class="breadcrumb float-sm-right">
      <li class="breadcrumb-item"><a href="/drb-of">D.R OFPPT</a></li>
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
    <a class="btn bu-icon bu-sm btn-sm" href="/add-drb-of"><i class="fa fa-plus"></i></a>
    <div class="d-flex h-100">
      <h3 class="card-title">Demandes&nbsp;remboursement&nbsp;OFPPT</h3>
      <div class="container h-100 ">
        <form action="/searchofppt" method="GET">
          <div class="searchbar bu-sm">
            <input class="search_input" type="text" name="searchofppt" placeholder="Rechercher par N°..">
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
          <th>N° demande remboursement</th>
          <th>Entreprise&nbsp;&nbsp;<i class="fas fa-tag"></i></label></th>
          <th>Montant remboursement</th>
          <th>Commentaire</th>
          <th class="action">Action</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($drb as $dr)
        <tr>
          @foreach($client as $cl)
            @if($cl->nrc_entrp==$dr->nrc_e)
              <?php $nrc = $cl->nrc_entrp ?>
              <?php $name = $cl->raisoci ?>
            @endif
          @endforeach

          <td>{{ $dr->n_drb }}</td>
          <td>{{$name}} ({{ $dr->nrc_e }})</td>
          <td>{{ $dr->montant_rb }}</td>
          <td class="th-last d-inline-block text-truncate">{{ $dr->commentaire }}</td>

          <td class="action">
            <a class="btn btn-sm bu-iconcon" href="/detail-drb-of/{{ $dr->n_drb }}"><i class="fa fa-eye"></i></a>
            <a class="btn btn-sm bu-iconcon" href="/edit-drb-of/{{ $dr->n_drb }}"><i class="fa fa-edit"></i></a>
            <a class="btn btn-sm bu-iconcon" a="/del-drb-of/{{ $dr->n_drb }}" onclick="confirmDelete({{$dr->n_drb}}, 'drb-of/')"><i class="fa fa-trash-alt"></i></a>
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div><!-- ./card-body -->

  <div class="card-footer">
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
