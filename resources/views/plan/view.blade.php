@extends('layouts.admin')

@section('content')


@section('content-wrapper')
<div class="col-sm-6">
        <h1 class="m-0 text-dark">Plans formation</h1>
    </div><!-- /.col -->
    <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="/planformation">Plans formation</a></li>
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
        <a class="btn bu5 bu-sm btn-sm" href="/add-plan"><i class="fa fa-plus"></i></a>

        <div class="d-flex h-100">
            <h3 class="card-title">Plans&nbsp;de&nbsp;formation</h3>
            <div class="container h-100">
                <form action="/search-pdf" method="GET">
                    <div class="searchbar bu-sm">
                        <input class="search_input" type="text" name="search_input" placeholder="Ref. Plan">
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
                    <th>État</th>
                    <th>Réf Plan</th>
                    <th>Entreprise<span>&nbsp;&nbsp;<i class="fas fa-tag"></i></span></th>
                    <th width="230px">Commentaire</th>
                    <th class="action">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($plans as $pdf)
                <tr>
                    <?php $entrp = \App\Client::select('clients.raisoci', 'clients.nrc_entrp')
                        ->join('plans', 'plans.nrc_e', '=', 'clients.nrc_entrp')
                        ->where('plans.nrc_e', $pdf->nrc_e)
                        ->first(); ?>

                    <td class="{{ ($pdf->etat == "planifié") ? 'font-weight-bold badge-success' : ($pdf->etat == "réalisé" ? 'font-weight-bold badge-warning' : 'font-weight-bold badge-danger') }}">{{ ucfirst($pdf->etat) }}</td>
                    <td>{{$pdf->refpdf}}</td>
                    <td class="td-4"><a href="/act-form-cl/{{$entrp['nrc_entrp']}}/{{$pdf->annee}}">Actions : </a> {{$entrp['raisoci']}}</td>
                    <td class="th-last">{{ $pdf->commentaire ? substr($pdf->commentaire, 0, 50).'...' : "--" }}</td>

                    <td class="action py-0 align-middle">
                      <div class="btn-group btn-group-sm">
                        <a href="/act-form-cl/{{$entrp['nrc_entrp']}}/{{$pdf->annee}}" class="btn btn-secondary"><i class="fas fa-list-alt"></i></a>
                        <a href="/detail-plan/{{ $pdf->id_plan }}" class="btn btn-primary"><i class="fas fa-eye"></i></a>
                        <a href="/edit-plan/{{ $pdf->id_plan }}" class="btn btn-warning"><i class="fas fa-edit"></i></a>
                        <a href="#" class="btn btn-danger" onclick="confirmDelete({{$pdf->id_plan}}, 'plan/')"><i class="fas fa-trash-alt"></i></a>
                      </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div><!-- ./card-body -->

    <div class="card-footer text-center">
        @if (!count($plans))
            <tr>
                <td>
                    <h3 class="text-secondary">Aucun résultat</h3>
                </td>
            </tr>    
        @endif
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
