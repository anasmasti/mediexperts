@extends('layouts.admin')

@section('content')

        @foreach($cabinet as $cab)
            @if ($cab->nrc_cab==$interv->nrc_c)
                <?php $nrc = $cab->nrc_cab ?>
                <?php $name = $cab->raisoci ?>
            @endif
        @endforeach

@section('content-wrapper')
<div class="col-sm-6">
        <h1 class="m-0 text-dark">Détails</h1>
    </div><!-- /.col -->
    <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="/intervenant">Intervenant</a></li>
            <li class="breadcrumb-item active">{{ $interv->nom }} {{ $interv->prenom }}</li>
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
        <a class="btn btn-dark btn-sm bu-lg-ic" href="/intervenant"><i class="fa fa-arrow-left"></i></a>
        <h3 class="card-title card-h3">{{ ucfirst($interv->nom) }} {{ ucfirst($interv->prenom) }} > {{$name}}</h3>
        {{-- check child data --}}
        <?php $A = false; $B = false; ?>

        @foreach($plan as $pf)
            @if($interv->id_interv==$pf->id_inv)
                <?php $A = true; ?>
            @endif
        @endforeach

        @foreach($misinv as $mis)
            @if($interv->id_interv==$mis->id_interv)
                <?php $B = true; ?>
            @endif
        @endforeach

        @if ($A==true | $B==true)
            <a class="btn btn-sm bua bu-ic" onclick="IsChild()"><i class="fa fa-trash-alt"></i></a>
        @elseif ($A==false | $B==false)
            <a class="btn btn-sm bua bu-ic" onclick="confirmDelete({{$interv->id_interv}}, 'inv/')"><i class="fa fa-trash-alt"></i></a>
        @endif
        <a class="btn btn-sm buaj bu-ic" href="/edit-inv/{{ $interv->id_interv }}/{{$nrc}}"><i class="fa fa-edit"></i></a>
    </div>
    <!-- /.card-header -->
    <div class="card-body table-striped p-0">
        <table class="table table-md">
            <thead class="thead">
            </thead>
            <tbody>
                <tr><th class="th-det">État</th>
                    <td class="{{ (mb_strtolower($interv->etat) == "occupé") ? 'font-weight-bold text-danger' : 'font-weight-bold text-success' }}">{{ ucfirst($interv->etat) }}</td></tr>
                {{-- <tr><th class="th-det">ID Intervenant</th> --}}
                    {{-- <td>{{ $interv->id_interv }}</td></tr> --}}
                <tr><th class="th-det">Cabinet&nbsp;&nbsp;<i class="fas fa-tag"></i></th>
                    <td><a href="/detail-cab/{{$interv->nrc_c}}">{{$name}}</a></td></tr>
                <tr><th class="th-det">Nom</th>
                    <td>{{ $interv->nom }}</td></tr>
                <tr><th class="th-det">Prénom</th>
                    <td>{{ $interv->prenom }}</td></tr>
                <tr><th class="th-det">Spécificité</th>
                    <td>{{ $interv->specif }}</td></tr>
                <tr><th class="th-det">Domaine d'intervention</th>
                    <td>{{ $interv->dom_interv }}</td></tr>
                <tr><th class="th-det">Langues parlées</th>
                    <td>{{ $interv->langs }}</td></tr>
                <tr><th class="th-det">Modules de formation</th>
                    <td>{{ $interv->module ? $interv->module : "(Aucune formation affecté)" }}</td></tr>
                <tr><th class="th-det">Téléphone</th>
                    <td>{{ $interv->tele }}</td></tr>
                <tr><th class="th-det">E-Mail</th>
                    <td><a href="mailto:{{ $interv->email }}">{{ $interv->email }}</a></td></tr>
                <tr><th class="th-det">C.V.</th>
                    <td><a href="/{{ $interv->cv }}" target="_blank">Afficher le C.V.</a></td></tr>
                <tr><th class="th-det">Date der. modif.</th>
                    <td>{{ $interv->updated_at }}</td></tr>
                <tr><th class="th-det">Commentaire</th>
                    <td>{{ $interv->commentaire }}</td></tr>
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
