@extends('layouts.admin')

@section('content')


@section('content-wrapper')
<div class="col-sm-6">
    <h1 class="m-0 text-dark">Intervenants</h1>
  </div><!-- /.col -->
  <div class="col-sm-6">
    <ol class="breadcrumb float-sm-right">
      <li class="breadcrumb-item"><a href="/intervenant">Intervenant</a></li>
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
    <a class="btn bu-icon bu-sm btn-sm" href="/add-inv"><i class="fa fa-plus"></i></a>
    <div class="d-flex h-100">
      <h3 class="card-title">Intervenants</h3>
      <div class="container h-100">
        <form action="/searchinter" method="GET">
          <div class="searchbar">
            <input class="search_input" type="text" name="searchinter" placeholder="Rechercher par nom..">
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
          {{-- <th>ID Intervenant</th> --}}
          <th>Nom & prénom</th>
          <th>Cabinet <i class="fas fa-tag"></i></th>
          <th class="th-last">Spécificité</th>
          <th class="action">Action</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($interv as $inv)
        <tr>
          @foreach($cabinet as $cab)
            @if ($cab->nrc_cab==$inv->nrc_c)
              @php $nrc = $cab->nrc_cab @endphp
              @php $name = $cab->raisoci @endphp
            @endif
          @endforeach

          <td class="{{(mb_strtolower($inv->etat) == "occupé") ? 'font-weight-bold badge-danger' : 'font-weight-bold badge-success'}}">{{ ucfirst($inv->etat) }}</td>
          {{-- <td>{{ $inv->id_interv }}</td> --}}
          <td>{{ ucfirst($inv->nom) }} {{ ucfirst($inv->prenom) }}</td>
          <td>{{$name}}</td>
          <td class="th-last">{{ $inv->specif }}</td>


          <td class="action py-0 align-middle">
            <div class="btn-group btn-group-sm">
              <a href="/detail-inv/{{$inv->id_interv}}" class="btn btn-primary"><i class="fas fa-eye"></i></a>
              <a href="/edit-inv/{{$inv->id_interv}}" class="btn btn-warning"><i class="fas fa-edit"></i></a>

                {{-- check child data --}}
                @php $A = false; $B = false; @endphp

                @foreach($plan as $pf)
                @if($inv->id_interv==$pf->id_inv)
                    @php $A = true; @endphp
                @endif
                @endforeach

                @foreach($misinv as $mis)
                @if($inv->id_interv==$mis->id_interv)
                    @php $B = true; @endphp
                @endif
                @endforeach

                @if ($A==true | $B==true)
                <a href="#" class="btn btn-danger" onclick="IsChild()"><i class="fa fa-trash-alt"></i></a>
                @elseif ($A==false | $B==false)
                <a class="btn btn-danger" id="deleteBtn" href="#myModal" data-toggle="modal" onclick="confirmDelete({{$inv->id_interv}}, 'inv/')"><i class="fas fa-trash-alt"></i></a>
                @endif
            </div>
          </td>

          {{-- <td class="action">
            <a class="btn btn-sm bu-iconcon" href="/detail-inv/{{$inv->id_interv}}/{{$nrc}}"><i class="fa fa-eye"></i></a>
            <a class="btn btn-sm bu-iconcon" href="/edit-inv/{{$inv->id_interv}}/{{$nrc}}"><i class="fa fa-edit"></i></a>

            @php $A = false; $B = false; @endphp

            @foreach($plan as $pf)
              @if($inv->id_interv==$pf->id_inv)
                @php $A = true; @endphp
              @endif
            @endforeach

            @foreach($misinv as $mis)
              @if($inv->id_interv==$mis->id_interv)
                @php $B = true; @endphp
              @endif
            @endforeach

            @if ($A==true | $B==true)
              <a class="btn btn-sm bu-iconcon" onclick="IsChild()"><i class="fa fa-trash-alt"></i></a>
            @elseif ($A==false | $B==false)
              <a class="btn btn-sm bu-iconcon" onclick="confirmDelete({{$inv->id_interv}}, 'inv/')"><i class="fa fa-trash-alt"></i></a>
            @endif
          </td> --}}
        </tr>
        @endforeach

      </tbody>
    </table>
  </div><!-- ./card-body -->

  <div class="card-footer text-center">
      @if (!count($interv))
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
