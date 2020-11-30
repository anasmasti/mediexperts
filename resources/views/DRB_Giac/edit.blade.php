@extends('layouts.admin')

@section('content')
@section('content-wrapper')
<div class="col-sm-6">
    <h1 class="m-0 text-dark">Demande remboursement GIAC</h1>
  </div><!-- /.col -->
  <div class="col-sm-6">
    <ol class="breadcrumb float-sm-right">
      <li class="breadcrumb-item"><a href="/drb-gc">D.R GIAC</a></li>
      <li class="breadcrumb-item active">{{ $drb->n_drb }}</li>
    </ol>
  </div><!-- /.col -->


  {{-- GET "Type Mission" and "nrc entreprise"--}}
    @php
        $demande = \App\DemandeFinancement::select('clients.raisoci', 'clients.nrc_entrp', 'demande_financements.type_miss', 'demande_financements.n_df', 'demande_financements.gc_rattach')
            ->join('clients', 'demande_financements.nrc_e', 'clients.nrc_entrp')
            ->join('demande_remboursement_giacs', 'demande_financements.n_df', 'demande_remboursement_giacs.n_df')
            ->where('demande_remboursement_giacs.n_df', $drb->n_df)
            ->first();
    @endphp

@endsection

{{-- jquery scripts --}}
<script src={{ asset('js/jquery.js') }}></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
{{-- jquery scripts --}}

<!-- CARD -->
<div class="card card-dark">
  <!-- card-header -->
  {{-- <i class="fas fa-chevron-right"></i> --}}
  <div class="card-header">
    <h3 class="card-title card-h3">
        Modif. DRB GIAC >
        <a href="/detail-df/{{$demande['n_df']}}">
            {{ ucfirst($demande['type_miss']) }}
        </a>
        {{" > "}}
        <a href="/detail-cl/{{$demande['nrc_entrp']}}">
            {{ $demande['raisoci'] }}
        </a>
    </h3>
  </div>
  <!-- /.card-header -->
  <form role="form" action="/edit-drb-gc/{{$drb->n_drb}}" method="POST">
  <div class="card-body">
    <div class="row">
      {{ csrf_field() }}

      @if (session()->has('success'))
      <div class="alert alert-success alert-dismissible col-12">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        <h5><i class="icon fas fa-exclamation-triangle"></i>Succès</h5>
        <span>Modifié avec succès !</span>
      </div>
      @endif
      @if (count($errors) > 0)
        <div class="alert alert-danger alert-dismissible col-12">
          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
          <h5><i class="icon fas fa-exclamation-triangle"></i>Erreurs</h5>
          <span>{{$errors}}</span>
        </div>
      @endif

      {{-- Hidden input --}}
      <input type="text" name="giac" id="giac" value="{{$demande['gc_rattach']}}" hidden />
      <input type="text" name="type_miss" id="type_miss" value="{{$demande['type_miss']}}" hidden />

      {{--******************************* Moyen de paiement *******************************--}}
      <div class="form-group col-lg-3 col-sm-12">
      <label>Moyen de paiement</label>
        <div class="form-group">
          <div class="custom-control custom-radio">
            <input type="radio" name="moyen_fin" id="cheque" class="custom-control-input" {{ (mb_strtolower($drb->moyen_fin)=="chèque") ? 'checked' : '' }} value="chèque" />
            <label for="cheque" class="custom-control-label">Chèque</label>
          </div>
          <div class="custom-control custom-radio">
            <input type="radio" name="moyen_fin" id="virement" class="custom-control-input" {{ (mb_strtolower($drb->moyen_fin)=="virement") ? 'checked' : '' }} value="virement" />
            <label for="virement" class="custom-control-label">Ordre de virement</label>
          </div>
          <div class="custom-control custom-radio">
            <input type="radio" name="moyen_fin" id="effet" class="custom-control-input" {{ (mb_strtolower($drb->moyen_fin)=="effet") ? 'checked' : '' }} value="effet" />
            <label for="effet" class="custom-control-label">Effet</label>
          </div>
          <div class="custom-control custom-radio">
            <input type="radio" name="moyen_fin" id="no_fin" class="custom-control-input" {{ (mb_strtolower($drb->moyen_fin)=="non préparé") ? 'checked' : '' }} value="non préparé" />
            <label for="no_fin" class="custom-control-label">Pas encore</label>
          </div>
        </div>
      </div>

      <div class="form-group col-lg-3 col-sm-12">
        <label>Reçus de paiement</label>
        <div class="form-group">
          <div class="custom-control custom-radio">
            <input type="radio" name="avis_remise_fin" id="avis_opera" class="custom-control-input" {{ (mb_strtolower($drb->avis_remise_fin)=="remise") ? 'checked' : '' }} value="remise" />
            <label for="avis_opera" class="custom-control-label">Avis d'opération</label>
          </div>
          <div class="custom-control custom-radio">
            <input type="radio" name="avis_remise_fin" id="remise" class="custom-control-input" {{ (mb_strtolower($drb->avis_remise_fin)=="avis") ? 'checked' : '' }} value="avis" />
            <label for="remise" class="custom-control-label">Remise</label>
          </div>
          <div class="custom-control custom-radio">
            <input type="radio" name="avis_remise_fin" id="no_avis_remise_fin" class="custom-control-input" {{ (mb_strtolower($drb->avis_remise_fin)=="non préparé") ? 'checked' : '' }} value="non préparé" />
            <label for="no_avis_remise_fin" class="custom-control-label">Pas encore</label>
          </div>
          <hr />
          <div class="custom-control custom-checkbox">
            <input type="checkbox" name="relv_banc_entrp" id="relv_banc_entrp" class="custom-control-input" {{ (mb_strtolower($drb->relv_banc_entrp)=="préparé") ? 'checked' : '' }} value="préparé" >
            <label for="relv_banc_entrp" class="custom-control-label">Relevé entreprise</label>
          </div>
          <div class="custom-control custom-checkbox">
            <input type="checkbox" name="relv_banc_cab" id="relv_banc_cab" class="custom-control-input" {{ (mb_strtolower($drb->relv_banc_cab)=="préparé") ? 'checked' : '' }} value="préparé" >
            <label for="relv_banc_cab" class="custom-control-label">Relevé cabinet</label>
          </div>
        </div>
      </div>
      {{-- ./ FIN Moyen de paiement --}}

      <div class="form-group col-lg-3 col-sm-12">
      <label>Vérification</label>
        <div class="custom-control custom-checkbox">
          <input type="checkbox" name="fact_cab_entr" id="fact_cab_entr" class="custom-control-input" {{ (mb_strtolower($drb->fact_cab_entr)=="préparé") ? 'checked' : '' }} value="préparé" >
          <label for="fact_cab_entr" class="custom-control-label">Facture cabinet entreprise</label>
        </div>
        {{-- POUR GIAC AGRO --}}
        @if (mb_strtolower($drb->gc_rattach) == 'giac agroalimentaire' && mb_strtolower($drb->type_miss) == 'diagnostic stratégique')
          <div class="custom-control custom-checkbox">
            <input type="checkbox" name="drb_ds" id="drb_ds" class="custom-control-input" {{ (mb_strtolower($drb->drb_ds)=="préparé") ? 'checked' : '' }} value="préparé" >
            <label for="drb_ds" class="custom-control-label">Dem. rembours. DS</label>
          </div>
        @endif
        @if (mb_strtolower($drb->gc_rattach) == 'giac agroalimentaire' && mb_strtolower($drb->type_miss) == 'ingénierie de formation')
          <div class="custom-control custom-checkbox">
            <input type="checkbox" name="drb_if" id="drb_if" class="custom-control-input" {{ (mb_strtolower($drb->drb_if)=="préparé") ? 'checked' : '' }} value="préparé" >
            <label for="drb_if" class="custom-control-label">Dem. rembours. IF</label>
          </div>
        @endif
        @if (strpos($drb->gc_rattach, 'textile'))
          <div class="custom-control custom-checkbox">
            <input type="checkbox" name="frai_doss" id="frai_doss" class="custom-control-input" {{ (mb_strtolower($drb->frai_doss)=="préparé") ? 'checked' : '' }} value="préparé" >
            <label for="frai_doss" class="custom-control-label">Frais dossier (3000dh)</label>
          </div>
        @endif
        {{-- POUR GIAC AGRO --}}
      </div>


      <div class="form-group col-lg-3 col-sm-12">
        <label>Réf. moyen paiement</label>
        <input class="form-control {{ $errors->has('ref_fin') ? ' is-invalid' : '' }}" id="ref_fin" value="{{ $drb->ref_fin }}" type="text" name="ref_fin" min="0" maxlength="20" placeholder="référence">
        @if ($errors->has('ref_fin'))
          <span class="invalid-feedback" role="alert">
          {{ $errors->first('ref_fin') }}
          </span>
        @endif
      </div>

      <div class="form-group col-lg-3 col-sm-12">
        <label>Date paiem. entreprise</label>
        <input class="form-control {{ $errors->has('dt_pay_entrp') ? ' is-invalid' : '' }}" value="{{ $drb->dt_pay_entrp }}" type="text" name="dt_pay_entrp" onmouseover="(this.type='date')" id="dt_pay_entrp" onchange="checkDate()" placeholder="date payement">
        @if ($errors->has('dt_pay_entrp'))
          <span class="invalid-feedback" role="alert">
          {{ $errors->first('dt_pay_entrp') }}
          </span>
        @endif
      </div>

      <div class="form-group col-lg-3 col-sm-12">
        <label>Montant HT</label>
        <input class="form-control {{ $errors->has('montant_entrp_ht') ? ' is-invalid' : '' }}" value="{{ $drb->montant_entrp_ht }}" type="text" id="montant_entrp_ht" name="montant_entrp_ht" min="0" maxlength="15" onkeypress="return isNumberKey(event)" placeholder="Montant HT" readonly>
        @if ($errors->has('montant_entrp_ht'))
        <span class="invalid-feedback" role="alert">
          {{ $errors->first('montant_entrp_ht') }}
        </span>
        @endif
      </div>

      <div class="form-group col-lg-3 col-sm-12">
        <label>Montant paiement TTC</label>
        <input class="form-control {{ $errors->has('montant_entrp_ttc') ? ' is-invalid' : '' }}" value="{{ $drb->montant_entrp_ttc }}" type="text" id="montant_entrp_ttc" name="montant_entrp_ttc" min="0" maxlength="15" onkeypress="return isNumberKey(event)" placeholder="Montant TTC" readonly>
        @if ($errors->has('montant_entrp_ttc'))
          <span class="invalid-feedback" role="alert">
          {{ $errors->first('montant_entrp_ttc') }}
          </span>
        @endif
      </div>

      <div class="form-group col-12">{{--**************HR**************--}}<hr></div>

      <div class="form-group col-12">
        <label>Date dépôt dem. rembours.</label>
        <input class="form-control {{ $errors->has('dt_depo_drb') ? ' is-invalid' : '' }}" value="{{ $drb->dt_depo_drb }}" type="text" id="dt_depo_drb" name="dt_depo_drb" onmouseover="(this.type='date')" onchange="checkDate()" placeholder="date dépôt">
        @if ($errors->has('dt_depo_drb'))
          <span class="invalid-feedback" role="alert">
          {{ $errors->first('dt_depo_drb') }}
          </span>
        @endif
      </div>

      <div class="form-group col-12">{{--**************HR**************--}}<hr></div>


      <div class="form-group col-lg-3 col-sm-12">
        <label>Part GIAC</label>
        <div class="custom-control custom-radio">
          <input type="radio" name="part_giac" id="part_70" class="custom-control-input" {{ (mb_strtolower($drb->part_giac)=="70%") ? 'checked' : '' }} value="70%" disabled />
          <label for="part_70" class="custom-control-label">70%</label>
        </div>
        <div class="custom-control custom-radio">
          <input type="radio" name="part_giac" id="part_80" class="custom-control-input" {{ (mb_strtolower($drb->part_giac)=="80%") ? 'checked' : '' }} value="80%" disabled />
          <label for="part_80" class="custom-control-label">80%</label>
        </div>
      </div>


      {{--******************************* MOYEN REMBOURS. *******************************--}}
      <div class="form-group col-lg-3 col-sm-12">
        <label>Moyen de rembours.</label>
        <div class="form-group">
          <div class="custom-control custom-radio">
            <input type="radio" name="moyen_rb" id="cheque2" class="custom-control-input" {{ (mb_strtolower($drb->moyen_rb)=="chèque") ? 'checked' : '' }} value="chèque" />
            <label for="cheque2" class="custom-control-label">Chèque</label>
          </div>
          <div class="custom-control custom-radio">
            <input type="radio" name="moyen_rb" id="virement2" class="custom-control-input" {{ (mb_strtolower($drb->moyen_rb)=="virement") ? 'checked' : '' }} value="ordre de virement" />
            <label for="virement2" class="custom-control-label">Ordre de virement</label>
          </div>
          <div class="custom-control custom-radio">
            <input type="radio" name="moyen_rb" id="effet2" class="custom-control-input" {{ (mb_strtolower($drb->moyen_rb)=="effet") ? 'checked' : '' }} value="effet" />
            <label for="effet2" class="custom-control-label">Effet</label>
          </div>
          <div class="custom-control custom-radio">
            <input type="radio" name="moyen_rb" id="no_rb" class="custom-control-input" {{ (mb_strtolower($drb->moyen_rb)=="non préparé") ? 'checked' : '' }} value="non préparé" />
            <label for="no_rb" class="custom-control-label">Pas encore</label>
          </div>
        </div>
      </div>

      <div class="form-group col-lg-3 col-sm-12">
        <label>Ref. moyen rembours.</label>
        <input class="form-control {{ $errors->has('ref_rb') ? ' is-invalid' : '' }}" id="ref_rb" value="{{ $drb->ref_rb }}" type="text" name="ref_rb" min="0" maxlength="15" placeholder="ref.">
        @if ($errors->has('ref_rb'))
          <span class="invalid-feedback" role="alert">
          {{ $errors->first('ref_rb') }}
          </span>
        @endif
      </div>

      <div class="form-group col-lg-3 col-sm-12">
        <label>Date remboursement</label>
        <input class="form-control {{ $errors->has('dt_rb') ? ' is-invalid' : '' }}" value="{{ $drb->dt_rb }}" type="text" name="dt_rb" id="dt_rb" onchange="checkDate()" onmouseover="(this.type='date')" placeholder="date rembours.">
        @if ($errors->has('dt_rb'))
          <span class="invalid-feedback" role="alert">
          {{ $errors->first('dt_rb') }}
          </span>
        @endif
      </div>
      <div class="form-group col-lg-3 col-sm-12"><label>Montant remboursement</label><input class="form-control {{ $errors->has('montant_rb') ? ' is-invalid' : '' }}" value="{{ $drb->montant_rb }}" type="text" id="montant_rb" name="montant_rb" min="0" maxlength="15" onkeypress="return isNumberKey(event)" placeholder="Montant Rembours." readonly>
        @if ($errors->has('montant_rb'))
          <span class="invalid-feedback" role="alert">
          {{ $errors->first('montant_rb') }}
          </span>
        @endif
      </div>

      <div class="form-group col-12 text-center">
          <h4>État demande</h4>
          <div class="btn-group btn-group-toggle" data-toggle="buttons">
              <label class="btn {{ mb_strtolower($drb->etat)=='initié' ? 'btn-success active' : 'btn-warning' }}">
                Initié
                <i class="fas fa-battery-quarter"></i>
                <input type="radio" name="etat" id="option1" autocomplete="off" value="initié" {{ mb_strtolower($drb->etat)=='initié' ? 'checked' : '' }}>
              </label>
              <label class="btn {{ mb_strtolower($drb->etat)=='payé' ? 'btn-success active' : 'btn-warning' }}">
                Payé
                <i class="fas fa-dollar-sign"></i>
                <input type="radio" name="etat" id="option2" autocomplete="off" value="payé" {{ mb_strtolower($drb->etat)=='payé' ? 'checked' : '' }}>
              </label>
              <label class="btn {{ mb_strtolower($drb->etat)=='instruction dossier' ? 'btn-success active' : 'btn-warning' }}">
                Instruction dossier
                <i class="fas fa-hourglass-half"></i>
                <input type="radio" name="etat" id="option2" autocomplete="off" value="instruction dossier" {{ mb_strtolower($drb->etat)=='instruction dossier' ? 'checked' : '' }}>
              </label>
              <label class="btn {{ mb_strtolower($drb->etat)=='déposé' ? 'btn-success active' : 'btn-warning' }}">
                Déposé
                <i class="fas fa-folder-open"></i>
                <input type="radio" name="etat" id="option2" autocomplete="off" value="déposé" {{ mb_strtolower($drb->etat)=='déposé' ? 'checked' : '' }}>
              </label>
              <label class="btn {{ mb_strtolower($drb->etat)=='remboursé' ? 'btn-success active' : 'btn-warning' }}">
                Remboursé
                <i class="fas fa-check-double"></i>
                <input type="radio" name="etat" id="option3" autocomplete="off" value="remboursé" {{ mb_strtolower($drb->etat)=='remboursé' ? 'checked' : '' }}>
              </label>
          </div>
      </div>

      <div class="form-group col-12">
        <label>Commentaire</label>
        <textarea class="form-control" type="text" rows="4" name="commentaire" maxlength="1900" placeholder="Commentaire ..">{{ $drb->commentaire }}</textarea>
      </div>

    </div><!--./row-->
  </div><!--./card-body-->

  <div class="card-footer text-center">
    @if (count($df)!=0)
      <button class="btn buaj2" type="submit" id="add"><i class="fas fa-pen-square icon"></i>Modifier</button>
    @endif
    <a class="btn bua2" href="/drb-gc"><i class="fas fa-window-close icon"></i>Annuler</a>
  </div>

  </form>
</div><!-- ./CARD -->

<script>
  $(document).ready(function() {
    @if (mb_strtolower($drb->moyen_fin) == 'chèque' || mb_strtolower($drb->moyen_fin) == 'effet')
      $('label[for=remise], input#remise').fadeIn(100);
      $('label[for=avis_opera], input#avis_opera').fadeOut(100);
    @elseif (mb_strtolower($drb->moyen_fin) == 'virement')
      $('label[for=avis_opera], input#avis_opera').fadeIn(100);
      $('label[for=remise], input#remise').fadeOut(100);
    @endif

    $('#cheque, #effet').click(function() {
      $('label[for=remise], input#remise').fadeIn(100);
      $('label[for=avis_opera], input#avis_opera').fadeOut(100);
      $('#no_avis_remise_fin').prop('checked', true);
    });
    $('#virement').click(function() {
      $('label[for=avis_opera], input#avis_opera').fadeIn(100);
      $('label[for=remise], input#remise').fadeOut(100);
      $('#no_avis_remise_fin').prop('checked', true);
    });

    $('#no_fin').click(function() {
      $('#no_avis_remise_fin').prop('checked', true);
    });
  });

</script>



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


