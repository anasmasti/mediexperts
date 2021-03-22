@extends('layouts.admin')

@section('content')

@section('content-wrapper')
<div class="col-sm-6">
        <h1 class="m-0 text-dark">Détails</h1>
    </div><!-- /.col -->
    <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="/theme">Thème</a></li>
            <li class="breadcrumb-item active">{{ $theme->nom_theme }}</li>
        </ol>
    </div><!-- /.col -->
@endsection

    @foreach($domain as $dom)
        @if ($dom->id_domain==$theme->id_dom)
            @php $id_d = $dom->id_domain @endphp
            @php $nom_d = $dom->nom_domain @endphp
            @php $ville_domain = $dom->ville @endphp
            @php $cout_domain = $dom->cout @endphp
        @endif
    @endforeach

{{-- jquery scripts --}}
<script src={{ asset('js/jquery.js') }}></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
{{-- jquery scripts --}}

<!-- CARD -->
<div class="card card-dark">
    <!-- card-header -->
    <div class="card-header">
        <a class="btn btn-dark btn-sm bu-lg-ic" href="/theme"><i class="fa fa-arrow-left"></i></a>
        <h3 class="card-title card-h3">{{ $theme->nom_theme }} > {{ $nom_d }}</h3>

        <a class="btn btn-sm bua bu-ic" onclick="confirmDelete({{$theme->id_theme}}, 'theme/')"><i class="fa fa-trash-alt"></i></a>
        <a class="btn btn-sm buaj bu-ic" href="/edit-theme/{{ $theme->id_theme }}"><i class="fa fa-edit"></i></a>
    </div>
    <!-- /.card-header -->
    <div class="card-body table-striped p-0">
        <table class="table table-md">
            <thead class="thead">
            </thead>
            <tbody>
                {{-- <tr><th class="th-det">ID thème</th>
                    <td>{{ $theme->id_theme }}</td></tr> --}}
                <tr><th class="th-det">Domaine<span>&nbsp;&nbsp;</span><i class="fas fa-tag"></i></th>
                    <td>{{$nom_d}} > {{$ville_domain}} > {{$cout_domain}} dh {{-- $theme->id_dom --}}</td></tr>
                <tr><th class="th-det">Intitulé thème</th>
                    <td>{{ $theme->nom_theme }}</td></tr>
                <tr><th class="th-det">Objectif</th>
                    <td>{{ $theme->objectif }}</td></tr>
                <tr><th class="th-det">Contenu</th>
                    <td>{{ $theme->contenu }}</td></tr>
                <tr><th class="th-det">Date der. modif.</th>
                    <td>{{ $theme->updated_at }}</td></tr>
                <tr><th class="th-det">Commentaire</th>
                    <td>{{ $theme->commentaire }}</td></tr>
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
