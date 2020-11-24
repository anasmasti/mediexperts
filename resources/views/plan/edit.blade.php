@extends('layouts.admin')

@section('content')

    @php
        $entrp = \App\Client::select('clients.nrc_entrp', 'clients.raisoci')
            ->join('plans', 'clients.nrc_entrp', 'plans.nrc_e')
            ->where('clients.nrc_entrp', $plans->nrc_e)
            ->first();
    @endphp

@section('content-wrapper')
<div class="col-sm-6">
        <h1 class="m-0 text-dark">Plan formation</h1>
    </div><!-- /.col -->
    <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="/plan">Plan formation</a></li>
            <li class="breadcrumb-item active">N° {{ $plans->id_plan }}</li>
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
        <h3 class="card-title">Modifier plan N° {{ $plans->id_plan }} > {{$entrp['raisoci']}}</h3>
    </div>
    <!-- /.card-header -->
    <form role="form" action="/edit-plan/{{ $plans->id_plan }}" method="POST">
      <div class="card-body">
        <div class="row">
        {{ csrf_field() }}

            <div class="form-group col-lg-6 col-sm-12">
                <label for="nrc_e">Entreprise</label>
                @if (count($client)==0)
                    <a class="btn bu5 bu-sm btn-sm" href="/add-cl"><i class="fa fa-plus"></i></a>
               @endif
                <select class="form-control {{ $errors->has('nrc_e') ? 'is-invalid' : '' }}" name="nrc_e" id="nrc_e" value="{{$plans->nrc_e}}">
                    <option selected disabled>--</option>
                    @foreach ($client as $cl)
                        @if ($plans->nrc_e == $cl->nrc_entrp)
                            <option selected value="{{$cl->nrc_entrp}}">{{$cl->raisoci}}</option>
                        @endif
                    @endforeach
                </select>
                @if (count($client)==0)
                <div class="text-danger txt-sm">Veuillez d'abord ajouter un client</div>
                @endif
                    @if ($errors->has('nrc_e'))
                        <span class="invalid-feedback" role="alert">
                            {{ $errors->first('nrc_e') }}
                        </span>
                   @endif
            </div>

            <div class="form-group col-lg-3 col-sm-12"><label>Année d'exercice</label>
                <input class="form-control {{ $errors->has('annee') ? 'is-invalid' : '' }}" value="{{$plans->annee}}" type="text" name="annee" maxlength="30" readonly>
                @if ($errors->has('annee'))
                    <span class="invalid-feedback" role="alert">
                        {{ $errors->first('annee') }}
                    </span>
                @endif
            </div>

            <div class="form-group col-lg-3 col-sm-12"><label>Réference</label><input class="form-control {{ $errors->has('refpdf') ? 'is-invalid' : '' }}" value="{{$plans->refpdf}}" type="text" name="refpdf" maxlength="30" placeholder="Réf." disabled>
            @if ($errors->has('refpdf'))
                <span class="invalid-feedback" role="alert">
                    {{ $errors->first('refpdf') }}
                </span>
            @endif
            </div>


            {{-- <div class="form-group col-12" id="ofpptTitle">
            <h3 class="text-secondary" style="line-height: .5;">OFPPT</h3>
            </div> --}}


            <div class="form-group col-lg-6 col-sm-12" id="">
            <label>{{----}}</label>
            <div class="form-group">
                <div class="custom-control custom-checkbox">
                <input type="checkbox" name="l_tierpay_PF" id="l_tierpay_PF" class="custom-control-input" {{ (mb_strtolower($plans->l_tierpay_PF)=="préparé") ? 'checked' : '' }}>
                <label for="l_tierpay_PF" class="custom-control-label">Lettre de tiers-payant PF</label>
                </div>
                <div class="custom-control custom-checkbox">
                <input type="checkbox" name="at_approb_PFOPT" id="at_approb_PFOPT" class="custom-control-input" {{ (mb_strtolower($plans->at_approb_PFOPT)=="préparé") ? 'checked' : '' }}>
                <label for="at_approb_PFOPT" class="custom-control-label">Attestation d'approbation</label>
                </div>
                <div class="custom-control custom-checkbox">
                <input type="checkbox" name="rpt_DS_PFOPT" id="rpt_DS_PFOPT" class="custom-control-input" {{ (mb_strtolower($plans->rpt_DS_PFOPT)=="préparé") ? 'checked' : '' }}>
                <label for="rpt_DS_PFOPT" class="custom-control-label">Rapport DS</label>
                </div>
                <div class="custom-control custom-checkbox">
                <input type="checkbox" name="rpt_IF_PFOPT" id="rpt_IF_PFOPT" class="custom-control-input" {{ (mb_strtolower($plans->rpt_IF_PFOPT)=="préparé") ? 'checked' : '' }}>
                <label for="rpt_IF_PFOPT" class="custom-control-label">Rapport IF</label>
                </div>
                <div class="custom-control custom-checkbox">
                <input type="checkbox" name="f2_PFOPT" id="f2_PFOPT" class="custom-control-input" {{ (mb_strtolower($plans->f2_PFOPT)=="préparé") ? 'checked' : '' }}>
                <label for="f2_PFOPT" class="custom-control-label">Formulaire F2</label>
                </div>
            </div>
            </div>

            <div class="form-group col-lg-6 col-sm-12" id="">
            <label>{{----}}</label>
            <div class="form-group">
                <div class="custom-control custom-checkbox">
                <input type="checkbox" name="model1_PFOPT" id="model1_PFOPT" class="custom-control-input" {{ (mb_strtolower($plans->model1_PFOPT)=="préparé") ? 'checked' : '' }}>
                <label for="model1_PFOPT" class="custom-control-label">Modèle 1</label>
                </div>
                <div class="custom-control custom-checkbox">
                <input type="checkbox" name="rib_PFOPT" id="rib_PFOPT" class="custom-control-input" {{ (mb_strtolower($plans->rib_PFOPT)=="préparé") ? 'checked' : '' }}>
                <label for="rib_PFOPT" class="custom-control-label">RIB</label>
                </div>
                <div class="custom-control custom-checkbox">
                <input type="checkbox" name="f3_PFOPT" id="f3_PFOPT" class="custom-control-input" {{ (mb_strtolower($plans->f3_PFOPT)=="préparé") ? 'checked' : '' }}>
                <label for="f3_PFOPT" class="custom-control-label">Formulaire F3</label>
                </div>
                <div class="custom-control custom-checkbox">
                <input type="checkbox" name="at_qualif_PFOPT" id="at_qualif_PFOPT" class="custom-control-input" {{ (mb_strtolower($plans->at_qualif_PFOPT)=="préparé") ? 'checked' : '' }}>
                <label for="at_qualif_PFOPT" class="custom-control-label">Attestation de qualification</label>
                </div>
                <div class="custom-control custom-checkbox">
                <input type="checkbox" name="eligib_cab_PFOPT" id="eligib_cab_PFOPT" class="custom-control-input" {{ (mb_strtolower($plans->eligib_cab_PFOPT)=="préparé") ? 'checked' : '' }}>
                <label for="eligib_cab_PFOPT" class="custom-control-label">Attestation d'éligibilité cabinet</label>
                </div>
            </div>
            </div>


            <div class="form-group col-lg-6 col-sm-12" id="">
            <label for="accuse_PFOPT">Accusé (Modèle 1)</label>
            <div class="input-group">
            <div class="input-group-prepend">
            <span class="input-group-text">
                <input type="checkbox" name="accuse_PFOPT" id="accuse_PFOPT" {{ (mb_strtolower($plans->accuse_PFOPT)=="préparé") ? 'checked' : '' }}>
            </span>
            </div>
            <input class="form-control {{ $errors->has('dt_accuse_PFOPT') ? 'is-invalid' : '' }}" value="{{$plans->dt_accuse_PFOPT}}" type="text" name="dt_accuse_PFOPT" id="dt_accuse_PFOPT" onmouseover="(this.type='date')" placeholder="Date d'accusation">
                @if ($errors->has('dt_accuse_PFOPT'))
                <span class="invalid-feedback" role="alert">
                    {{ $errors->first('dt_accuse_PFOPT') }}
                </span>
                @endif
            </div>
            </div>


            <div class="form-group col-lg-6 col-sm-12" id="divDf5">
                <label for="dt_recep_ct">Date réception contrat</label>
                <div class="input-group">
                    <input class="form-control {{ $errors->has('dt_recep_ct') ? ' is-invalid' : '' }}" value="{{$plans->dt_recep_ct}}" type="text" name="dt_recep_ct" id="dt_recep_ct" onmouseover="(this.type='date')" placeholder="Date d'accusation">
                        @if ($errors->has('dt_recep_ct'))
                            <span class="invalid-feedback" role="alert">
                                {{ $errors->first('dt_recep_ct') }}
                            </span>
                        @endif
                </div>
            </div>


            <div class="form-group col-12" id="">

            <table class="table table-sm table-bordered">
            <thead class="thead-light">
                <tr id="header">
                    <th scope="col" style="width:50%">Contrats</th>
                    <th scope="col" class="text-center" style="width:10%">Cabinet</th>
                    <th scope="col" class="text-center" style="width:10%">Client</th>
                    <th scope="col" class="text-center" style="width:10%">OFPPT</th>
                    <th scope="col" class="text-center" style="width:10%">Aucun</th>
                </tr>
            </thead>
            <tbody>
                <!--BEGIN OF : tr-->
                <tr id="tr_ct_PF">
                <td>Contrat PF</td>
                <td>
                    <div class="custom-control custom-radio text-center">
                    <input type="radio" name="ct_PF" id="ct_PF_cab" class="custom-control-input" {{ (mb_strtolower($plans->ct_PF)=="cabinet") ? 'checked' : '' }} value="cabinet">
                    <label for="ct_PF_cab" class="custom-control-label">&nbsp;</label>
                    </div>
                </td>
                <td>
                    <div class="custom-control custom-radio text-center">
                    <input type="radio" name="ct_PF" id="ct_PF_cl" class="custom-control-input" {{ (mb_strtolower($plans->ct_PF)=="client") ? 'checked' : '' }} value="client">
                    <label for="ct_PF_cl" class="custom-control-label">&nbsp;</label>
                    </div>
                </td>
                <td>
                    <div class="custom-control custom-radio text-center">
                    <input type="radio" name="ct_PF" id="ct_PF_opt" class="custom-control-input" {{ (mb_strtolower($plans->ct_PF)=="ofppt") ? 'checked' : '' }} value="ofppt">
                    <label for="ct_PF_opt" class="custom-control-label">&nbsp;</label>
                    </div>
                </td>
                <td>
                    <div class="custom-control custom-radio text-center">
                    <input type="radio" name="ct_PF" id="ct_PF_none" class="custom-control-input" value="non préparé" {{ (mb_strtolower($plans->ct_PF)=="non préparé") ? 'checked' : '' }}>
                    <label for="ct_PF_none" class="custom-control-label">&nbsp;</label>
                    </div>
                </td>
                </tr>
                <!--END OF : tr-->
            </tbody>
            </table>
            </div>

            <div class="form-group col-lg-6 col-sm-12" id=""><label for="dt_contrat_PFOPT">Date dépôt contrat PF</label>
            <input class="form-control {{ $errors->has('dt_contrat_PFOPT') ? 'is-invalid' : '' }}" value="{{$plans->dt_contrat_PFOPT}}" type="text" name="dt_contrat_PFOPT" onmouseover="(this.type='date')" id="dt_contrat_PFOPT" placeholder="Date dépôt demande">
            @if ($errors->has('dt_contrat_PFOPT'))
                <span class="invalid-feedback" role="alert">
                {{ $errors->first('dt_contrat_PFOPT') }}
                </span>
            @endif
            </div>

            <div class="form-group col-lg-6 col-sm-12"><label>État</label>
                <select class="form-control {{ $errors->has('etat') ? 'is-invalid' : '' }}" name="etat" id="etat" value="{{$plans->etat}}">
                  <?php $etat_plan = ['planifié', 'réalisé', 'annulé']; ?>
                  @foreach ($etat_plan as $etat)
                    <option {{($plans->etat == $etat) ? 'selected' : ''}} value="{{$etat}}">{{ucfirst($etat)}}</option>
                  @endforeach
                </select>
                @if ($errors->has('etat'))
                    <span class="invalid-feedback" role="alert">
                        {{ $errors->first('etat') }}
                    </span>
                @endif
            </div>

            <div class="form-group col-12"><label>Commentaire</label>
                <textarea class="form-control" type="text" rows="4" name="commentaire" maxlength="900" placeholder="Commentaire ..">{{$plans->commentaire}}</textarea>
            </div>

      </div><!--./row-->
    </div><!--./card-body-->


    <div class="card-footer text-center">
        <button class="btn buaj2" type="submit" id="edit"><i class="fas fa-pen-square"></i> Modifier</button>
        <a class="btn bua2" href="/plan"><i class="fas fa-window-close"></i> Annuler</a>
    </div>

    </form>
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
