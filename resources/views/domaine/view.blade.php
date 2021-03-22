@extends('layouts.admin')

@section('content')


@section('content-wrapper')
<div class="col-sm-6">
        <h1 class="m-0 text-dark">Domaines</h1>
    </div><!-- /.col -->
    <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="/domain">Domaine</a></li>
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
        <a class="btn bu-icon bu-sm btn-sm" href="/add-domain"><i class="fa fa-plus"></i></a>
        <div class="d-flex h-100">  <h3 class="card-title">Domaines</h3>
        <div class="container h-100">
            <form action="/search-domain" method="GET">
                <div class="searchbar bu-sm">
                    <input class="search_input" type="text" name="search" placeholder="par nom domaine/ville/coût..">
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
                    <th>Intitulé</th>
                    {{-- <th>Région</th> --}}
                    <th>Ville</th>
                    <th>Coût</th>
                    <th>Commentaire</th>
                    <th class="action">Action</th>
                </tr>
            </thead>

            <tbody>
                @foreach ($domain as $dom)
                <tr>
                    {{-- <td class="td-1">{{ $dom->id_domain }}</td> --}}
                    <td class="td-2">{{ $dom->nom_domain }}</td>
                    {{-- <td class="td-2">{{ $dom->region }}</td> --}}
                    <td class="td-2">{{ $dom->ville }}</td>
                    <td class="td-2">{{ $dom->cout }} DH</td>
                    <td class="th-last d-inline-block text-truncate">{{ $dom->commentaire }}</td>

                    <td class="action py-0 align-middle">
                      <div class="btn-group btn-group-sm">
                        <a class="btn btn-secondary" href="/themes-domain/{{ $dom->id_domain }}"><i class="fa fa-list"></i></a>
                        <a class="btn btn-primary" href="/detail-domain/{{ $dom->id_domain }}"><i class="fa fa-eye"></i></a>
                        <a class="btn btn-warning" href="/edit-domain/{{ $dom->id_domain }}"><i class="fa fa-edit "></i></a>

                        <?php $hasTheme = false; ?>
                        @foreach ($theme as $th)
                            @if($th->id_dom == $dom->id_domain)
                                <?php $hasTheme = true; ?>
                            @endif
                        @endforeach

                        @if ($hasTheme==true)
                            <a href="#" class="btn btn-danger" onclick="IsChild()"><i class="fa fa-trash-alt"></i></a>
                        @else
                            <a href="#" class="btn btn-danger" onclick="confirmDelete({{$dom->id_domain}}, 'domain/')"><i class="fa fa-trash-alt"></i></a>
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
