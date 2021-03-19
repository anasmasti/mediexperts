@extends('layouts.admin')

@section('content')

@section('content-wrapper')
    <div class="col-sm-6">
        <h1 class="m-0 text-dark">Détails</h1>
    </div><!-- /.col -->
    <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="/plan">Plan formation</a></li>
            <li class="breadcrumb-item active">{{ $plans->id_plan }}</li>
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
      <a class="btn btn-dark btn-sm bu-lg-ic" href="/ActionFormation"><i class="fa fa-arrow-left"></i></a>
      <h3 class="card-title card-h3">Plan N° {{ $plans->id_plan }} > {{ $plans['raisoci'] }}</h3>
      <a class="btn btn-sm bua bu-ic" a="/del-plan/{{ $plans->id_plan }}" onclick="confirmDelete({{$plans->id_plan}}, 'plan/')"><i class="fa fa-trash-alt"></i></a>
      <a class="btn btn-sm buaj bu-ic" href="/edit-plan/{{ $plans->id_plan }}"><i class="fa fa-edit"></i></a>
    </div>
    <!-- /.card-header -->
    <div class="card-body table-striped p-0">
        <table class="table table-md">
            <thead class="thead">
              @if (session()->has('warning'))
                  <div class="alert alert-warning alert-dismissible col-12">
                      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                      <h5><i class="icon fas fa-warning"></i>Avertisement</h5>
                      <span>Veuillez modifier les dates de formations !<br>
                        <a class="text-info" href="/formation">&nbsp;<span><i class="fas fa-edit"></i>Formations</span></a>
                      </span>
                  </div>
              @endif
            </thead>
            <tbody>
                <tr><th class="th-det">État</th>
                    <td>{{ ucfirst($plans->etat) }}</td></tr>
                <tr><th class="th-det">Réference plan formation</th>
                    <td>{{ $plans->refpdf }}</td></tr>
                <tr><th class="th-det">Entreprise</th>
                    <td><a href="/detail-cl/{{$plans['nrc_entrp']}}">{{$plans['raisoci']}}</a></td></tr>

                <!-- PLAN FORMATION OFPPT -->
                {{-- <tr>
                    <td colspan="12" class="text-lg bg-dark">Dossier Plan de formation - OFPPT</td>
                </tr> --}}
                <tr>
                    <th>Date réception contrat PF</th>
                    <td class="th-det text-uppercase">
                        {{ \Carbon\Carbon::parse($plans->dt_recep_ct)->format('d/m/Y') }}
                    </td>
                </tr>
                <tr>
                    <th>Contrat PF</th>
                    <td class="th-det text-uppercase">
                    {{ $plans->ct_PF }}
                    @if (mb_strtolower($plans->ct_PF)=="ofppt")
                        <i class="fas fa-check"></i>
                    @else
                        <i class="fas fa-times"></i>
                    @endif
                    </td>
                </tr>
                <tr>
                    <th>Lettre tiers-payant PF</th>
                    <td class="th-det text-capitalize">
                    {{ $plans->l_tierpay_PF }}
                    @if ($plans->l_tierpay_PF=="préparé")
                        <i class="fas fa-check"></i>
                    @else
                        <i class="fas fa-times"></i>
                    @endif
                    </td>
                </tr>
                <tr>
                    <th>Attestation d'approbation IF </th>
                    <td class="th-det text-capitalize">
                    {{ $plans->at_approb_if }}
                    @if ($plans->at_approb_if=="préparé")
                        <i class="fas fa-check"></i>
                    @else
                        <i class="fas fa-times"></i>
                    @endif
                    </td>
                </tr>
                <tr>
                    <th> Attestation d'approbation DS</th>
                    <td class="th-det text-capitalize">
                    {{ $plans->at_approb_ds }}
                    @if ($plans->at_approb_ds=="préparé")
                        <i class="fas fa-check"></i>
                    @else
                        <i class="fas fa-times"></i>
                    @endif
                    </td>
                </tr>
                <tr>
                    <th>Rapport IF (PF)</th>
                    <td class="th-det text-capitalize">
                    {{ $plans->rpt_IF_PFOPT }}
                    @if ($plans->rpt_IF_PFOPT=="préparé")
                        <i class="fas fa-check"></i>
                    @else
                        <i class="fas fa-times"></i>
                    @endif
                    </td>
                </tr>
                <tr>
                    <th>Formulaire F2 (PF)</th>
                    <td class="th-det text-capitalize">
                    {{ $plans->f2_PFOPT }}
                    @if ($plans->f2_PFOPT=="préparé")
                        <i class="fas fa-check"></i>
                    @else
                        <i class="fas fa-times"></i>
                    @endif
                    </td>
                </tr>
                <tr>
                    <th>Modèle 1 (PF)</th>
                    <td class="th-det text-capitalize">
                    {{ $plans->model1_PFOPT }}
                    @if ($plans->model1_PFOPT=="préparé")
                        <i class="fas fa-check"></i>
                    @else
                        <i class="fas fa-times"></i>
                    @endif
                    </td>
                </tr>
                <tr>
                    <th>RIB (PF)</th>
                    <td class="th-det text-capitalize">
                    {{ $plans->rib_PFOPT }}
                    @if ($plans->rib_PFOPT=="préparé")
                        <i class="fas fa-check"></i>
                    @else
                        <i class="fas fa-times"></i>
                    @endif
                    </td>
                </tr>
                <tr>
                    <th>F3 (PF)</th>
                    <td class="th-det text-capitalize">
                    {{ $plans->f3_PFOPT }}
                    @if ($plans->f3_PFOPT=="préparé")
                        <i class="fas fa-check"></i>
                    @else
                        <i class="fas fa-times"></i>
                    @endif
                    </td>
                </tr>
                <tr>
                    <th>Attestation de qualification (PF)</th>
                    <td class="th-det text-capitalize">
                    {{ $plans->at_qualif_PFOPT }}
                    @if ($plans->at_qualif_PFOPT=="préparé")
                        <i class="fas fa-check"></i>
                    @else
                        <i class="fas fa-times"></i>
                    @endif
                    </td>
                </tr>
                <tr>
                    <th>Eligibilité cabinet (PF)</th>
                    <td class="th-det text-capitalize">
                    {{ $plans->eligib_cab_PFOPT }}
                    @if ($plans->eligib_cab_PFOPT=="préparé")
                        <i class="fas fa-check"></i>
                    @else
                        <i class="fas fa-times"></i>
                    @endif
                    </td>
                </tr>
                <tr>
                    <th>Accusé (PF)</th>
                    <td class="th-det text-capitalize">
                    {{ $plans->accuse_PFOPT }}
                    @if ($plans->accuse_PFOPT=="préparé")
                        <i class="fas fa-check"></i>
                    @else
                        <i class="fas fa-times"></i>
                    @endif
                    </td>
                </tr>
                <tr>
                    <th>Date dêpot DF/PF</th>
                    <td class="th-det text-capitalize">
                        {{ \Carbon\Carbon::parse($plans->dt_accuse_PFOPT)->format('d/m/Y') }}
                    </td>
                </tr>
                <tr>
                    <th width="350px">Commentaire</th>
                    <td>{{ $plans->commentaire }}</td>
                </tr>
                <!-- /. PF OFPPT -->


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
