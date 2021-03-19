@extends('layouts.admin')

@section('content')


@section('content-wrapper')
<div class="col-sm-6">
        <h1 class="m-0 text-dark">Thèmes</h1>
    </div><!-- /.col -->
    <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="/theme">Thème</a></li>
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
        <a class="btn bu-icon bu-sm btn-sm" href="/add-theme"><i class="fa fa-plus"></i></a>
        <div class="d-flex h-100"><h3 class="card-title">Thèmes</h3>
        <div class="container h-100">
            <form action="/search-theme" method="GET">
                <div class="searchbar">
                    <input class="search_input" type="text" name="search" placeholder="par nom thème/ville..">
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
                    {{-- <th>ID</th> --}}
                    <th>Thème</th>
                    <th>Domaine<span>&nbsp;&nbsp;<i class="fas fa-tag"></i></span></th>
                    <th>Coût</th>
                    <th>Ville</th>
                    {{-- <th>Commentaire</th> --}}
                    <th class="action">Action</th>
                </tr>
            </thead>

            <tbody>
                @foreach ($theme as $th)
                <tr>
                    @foreach ($domain as $dom)
                        @if ($th->id_dom == $dom->id_domain)
                            <?php $id_d = $dom->id_domain ?>
                            <?php $nom_d = $dom->nom_domain ?>
                            <?php $cout_d = $dom->cout ?>
                            <?php $ville_d = $dom->ville ?>
                        @endif
                    @endforeach
                    {{-- <td class="td-1">{{ $th->id_theme }}</td> --}}
                    <td class="td-2">{{ $th->nom_theme }}</td>
                    <td class="td-2">{{ $nom_d }}</td>
                    <td class="td-2">{{ $cout_d }}</td>
                    <td class="td-2">{{ $ville_d }}</td>
                    {{-- <td class="th-last d-inline-block text-truncate">{{ $th->commentaire }}</td>. --}}

                    @php
                        $has_action_form = false; $action_form = null;
                        $action_form = \App\ActionFormation::where('id_thm', $th->id_theme);
                    @endphp

                    <td class="action py-0 align-middle">
                        <div class="btn-group btn-group-sm">
                            <a class="btn btn-primary btn-sm" href="/detail-theme/{{ $th->id_theme }}"><i class="fa fa-eye"></i></a>
                            <a class="btn btn-warning btn-sm" href="/edit-theme/{{ $th->id_theme }}"><i class="fa fa-edit "></i></a>
                            @if ($action_form)
                                <a href="#" class="btn btn-danger" onclick="IsChild()"><i class="fa fa-trash-alt"></i></a>
                            @else
                                <a class="btn btn-danger btn-sm" href="#" onclick="confirmDelete({{$th->id_theme}}, 'theme/')"><i class="fa fa-trash-alt"></i></a>
                            @endif
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>

        </table>

    </div><!-- ./card-body -->

    <div class="card-footer"></div>

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
