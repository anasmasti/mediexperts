@extends('layouts.admin')

@section('content')


@section('content-wrapper')
<div class="col-sm-6">
        <h1 class="m-0 text-dark">GIACs</h1>
    </div><!--/.col-->
    <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="/giac">GIAC</a></li>
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

        <a class="btn bu-icon bu-sm btn-sm" href="/add-gc"><i class="fa fa-plus"></i></a>
        <div class="d-flex  h-100">
            <h3 class="card-title">GIACs</h3>
            <div class="container h-100">
            <form action="/searchgiac" method="GET">
                <div class="searchbar">
                    <input class="search_input" type="text" name="searchgiac" placeholder="Rechercher par libellé..">
                    <button type="submit"  class="search_icon btn"><i class="fas fa-search"></i></button>
                </div>
            </form>
            </div>
        </div>
    </div>

    <!--card-body-->
    <div class="card-body table-striped p-0">
        <table class="table table-md">
            <thead class="thead">
                <tr>
                    {{-- <th>Code GIAC</th> --}}
                    <th>Libellé</th>
                    <th>Spécificité</th>
                    <th>Adresse Local 1</th>
                    <th class="text-center">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($giac as $gc)
                <tr>
                    {{-- <td>{{ $gc->code_giac }}</td> --}}
                    <td>{{ $gc->libelle }}</td>
                    <td>{{ $gc->specif }}</td>
                    <td>{{ $gc->adlocal_1 }}</td>

                    <td class="text-center">
                        <a class="btn btn-sm bu-iconcon" href="/detail-gc/{{ $gc->code_giac }}"><i class="fa fa-eye"></i></a>
                        <a class="btn btn-sm bu-iconcon" href="/edit-gc/{{ $gc->code_giac }}"><i class="fa fa-edit "></i></a>
                        <a class="btn btn-sm bu-iconcon" a="/del-gc/{{ $gc->code_giac }}" onclick="confirmDelete({{$gc->code_giac}}, 'gc/')"><i class="fa fa-trash-alt "></i></a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div><!--/.card-body-->

    <div class="card-footer text-center">
        @if (!count($giac))
            <tr>
                <td>
                    <h3 class="text-secondary">Aucun résultat</h3>
                </td>
            </tr>
        @endif
    </div>

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
