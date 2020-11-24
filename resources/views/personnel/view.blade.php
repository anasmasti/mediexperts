@extends('layouts.admin')

@section('content')


@section('content-wrapper')
<div class="col-sm-6">
    <h1 class="m-0 text-dark">Personnels</h1>
  </div><!--/.col-->
  <div class="col-sm-6">
    <ol class="breadcrumb float-sm-right">
      <li class="breadcrumb-item"><a href="/personnel">Personnel</a></li>
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
    <a class="btn bu5 bu-sm btn-sm" href="/import"><i class="fa fa-upload"></i></a>
    <a class="btn bu5 bu-sm btn-sm" href="/add-pers"><i class="fa fa-plus"></i></a>
    <div class="d-flex h-100">
      <h3 class="card-title">Personnels</h3>
      <div class="container h-100">
      <form action="/personnel/search" method="GET">
        <div class="searchbar">
          <button type="submit" class="search_icon btn"><i class="fas fa-search"></i></button>
          <input class="search_input" type="text" name="search" placeholder="CIN, matricule, nom ou prénom ...">
        </div>
      </form>
      </div>
    </div>
  </div>

<form method="POST" id="formMultipleDelete">
@csrf
@method('delete')
  <!--card-body-->
  <div class="card-body table-striped p-0">
    <table class="table table-md">
      <thead class="thead">
        <tr>
          @if (count($personnel))
          <th>
            <input type="checkbox" name="selectAll" id="selectAll" />
          </th>
          @endif
          <th>CIN</th>
          <th>Matricule</th>
          <th>Nom et prénom</th>
          <th>Entreprise<i class="fa fa-tag icon"></i></th>
          <th>État</th>
          <th class="text-center">Action</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($personnel as $pers)
        <tr>
          <td>
              <input class="checked_from_all_btn" type="checkbox" name="cin[]" id="{{(string)$pers->cin}}" value="{{$pers->cin}}" />
          </td>
          <td>{{ $pers->cin }}</td>
          <td>{{ $pers->matricule }}</td>
          <td>{{ $pers->nom }} {{ $pers->prenom }}</td>
          <td>
            @php $entrp = App\Personnel::select('clients.nrc_entrp', 'clients.raisoci')
              ->join('clients', 'personnels.nrc_e', 'clients.nrc_entrp')
              ->where('personnels.cin', $pers->cin)
              ->first();
            @endphp
            <a href="/detail-cl/{{$entrp['nrc_entrp']}}">{{ $entrp['raisoci'] }}</a>
          </td>
          <td>{{ ucfirst($pers->etat) }}</td>

          <td class="action py-0 align-middle">
            <div class="btn-group btn-group-sm">
              <a href="/detail-pers/{{ $pers->cin }}" class="btn btn-primary"><i class="fa fa-eye"></i></a>
              <a href="/edit-pers/{{ $pers->cin }}" class="btn btn-warning"><i class="fa fa-edit"></i></a>
              <a href="#" class="btn btn-danger" onclick="confirmDelete({{$pers->cin}}, 'pers/')"><i class="fa fa-trash-alt"></i></a>
            </div>
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div><!--/.card-body-->

</form>

  <div class="card-footer d-flex justify-content-center">
    
    @if (!count($personnel))
      <tr>
          <td>
              <h3 class="text-secondary">Aucun résultat</h3>
          </td>
      </tr>
    @else
      <button type="submit" class="btn btn-danger d-flex justify-content-center" id="delMultiple_Btn" onclick="confirmMultipleDelete('pers')" disabled>
        <i class="material-icons pr-2">delete_sweep</i>
        <strong> Supprimer</strong>
      </button>
    @endif
  </div>

  

</div>
<!-- CARD -->

<script>
    $(document).ready(function () {
      // sélectionner tous les checkboxes
      $('input[name="selectAll"]').on('click', function () {
        $('.checked_from_all_btn').prop('checked', this.checked);
        $('#delMultiple_Btn').prop('disabled', !this.checked);
      });

      // disable/enable button de Suppression multiple si un ou multiple checkboxes sont marqués
      $('input[name="cin[]"]').on('click', function () {
        let checkboxes = document.querySelectorAll('input[name="cin[]"]');
        let counter = 0;
        checkboxes.forEach(elem => {
            elem.checked && counter++;
            // console.log("counter checked " + counter);
        });
        $('#delMultiple_Btn').prop('disabled', (counter === 0));
      });

    });
</script>


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
