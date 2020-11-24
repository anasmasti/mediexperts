@extends('layouts.admin')

@section('content')


@section('content-wrapper')
<div class="col-sm-6">
        <h1 class="m-0 text-dark">Mission intervenant</h1>
    </div><!-- /.col -->
    <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="/mis-inv">Mission intervenant</a></li>
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
        {{-- add button --}}
        <a class="btn bu5 bu-sm btn-sm" href="/add-mis-inv"><i class="fa fa-plus"></i></a>
        {{-- search form --}}
        <div class="d-flex">
            <h3 class="card-title">Mission&nbsp;intervenant</h3>
            <div class="container h-100">
            <form action="/searchmiss" method="GET">
            <div class="searchbar bu-sm">
                <input class="search_input" type="text" name="searchmiss" placeholder="Rechercher par id..">
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
                    <th>ID mission</th>
                    <th>Intervenant&nbsp;&nbsp;<i class="fas fa-tag"></th>
                    <th>N° demande financement&nbsp;&nbsp;<i class="fas fa-tag"></th>
                    <th class="action">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($misinv as $miss)
                <tr>
                        @foreach($interv as $inv)
                            @if ($inv->id_interv==$miss->id_interv)
                                <?php $id = $inv->id_interv ?>
                                <?php $nom = $inv->nom ?>
                            @endif
                        @endforeach

                        @foreach($df as $d)
                            @if ($d->n_df==$miss->n_df)
                                <?php $ndf = $d->n_df ?>
                            @endif
                        @endforeach

                    <td>{{ $miss->id }}</td>
                    <td>{{ $miss->n_df }}</td>
                    <td>{{ $nom }} {{ $miss->id_interv }}</td>

                    <td class="action">
                        {{-- <a class="btn btn-sm bu5" href="/detail-mis-inv/{{ $miss->id }}"><i class="fa fa-eye"></i></a>
                        <a class="btn btn-sm bu5" href="/edit-mis-inv/{{ $miss->id }}"><i class="fa fa-edit"></i></a>
                        <a class="btn btn-sm bu5" a="/del-mis-inv/{{ $miss->id }}" onclick="confirmDelete({{$miss->id}}, 'mis-inv/')"><i class="fa fa-trash-alt"></i></a> --}}
                        
                        <a href="/detail-mis-inv/{{ $miss->id }}" class="btn btn-primary"><i class="fas fa-eye"></i></a>
                        <a href="/edit-mis-inv/{{ $miss->id }}" class="btn btn-warning"><i class="fas fa-edit"></i></a>
                        <a href="#" class="btn btn-danger" onclick="confirmDelete({{$miss->id}}, 'mis-inv/')"><i class="fas fa-trash-alt"></i></a>
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
