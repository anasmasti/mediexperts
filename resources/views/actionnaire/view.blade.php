@extends('layouts.admin')

@section('content')


@section('content-wrapper')
<div class="col-sm-6">
        <h1 class="m-0 text-dark">Actionnaires</h1>
    </div><!-- /.col -->
    <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="/actionnaire">Actionnaire</a></li>
            <li class="breadcrumb-item active">Liste</li>
        </ol>
    </div><!-- /.col -->
@endsection

{{-- <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
@include('sweet::alert') --}}

<!-- CARD -->
<div class="card card-dark">
    <!-- card-header -->
    <div class="card-header">
        <a class="btn bu-icon bu-sm btn-sm" href="/add-act"><i class="fa fa-plus"></i></a>
        <div class="d-flex h-100">
            <h3 class="card-title">Actionnaires</h3>

            <div class="container h-100 ">
            <form action="/searchact" method="GET">
                <div class="searchbar bu-sm">
                    <input class="search_input" type="text" name="searchact" placeholder="Rechercher par nom..">
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
                    <th>ID actionnaire</th>
                    <th>Nom</th>
                    <th>Prénom</th>
                    <th>Entreprise&nbsp;&nbsp;<i class="fas fa-tag"></i></th>
                    <th class="action">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($action as $act)
                <tr>
                        @foreach($client as $cl)
                            @if($cl->nrc_entrp==$act->nrc_e)
                                <?php $nrc = $cl->nrc_entrp ?>
                                <?php $name = $cl->raisoci ?>
                            @endif
                        @endforeach

                    <td>{{ $act->id_act }}</td>
                    <td>{{ $act->nom }}</td>
                    <td>{{ $act->prenom }}</td>
                    <td>{{$name}} ({{ $act->nrc_e }})</td>

                    <td class="action">
                        <a class="btn btn-sm bu-iconcon" href="/detail-act/{{ $act->id_act }}/{{$nrc}}"><i class="fa fa-eye"></i></a>
                        <a class="btn btn-sm bu-iconcon" href="/edit-act/{{ $act->id_act }}/{{$nrc}}"><i class="fa fa-edit"></i></a>
                        <a class="btn btn-sm bu-iconcon" a="/del-act/{{ $act->id_act }}" onclick="confirmDelete({{$act->id_act}}, 'act/')"><i class="fa fa-trash-alt"></i></a>
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
