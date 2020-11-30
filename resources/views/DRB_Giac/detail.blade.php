@extends('layouts.admin')

@section('content')


@section('content-wrapper')
<div class="col-sm-6">
    <h1 class="m-0 text-dark">Détails</h1>
    </div><!-- /.col -->
    <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="/drb-gc">D.R GIAC</a></li>
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
        <a class="btn btn-dark btn-sm bu-lg-ic" href="/drb-gc"><i class="fa fa-arrow-left"></i></a>

        @php
            $demande = \App\DemandeFinancement::select('clients.raisoci', 'clients.nrc_entrp', 'demande_financements.type_miss', 'demande_financements.n_df')
                ->join('clients', 'demande_financements.nrc_e', 'clients.nrc_entrp')
                ->join('demande_remboursement_giacs', 'demande_financements.n_df', 'demande_remboursement_giacs.n_df')
                ->where('demande_remboursement_giacs.n_df', $drb->n_df)
                ->first();
            $entrp = \App\Client::select('clients.nrc_entrp', 'clients.raisoci')
              ->join('demande_financements', 'clients.nrc_entrp', 'demande_financements.nrc_e')
              ->where('clients.nrc_entrp', $demande['nrc_entrp'])
              ->first();
        @endphp

        <h3 class="card-title card-h3">
            DRB GIAC >
            <a href="/detail-df/{{$demande['n_df']}}">
                {{ ucfirst($demande['type_miss']) }}
            </a>
            {{" > "}}
            <a href="/detail-cl/{{$demande['nrc_entrp']}}">
                {{ $demande['raisoci'] }}
            </a>
        </h3>
        <a class="btn btn-sm btn-info float-right" href="/print-facture-drb/{{$drb->n_drb}}/{{$entrp['nrc_entrp']}}"><i class="fa fa-print"></i></a>
        @if (Auth::user()->type_user != "comptable")
        <a class="btn btn-sm btn-danger float-right" onclick="confirmDelete({{$drb->n_drb}}, 'drb-gc/')"><i class="fa fa-trash-alt"></i></a>
        <a class="btn btn-sm btn-warning float-right" href="/edit-drb-gc/{{ $drb->n_drb }}"><i class="fa fa-edit"></i></a>
        @endif
    </div>
    <!-- /.card-header -->
    <div class="card-body p-0 table-responsive table-striped  {{--p-0 cus-card-height--}}">
        <table class="table table-striped">
            <thead class="thead">
                <tr>
                    <div class="progress" style="height: 20px;">
                      <div class="progress-bar progress-bar-striped {{ mb_strtolower($drb->etat=='remboursé') ? 'bg-success' : 'bg-warning progress-bar-animated' }}"
                        @if (mb_strtolower($drb->etat) == "initié") style="width: 20%" @endif
                        @if (mb_strtolower($drb->etat) == "payé") style="width: 40%" @endif
                        @if (mb_strtolower($drb->etat) == "instruction dossier") style="width: 60%" @endif
                        @if (mb_strtolower($drb->etat) == "déposé") style="width: 80%" @endif
                        @if (mb_strtolower($drb->etat) == "remboursé") style="width: 100%" @endif>
                      </div>
                    </div>
                </tr>
            </thead>
            <tbody>
                <tr>
                  <th>ÉTAT DEMANDE</th>
                  <td class="th-det text-capitalize">
                    @if (mb_strtolower($drb->etat) == "initié") <i class="fa fa-battery-quarter"></i> @endif
                    @if (mb_strtolower($drb->etat) == "payé") <i class="fa fa-dollar-sign"></i> @endif
                    @if (mb_strtolower($drb->etat) == "instruction dossier") <i class="fa fa-hourglass-half"></i> @endif
                    @if (mb_strtolower($drb->etat) == "déposé") <i class="fa fa-folder-open"></i> @endif
                    @if (mb_strtolower($drb->etat) == "remboursé") <i class="fa fa-check-circle"></i> @endif
                    {{ mb_strtolower($drb->etat) }}</td>
                </tr>
                <tr>
                  <th class="th-det">Mission de rembours.</th>
                  <td>
                    <a href="/detail-df/{{$demande['n_df']}}">
                        {{ ucfirst($demande['type_miss']) }}
                    </a>
                  </td>
                </tr>

                <tr>
                  <td colspan="12" class="text-lg bg-dark">PAIEMENT</td>
                </tr>

                <tr><th class="th-det">Facture cabinet entreprise</th>
                    <td>{{ $drb->fact_cab_entr }}</td></tr>
                <tr><th class="th-det">Relevé bancaire cabinet</th>
                    <td>{{ $drb->relv_banc_cab }}</td></tr>
                <tr><th class="th-det">Relevé bancaire entreprise</th>
                    <td>{{ $drb->relv_banc_entrp }}</td></tr>
                <tr><th class="th-det">Moyen de paiement</th>
                    <td>{{ ucfirst($drb->moyen_fin)." Réf : ".$drb->ref_fin }}</td></tr>
                <tr><th class="th-det">Reçus de paiement</th>
                    <td>{{ ucfirst($drb->avis_remise_fin) }}</td></tr>
                <tr><th class="th-det">Part GIAC</th>
                    <td>{{ substr($drb->part_giac, 0, 2)." " }}<i class="fa fa-percent"></i></td></tr>
                <tr><th class="th-det">Date paiement entreprise</th>
                    <td>{{ $drb->dt_pay_entrp }}</td></tr>
                <tr><th class="th-det">Montant entreprise TTC</th>
                    <td>{{ $drb->montant_entrp_ttc ? $drb->montant_entrp_ttc." DH" : '--' }}</td></tr>
                <tr><th class="th-det">Montant HT</th>
                    <td>{{$drb->montant_entrp_ht ? $drb->montant_entrp_ht." DH" : '--' }}</td></tr>

                <tr>
                  <td colspan="12" class="text-lg bg-dark">DÉPOT</td>
                </tr>

                <tr><th class="th-det">Date dépôt demande rembours.</th>
                    <td>{{ $drb->dt_depo_drb }}</td></tr>
                <tr>
                  <td colspan="12" class="text-lg bg-dark">REMBOURSEMENT</td>
                </tr>

                <tr><th class="th-det">Date der. modif.</th>
                    <td>{{ $drb->dt_rb }}</td></tr>
                <tr><th class="th-det">Montant remboursement</th>
                    <td>{{ $drb->montant_rb ? $drb->montant_rb." DH" : '--' }}</td></tr>
                <tr><th class="th-det">Moyen rembours.</th>
                    <td>{{ ucfirst($drb->moyen_rb)." Réf : ".$drb->ref_fin  }}</td></tr>

                <tr><th class="th-det">Date der. modif.</th>
                    <td>{{ $drb->updated_at }}</td></tr>
                <tr><th class="th-det">Commentaire</th>
                    <td>{{ $drb->commentaire }}</td></tr>
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
