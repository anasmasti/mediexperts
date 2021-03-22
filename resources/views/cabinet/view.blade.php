@extends('layouts.admin')

@section('content')


@section('content-wrapper')
<div class="col-sm-6">
        <h1 class="m-0 text-dark">Cabinets</h1>
    </div><!-- /.col -->
    <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="/cabinet">Cabinet</a></li>
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
        <a class="btn bu-icon bu-sm btn-sm" href="/add-cab"><i class="fa fa-plus"></i></a>
        <div class="d-flex h-100">  <h3 class="card-title">Cabinets</h3>
        <div class="container h-100 ">
            <form action="/searchcabinet" method="GET">
                <div class="searchbar bu-sm">
                    <input class="search_input" type="text" name="searchcabinet" placeholder="Rechercher par raison social..">
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
                    <th>N° RC Cabinet</th>
                    <th>Raison social</th>
                    <th>Forme juridique</th>
                    <th>Domaine compétence</th>
                    <th class="action">Action</th>
                </tr>
            </thead>

            <tbody>
                @foreach ($cabinet as $cab)
                <tr>
                    <td class="td-1">{{ $cab->nrc_cab }}</td>
                    <td class="td-2">{{ $cab->raisoci }}</td>
                    <td class="td-2">{{ $cab->formjury }}</td>
                    <td class="td-2">{{ $cab->dom_compet1 }}</td>


                        <?php $hasInterv = false; ?>
                        @foreach ($interv as $inv)
                            @if($inv->nrc_c == $cab->nrc_cab)
                                    <?php $hasInterv = true; ?>
                            @endif
                        @endforeach

                        <td class="action py-0 align-middle">
                          <div class="btn-group btn-group-sm">
                            <a href="/detail-cab/{{ $cab->nrc_cab }}" class="btn btn-primary"><i class="fas fa-eye"></i></a>
                            <a href="/edit-cab/{{ $cab->nrc_cab }}" class="btn btn-warning"><i class="fas fa-edit"></i></a>
                            @if ($hasInterv==true)
                                <a class="btn btn-danger" onclick="IsChild()"><i class="fa fa-trash-alt"></i></a>
                            @else
                                <a class="btn btn-danger" onclick="confirmDelete({{$cab->nrc_cab}}, 'cab/')"><i class="fa fa-trash-alt"></i></a>
                            @endif
                            <a id="buPrintF3" href="/print-f3/{{ $cab->nrc_cab }}" class="btn btn-info"><i class="fa fa-print"></i></a>
                          </div>
                        </td>

                        {{-- <a class="btn btn-sm bu-icon" href="/detail-cab/{{ $cab->nrc_cab }}"><i class="fa fa-eye"></i></a>
                        <a class="btn btn-sm bu-icon" href="/edit-cab/{{ $cab->nrc_cab }}"><i class="fa fa-edit "></i></a>

                        @if ($hasInterv==true)
                            <a class="btn btn-sm bu-icon" onclick="IsChild()"><i class="fa fa-trash-alt"></i></a>
                        @else
                            <a class="btn btn-sm bu-icon" onclick="confirmDelete({{$cab->nrc_cab}}, 'cab/')"><i class="fa fa-trash-alt"></i></a>
                        @endif
                        <a class="btn btn-sm bu-icon info" href="/print-f3/{{ $cab->nrc_cab }}"><i class="fa fa-print"></i></a> --}}

                        {{-- <a class="btn btn-sm bu-icon" href="cabinet/pdfcabinet/{{ $cab->nrc_cab }}"><i class="fa fa-download"></i></a> --}}
                        {{-- <a class="btn btn-sm bu-icon info" id="buPrintF3" href="/download-f3/{{ $cab->nrc_cab }}"><i class="fa fa-print"></i></a> --}}
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
