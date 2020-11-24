@extends('layouts.admin')

@section('content')

            @foreach($client as $cl)
                @if($cl->nrc_entrp==$drb->nrc_e)
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
            <li class="breadcrumb-item"><a href="/drb-of">D.R OFPPT</a></li>
            <li class="breadcrumb-item active">{{ $drb->n_drb }}</li>
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
        <a class="btn btn-dark btn-sm bu-lg-ic" href="/drb-of"><i class="fa fa-arrow-left"></i></a>
        <h3 class="card-title card-h3">Demande N° {{ $drb->n_drb }}</h3>
        <a class="btn btn-sm bua bu-ic" a="/del-drb-of/{{ $drb->n_drb }}" onclick="confirmDelete({{$drb->n_drb}}, 'drb-of/')"><i class="fa fa-trash-alt"></i></a>
        <a class="btn btn-sm buaj bu-ic" href="/edit-drb-of/{{ $drb->n_drb }}/{{$nrc}}"><i class="fa fa-edit"></i></a>
    </div>
    <!-- /.card-header -->
    <div class="card-body table-striped p-0">
        <table class="table table-md">
            <thead class="thead">
            </thead>
            <tbody>
                <tr><th class="th-det">N° demande remboursement</th>
                    <td>{{ $drb->n_drb }}</td></tr>
                <tr><th class="th-det">Entreprise<i class="icon fas fa-tag"></i></label></th></th>
                    <td>{{ $drb->nrc_e }}</td></tr>

                {{-- DOCS --}}
                <tr><th class="th-det">Moyen de remboursement</th>
                @if (mb_strtolower($drb->moyen_rb) == "chèque")
                    <td>{{ $drb->moyen_rb }} : <p class="text-bold">Remise</p> {{ $drb->remise_avis }}, <p class="text-bold">Relevé</p> {{ $drb->releve }}</td></tr>
                @elseif ($drb->moyen_rb == "virement")
                    <td>{{ $drb->moyen_rb }} : <p class="text-bold">Avis d'opération</p> {{ $drb->remise_avis }}, <p class="text-bold">Relevé</p> {{ $drb->releve }}</td></tr>
                @elseif ($drb->moyen_rb == "effet")
                    <td>{{ $drb->moyen_rb }} : <p class="text-bold">Remise</p> {{ $drb->remise_avis }}, <p class="text-bold">Relevé</p> {{ $drb->releve }}</td></tr>
                @else
                    <td>Pas encore</td></tr>
                @endif

                <tr><th class="th-det">Justificatifs de paiement entreprise</th>
                    <td>{{ $drb->justif_paiem_entrp }}</td></tr>
                <tr><th class="th-det">Justificatifs de paiement cabinet</th>
                    <td>{{ $drb->justif_paiem_cab }}</td></tr>
                <tr><th class="th-det">Facture plan formation</th>
                    <td>{{ $drb->plan_form }}</td></tr>

                <tr><th class="th-det">Date d'envoi</th>
                    <td>{{ $drb->dt_envoi }}</td></tr>
                <tr><th class="th-det">Année CSF</th>
                    <td>{{ $drb->annee_csf }}</td></tr>
                <tr><th class="th-det">Date payement entreprise</th>
                    <td>{{ $drb->dt_pay_entrp }}</td></tr>
                <tr><th class="th-det">Montant entreprise TTC</th>
                    <td>{{ $drb->montant_entrp_ttc }}</td></tr>
                <tr><th class="th-det">Montant HT</th>
                    <td>{{ $drb->montant_entrp_ht }}</td></tr>
                    
                <tr><th class="th-det">Moyen de financement</th>
                @if (mb_strtolower($drb->moyen_fin) == "chèque")
                    <td><span class="text-bold text-capitalize">{{ $drb->moyen_fin }}</span> : Remise → {{ $drb->remise_avis_fin }} & Relevé → {{ $drb->releve_fin }}</td></tr>
                @elseif ($drb->moyen_fin == "ordre de virement")
                    <td><span class="text-bold text-capitalize">{{ $drb->moyen_fin }}</span> : Avis d'opération → {{ $drb->remise_avis_fin }} & Relevé → {{ $drb->releve_fin }}</td></tr>
                @elseif ($drb->moyen_fin == "effet")
                    <td><span class="text-bold text-capitalize">{{ $drb->moyen_fin }}</span> : Remise → {{ $drb->remise_avis_fin }} & Relevé → {{ $drb->releve_fin }}</td></tr>
                @else
                    <td>Pas encore défini</td></tr>
                @endif

                <tr><th class="th-det">Date dépôt demande remboursement</th>
                    <td>{{ $drb->dt_depo_drb }}</td></tr>
                    
                <tr><th class="th-det">Moyen de remboursement</th>
                @if (mb_strtolower($drb->moyen_rb) == "chèque")
                    <td><span class="text-bold text-capitalize">{{ $drb->moyen_rb }}</span> : Remise → {{ $drb->remise_avis }} & Relevé → {{ $drb->releve }}</td></tr>
                @elseif ($drb->moyen_rb == "ordre de virement")
                    <td><span class="text-bold text-capitalize">{{ $drb->moyen_rb }}</span> : Avis d'opération → {{ $drb->remise_avis }} & Relevé → {{ $drb->releve }}</td></tr>
                @elseif ($drb->moyen_rb == "effet")
                    <td><span class="text-bold text-capitalize">{{ $drb->moyen_rb }}</span> : Remise → {{ $drb->remise_avis }} & Relevé → {{ $drb->releve }}</td></tr>
                @else
                    <td>Pas encore défini</td></tr>
                @endif

                <tr><th class="th-det">Date der. modif.</th>
                    <td>{{ $drb->dt_rb }}</td></tr>
                <tr><th class="th-det">Montant remboursement</th>
                    <td>{{ $drb->montant_rb }}</td></tr>
                <tr><th class="th-det">Moyenne remboursement</th>
                    <td>{{ $drb->moyen_rb }}</td></tr>
                <tr><th class="th-det">Date der. modif.</th>
                    <td>{{ $drb->updated_at }}</td></tr>
                <tr><th class="th-det">Commentaire</th>
                    <td>{{ $drb->commentaire }}</td></tr>
            </tbody>
        </table>
    </div><!-- ./card-body -->

    {{-- <div class="card-footer">
    </div> --}}
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
