@extends('layouts.admin')

@section('content')


@section('content-wrapper')
<div class="col-sm-6">
        <h1 class="m-0 text-dark">Détails</h1>
    </div><!-- /.col -->
    <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="/giac">GIAC</a></li>
            <li class="breadcrumb-item active">{{ $giac->libelle }}</li>
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
            <a class="btn btn-dark btn-sm bu-lg-ic" href="/giac"><i class="fa fa-arrow-left"></i></a>
            <h3 class="card-title card-h3">{{ $giac->libelle }}</h3>
            <a class="btn btn-sm bua bu-ic" a="/del-gc/{{ $giac->code_giac }}" onclick="confirmDelete({{$giac->code_giac}}, 'gc/')"><i class="fa fa-trash-alt"></i></a>
            <a class="btn btn-sm buaj bu-ic" href="/edit-gc/{{ $giac->code_giac }}"><i class="fa fa-edit"></i></a>
        </div>

        <!--card-body-->
        <div class="card-body table-striped p-0">
            <table class="table table-md">
                <thead class="thead">
                </thead>
                <tbody>
                    <tr><th>Code GIAC</th>
                        <td>{{ $giac->code_giac }}</td></tr>
                    <tr><th>Libellé</th>
                        <td>{{ $giac->libelle }}</td></tr>
                    <tr><th>Spécificité</th>
                        <td>{{ $giac->specif }}</td></tr>
                    <tr><th>Adresse Local 1</th>
                        <td>{{ $giac->adlocal_1 }}</td></tr>
                    <tr><th>Adresse Local 2</th>
                        <td>{{ $giac->adlocal_2 }}</td></tr>
                    <tr><th>Tél.</th>
                        <td>{{ $giac->tele }}</td></tr>
                    <tr><th>Fax</th>
                        <td>{{ $giac->fax }}</td></tr>
                    <tr><th>E-Mail</th>
                        <td>{{ $giac->email }}</td></tr>
                    <tr><th>Site-Web</th>
                        <td>{{ $giac->website }}</td></tr>
                    <tr><th>Nom DG</th>
                        <td>{{ $giac->nom_dg }}</td></tr>
                    <tr><th>Tél. DG</th>
                        <td>{{ $giac->tel_dg }}</td></tr>
                    <tr><th>E-Mail DG</th>
                        <td>{{ $giac->email_dg }}</td></tr>
                    <tr><th>Nom responsable</th>
                        <td>{{ $giac->nom_resp }}</td></tr>
                    <tr><th>Tél. responsable</th>
                        <td>{{ $giac->tel_resp }}</td></tr>
                    <tr><th>E-Mail responsable</th>
                        <td>{{ $giac->email_resp }}</td></tr>
                    <tr><th>Date der. modif.</th>
                        <td>{{ $giac->updated_at }}</td></tr>
                    <tr><th>Commentaire</th>
                        <td>{{ $giac->commentaire }}</td></tr>
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
