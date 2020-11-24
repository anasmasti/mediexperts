@extends('layouts.admin')

@section('content')


@section('content-wrapper')
<div class="col-sm-6">
        <h1 class="m-0 text-dark">Détails</h1>
    </div><!-- /.col -->
    <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="/personnel">Personnel</a></li>
            <li class="breadcrumb-item active">{{ $personnel->cin }} / {{ $personnel->nom }}</li>
        </ol>
    </div><!-- /.col -->
@endsection

{{-- jquery scripts --}}
<script src={{ asset('js/jquery.js') }}></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
{{-- jquery scripts --}}

<!-- CARD -->
<div class="card card-dark">
        <!--card-header-->
        <div class="card-header">
            <a class="btn btn-dark btn-sm bu-lg-ic" href="/personnel"><i class="fa fa-arrow-left"></i></a>
            <h3 class="card-title card-h3">{{ $personnel->nom }}</h3>
            <a class="btn btn-sm bua bu-ic" onclick="confirmDelete({{$personnel->matricule}}, 'pers/')"><i class="fa fa-trash-alt"></i></a>
            <a class="btn btn-sm buaj bu-ic" href="/edit-pers/{{ $personnel->cin }}"><i class="fa fa-edit"></i></a>
        </div>

        <!--card-body-->
        <div class="card-body table-striped p-0">
            <table class="table table-md">
                <thead class="thead">
                </thead>
                <tbody>
                    <tr><th>État</th>
                        <td>{{ ucfirst($personnel->etat) }}</td></tr>
                    <tr>
                      <th>Entreprise<i class="fa fa-tag icon"></i></th>
                      <td>
                        @php $entrp = App\Personnel::select('clients.nrc_entrp', 'clients.raisoci')
                            ->join('clients', 'personnels.nrc_e', 'clients.nrc_entrp')
                            ->where('personnels.cin', $personnel->cin)
                            ->first();
                        @endphp
                        <span>Personnel de </span><a href="/detail-cl/{{$entrp['nrc_entrp']}}">{{ $entrp['raisoci'] }}</a>
                      </td>
                    </tr>
                    <tr><th>CIN Personnel</th>
                        <td>{{ $personnel->cin }}</td></tr>
                    <tr><th>Matricule</th>
                        <td>{{ $personnel->matricule }}</td></tr>
                    <tr><th>Nom</th>
                        <td>{{ $personnel->nom }}</td></tr>
                    <tr><th>Prénom</th>
                        <td>{{ $personnel->prenom }}</td></tr>
                    <tr><th>N° CNSS</th>
                        <td>{{ $personnel->cnss }}</td></tr>
                    <tr><th>Date naissance</th>
                        <td>{{ $personnel->dt_naiss }}</td></tr>
                    <tr><th>Date embauche</th>
                        <td>{{ $personnel->dt_embch }}</td></tr>
                    @if (mb_strtolower($personnel->etat) == "non disponible")
                        <tr><th>Date démission</th>
                            <td>{{ $personnel->dt_demiss }}</td></tr>
                    @endif
                    <tr><th>Fonction</th>
                        <td>{{ $personnel->fonction }}</td></tr>
                    <tr><th>CSP</th>
                        <td>{{ $personnel->csp }}</td></tr>
                </tbody>
            </table>

        </div><!--/.card-body-->
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
