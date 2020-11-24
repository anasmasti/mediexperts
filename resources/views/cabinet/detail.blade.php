@extends('layouts.admin')


@section('content')

@section('content-wrapper')
<div class="col-sm-6">
        <h1 class="m-0 text-dark">Détails</h1>
    </div><!-- /.col -->
    <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="/cabinet">Cabinet</a></li>
            <li class="breadcrumb-item active">{{ $cabinet->raisoci }}</li>
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
    <div class="card-header" >
        <a class="btn btn-dark btn-sm bu-lg-ic" href="/cabinet"><i class="fa fa-arrow-left fa-1x"></i></a>
        <h3 class="card-title card-h3">{{ $cabinet->raisoci }}</h3>
        <a class="btn btn-sm bua bu-ic" a="/del-cab/{{ $cabinet->nrc_cab }}" onclick="confirmDelete({{$cabinet->nrc_cab}}, 'cab/')"><i class="fa fa-trash-alt"></i></a>
        <a class="btn btn-sm buaj bu-ic" href="/edit-cab/{{ $cabinet->nrc_cab }}"><i class="fa fa-edit"></i></a>
    </div>
    <!-- /.card-header -->
    <div class="card-body table-striped p-0">
        <table class="table table-md">
            <thead class="thead">
            </thead>
            <tbody>
                    <tr><th class="th-det">N° RC Cabinet</th>
                        <td>{{ $cabinet->nrc_cab }}</td></tr>
                    <tr><th class="th-det">Raison social</th>
                        <td>{{ $cabinet->raisoci }}</td></tr>
                    <tr><th class="th-det">Forme juridique</th>
                        <td>{{ $cabinet->formjury }}</td></tr>
                    <tr><th class="th-det">Date création</th>
                        <td>{{ $cabinet->dt_creat }}</td></tr>
                    <tr><th class="th-det">Domaine compétence 1</th>
                        <td>{{ $cabinet->dom_compet1 }}</td></tr>
                    <tr><th class="th-det">Domaine compétence 2</th>
                        <td>{{ $cabinet->dom_compet2 }}</td></tr>
                    <tr><th class="th-det">Domaine compétence 3</th>
                        <td>{{ $cabinet->dom_compet3 }}</td></tr>
                    <tr><th class="th-det">Matériel 1</th>
                        <td>{{ $cabinet->materiel1 }}</td></tr>
                    <tr><th class="th-det">Matériel 2</th>
                        <td>{{ $cabinet->materiel2 }}</td></tr>
                    <tr><th class="th-det">Matériel 3</th>
                        <td>{{ $cabinet->materiel3 }}</td></tr>
                    <tr><th class="th-det">Id. fiscal</th>
                        <td>{{ $cabinet->id_fiscal }}</td></tr>
                    <tr><th class="th-det">N° CNSS</th>
                        <td>{{ $cabinet->ncnss }}</td></tr>
                    <tr><th class="th-det">N° patente</th>
                        <td>{{ $cabinet->npatente }}</td></tr>
                    <tr><th class="th-det">Effectif</th>
                        <td>{{ $cabinet->effectif }}</td></tr>
                    <tr><th class="th-det">Nb. permanent</th>
                        <td>{{ $cabinet->nb_permanent }}</td></tr>
                    <tr><th class="th-det">Nb. vacataires</th>
                        <td>{{ $cabinet->nb_vacataire }}</td></tr>
                    <tr><th class="th-det">Nb. formateurs</th>
                        <td>{{ $cabinet->nb_formateur }}</td></tr>
                    <tr><th class="th-det">Effectif étrangers</th>
                        <td>{{ $cabinet->effectif_etr }}</td></tr>
                    <tr><th class="th-det">Permanent étrangers</th>
                        <td>{{ $cabinet->nb_permanent_etr }}</td></tr>
                    <tr><th class="th-det">Vacataires étrangers</th>
                        <td>{{ $cabinet->nb_vacataire_etr }}</td></tr>
                    <tr><th class="th-det">Formateurs étrangers</th>
                        <td>{{ $cabinet->nb_formateur_etr }}</td></tr>
                    <tr><th class="th-det">L'organisme appartient à un groupe étranger</th>
                        <td>{{ $cabinet->org_etranger }}</td></tr>
                    <tr><th class="th-det">Nom gérant 1</th>
                        <td>{{ $cabinet->nom_gr1 }}</td></tr>
                    <tr><th class="th-det">Prénom gérant 1</th>
                        <td>{{ $cabinet->pren_gr1 }}</td></tr>
                    <tr><th class="th-det">Nom gérant 2</th>
                        <td>{{ $cabinet->nom_gr2 }}</td></tr>
                    <tr><th class="th-det">Prénom gérant 2</th>
                        <td>{{ $cabinet->pren_gr2 }}</td></tr>
                    <tr><th class="th-det">Adresse</th>
                        <td>{{ $cabinet->adress }}</td></tr>
                    <tr><th class="th-det">Téléphone</th>
                        <td>{{ $cabinet->tele }}</td></tr>
                    <tr><th class="th-det">Fax</th>
                        <td>{{ $cabinet->fax }}</td></tr>
                    <tr><th class="th-det">E-Mail</th>
                        <td><a href="mailto:{{ $cabinet->email }}">{{ $cabinet->email }}</a></td></tr>
                    <tr><th class="th-det">Site-Web</th>
                        <td><a href="{{ $cabinet->website }}" target="_blank">{{ $cabinet->website }}</a></td></tr>
                    <tr><th class="th-det">Date der. modif.</th>
                        <td>{{ $cabinet->updated_at }}</td></tr>
                    <tr><th class="th-det">Commentaire</th>
                        <td>{{ $cabinet->commentaire }}</td></tr>
            </tbody>
        </table>
    </div><!-- ./card-body -->

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
