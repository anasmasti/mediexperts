@extends('layouts.admin')

@section('content')

    @foreach($client as $cl)
        @if($cl->nrc_entrp==$action->nrc_e)
            <?php $nrc = $cl->nrc_entrp ?>
            <?php $name = $cl->raisoci ?>
        @endif
    @endforeach

@section('content-wrapper')
<div class="col-sm-6">
        <h1 class="m-0 text-dark">Détails</h1>
    </div><!-- /.col -->
    <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="/actionnaire">Actionnaire</a></li>
            <li class="breadcrumb-item active">{{ $action->nom }}</li>
        </ol>
    </div><!-- /.col -->
@endsection

{{-- <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
@include('sweet::alert') --}}

<!-- CARD -->
<div class="card card-dark">
    <!-- card-header -->
    <div class="card-header">
        <a class="btn btn-dark btn-sm bu-lg-ic" href="/actionnaire"><i class="fa fa-arrow-left"></i></a>
        <h3 class="card-title card-h3">{{ $action->nom }} {{ $action->prenom }}</h3>
        <a class="btn btn-sm bua bu-ic" a="/del-act/{{ $action->id_act }}" onclick="confirmDelete({{$action->id_act}}, 'act/')"><i class="fa fa-trash-alt"></i></a>
        <a class="btn btn-sm buaj bu-ic" href="/edit-act/{{ $action->id_act }}/{{$nrc}}"><i class="fa fa-edit"></i></a>
    </div>
    <!-- /.card-header -->
    <div class="card-body table-striped p-0">
        <table class="table table-md">
            <thead class="thead">
            </thead>
            <tbody>
                <tr><th class="th-det">ID Actionnaire</th>
                    <td>{{ $action->id_act }}</td></tr>
                <tr><th class="th-det">Entreprise&nbsp;&nbsp;<i class="fas fa-tag"></i></th>
                    <td><a href="/detail-cl/{{ $action->nrc_e }}">{{$name}}</a></td></tr>
                <tr><th class="th-det">Nom</th>
                    <td>{{ $action->nom }}</td></tr>
                <tr><th class="th-det">Prénom</th>
                    <td>{{ $action->prenom }}</td></tr>
                <tr><th class="th-det">Nombre d'actions</th>
                    <td>{{ $action->nb_acts }}</td></tr>
                <tr><th class="th-det">Pourcentage</th>
                    <td>{{ $action->percent }}%</td></tr>
                {{-- <tr><th class="th-det">TAG</th>
                    <td>{{ $action->tag1 }}</td></tr> --}}
                <tr><th class="th-det">Date der. modif.</th>
                    <td>{{ $action->updated_at }}</td></tr>
                <tr><th class="th-det">Commentaire</th>
                    <td>{{ $action->commentaire }}</td></tr>
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
