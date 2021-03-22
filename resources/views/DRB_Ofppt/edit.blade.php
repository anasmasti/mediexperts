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
    <h1 class="m-0 text-dark">Demande remboursement OFPPT</h1>
  </div><!-- /.col -->
  <div class="col-sm-6">
    <ol class="breadcrumb float-sm-right">
      <li class="breadcrumb-item"><a href="/drb-of">D.R OFPPT</a></li>
      <li class="breadcrumb-item active">N° {{ $drb->n_drb }}</li>
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
    <h3 class="card-title">Demande N° {{ $drb->n_drb }}</h3>
  </div>
  <!-- /.card-header -->
  <form role="form" action="/edit-drb-of/{{ $drb->n_drb }}/{{$nrc}}" method="POST">
  <div class="card-body">
    <div class="row">
      {{ csrf_field() }}

      {{-- <div class="form-group col-3"><label>N° Demande remboursement</label><input class="form-control" type="text" name="n_drb" value="{{ $drb->n_drb }}" min="0" maxlength="20" onkeypress="return isNumberKey(event)" placeholder="n° demande dembours." readonly></div> --}}

      <div class="form-group col-lg-9 col-sm-12">
        <label for="nrc_e">Entreprise</label>
        <select class="form-control {{ $errors->has('nrc_e') ? 'is-invalid' : '' }}" id="nrc_e" name="nrc_e">
          <option selected disabled>-entreprise</option>
          @foreach ($client as $cl)
            @if ($drb->nrc_e == $cl->nrc_entrp)
              <option value="{{$cl->nrc_entrp}}" selected>{{$cl->raisoci}}</option>
            @else
              <option value="{{$cl->nrc_entrp}}">{{$cl->raisoci}}</option>
            @endif
          @endforeach
        </select>
        @if ($errors->has('nrc_e'))
          <span class="invalid-feedback" role="alert">
            {{ $errors->first('nrc_e') }}
          </span>
        @endif
      </div>

      <div class="form-group col-lg-3 col-sm-12"><label>Année CSF</label>
        <input class="form-control {{ $errors->has('annee_csf') ? 'is-invalid' : '' }}" type="text" onmousemove="checkEtatRbOpt()" value="{{ $drb->annee_csf }}" name="annee_csf" min="4" maxlength="4" onkeypress="return isNumberKey(event)" placeholder="Année CSF" >
        @if ($errors->has('annee_csf'))
          <span class="invalid-feedback" role="alert">
            {{ $errors->first('annee_csf') }}
          </span>
        @endif
      </div>

      <div class="form-group col-lg-3 col-sm-12"><label>Date d'envoi</label>
        <input class="form-control {{ $errors->has('dt_envoi') ? 'is-invalid' : '' }}" value="{{ $drb->dt_envoi }}" type="text" onmousemove="checkEtatRbOpt()" name="dt_envoi" onmouseover="(this.type='date')" id="date-more" onchange="checkDate()" placeholder="date envoi" >
        @if ($errors->has('dt_envoi'))
          <span class="invalid-feedback" role="alert">
            {{ $errors->first('dt_envoi') }}
          </span>
        @endif
      </div>

      <div class="form-group col-lg-3 col-sm-12"><label>Date paiement entreprise</label>
        <input class="form-control {{ $errors->has('dt_pay_entrp') ? 'is-invalid' : '' }}" value="{{ $drb->dt_pay_entrp }}" type="text" onmousemove="checkEtatRbOpt()" name="dt_pay_entrp" onmouseover="(this.type='date')" id="date-more" onchange="checkDate()" placeholder="date payement" >
        @if ($errors->has('dt_pay_entrp'))
          <span class="invalid-feedback" role="alert">
            {{ $errors->first('dt_pay_entrp') }}
          </span>
        @endif
      </div>

      <div class="form-group col-lg-3 col-sm-12"><label>Montant paiement TTC</label>
        <input class="form-control {{ $errors->has('montant_entrp_ttc') ? 'is-invalid' : '' }}" value="{{ $drb->montant_entrp_ttc }}" type="text" onmousemove="checkEtatRbOpt()" name="montant_entrp_ttc" min="0" maxlength="15" onkeypress="return isNumberKey(event)" placeholder="Montant TTC" >
        @if ($errors->has('montant_entrp_ttc'))
          <span class="invalid-feedback" role="alert">
            {{ $errors->first('montant_entrp_ttc') }}
          </span>
        @endif
      </div>

      <div class="form-group col-lg-3 col-sm-12"><label>Montant HT</label>
        <input class="form-control {{ $errors->has('montant_entrp_ht') ? 'is-invalid' : '' }}" type="text" onmousemove="checkEtatRbOpt()" value="{{ $drb->montant_entrp_ht }}" name="montant_entrp_ht" min="0" maxlength="15" onkeypress="return isNumberKey(event)" placeholder="Montant HT" >
        @if ($errors->has('montant_entrp_ht'))
          <span class="invalid-feedback" role="alert">
            {{ $errors->first('montant_entrp_ht') }}
          </span>
        @endif
      </div>

      {{-- DOCS --}}
      <div class="form-group col-lg-4 col-sm-12">
      <label>Documents</label>
      <div class="form-group">
        <div class="custom-control custom-checkbox">
          <input type="checkbox" name="model5" id="model5" class="custom-control-input" {{ (mb_strtolower($drb->model5)=="préparé") ? 'checked' : '' }} value="préparé">
          <label for="model5" class="custom-control-label">Liste de présence (Modèle 5)</label>
        </div>
        <div class="custom-control custom-checkbox">
          <input type="checkbox" name="f4" id="f4" class="custom-control-input" {{ (mb_strtolower($drb->f4)=="préparé") ? 'checked' : '' }} value="préparé">
          <label for="f4" class="custom-control-label">Formulaire 4</label>
        </div>
        <div class="custom-control custom-checkbox">
          <input type="checkbox" name="fiche_eval_synth" id="fiche_eval_synth" class="custom-control-input" {{ (mb_strtolower($drb->fiche_eval_synth)=="préparé") ? 'checked' : '' }} value="préparé">
          <label for="fiche_eval_synth" class="custom-control-label">Fiche d'éval. synthètique</label>
        </div>
        <div class="custom-control custom-checkbox">
          <input type="checkbox" name="model6" id="model6" class="custom-control-input" {{ (mb_strtolower($drb->model6)=="préparé") ? 'checked' : '' }} value="préparé">
          <label for="model6" class="custom-control-label">Modèle 6</label>
        </div>
        <div class="custom-control custom-checkbox">
          <input type="checkbox" name="facture_PF" id="facture_PF" class="custom-control-input" {{ (mb_strtolower($drb->facture_PF)=="préparé") ? 'checked' : '' }} value="préparé">
          <label for="facture_PF" class="custom-control-label">Factures plan formation</label>
        </div>
      </div>
      </div>
      {{-- END DOCS --}}


      {{--******************************* Moyen de paiement *******************************--}}
      {{--*********************************************************************************--}}
      {{--*********************************************************************************--}}
      <div class="form-group col-lg-4 col-sm-12">
      <label>Moyen de paiement</label>
        <div class="form-group">
          <div class="custom-control custom-radio">
            <input type="radio" name="moyen_fin" id="chequeCheckFin" class="custom-control-input" {{ (mb_strtolower($drb->moyen_fin)=="chèque") ? 'checked' : '' }} value="chèque" />
            <label for="chequeCheckFin" class="custom-control-label">Chèque</label>
          </div>
          <div class="custom-control custom-radio">
            <input type="radio" name="moyen_fin" id="virmCheckFin" class="custom-control-input" {{ (mb_strtolower($drb->moyen_fin)=="ordre de virement") ? 'checked' : '' }} value="ordre de virement" />
            <label for="virmCheckFin" class="custom-control-label">Ordre de virement</label>
          </div>
          <div class="custom-control custom-radio">
            <input type="radio" name="moyen_fin" id="effetCheckFin" class="custom-control-input" {{ (mb_strtolower($drb->moyen_fin)=="effet") ? 'checked' : '' }} value="effet" />
            <label for="effetCheckFin" class="custom-control-label">Effet</label>
          </div>
          <div class="custom-control custom-radio">
            <input type="radio" name="moyen_fin" id="aucunCheckFin" class="custom-control-input" {{ (mb_strtolower($drb->moyen_fin)=="non préparé") ? 'checked' : '' }} value="non préparé" />
            <label for="aucunCheckFin" class="custom-control-label">Pas encore</label>
          </div>
        </div>
      </div>
      <div class="form-group col-lg-4 col-sm-12" id="chequeElementsFin">
      <label>Chèque</label>
        <div class="form-group">
          <div class="custom-control custom-checkbox">
            <input type="checkbox" name="remise_avis1_fin" id="cheque_remise_fin" class="custom-control-input" {{ (mb_strtolower($drb->remise_avis)=="préparé" && mb_strtolower($drb->moyen_fin)=="chèque") ? 'checked' : '' }} value="préparé" >
            <label for="cheque_remise_fin" class="custom-control-label">Remise</label>
          </div>
          <div class="custom-control custom-checkbox">
            <input type="checkbox" name="releve1_fin" id="cheque_releve_fin" class="custom-control-input" {{ (mb_strtolower($drb->releve)=="préparé" && mb_strtolower($drb->moyen_fin)=="chèque") ? 'checked' : '' }} value="préparé" >
            <label for="cheque_releve_fin" class="custom-control-label">Relevé</label>
          </div>
        </div>
      </div>
      <div class="form-group col-lg-4 col-sm-12" id="virmElementsFin">
      <label>Ordre de virement</label>
        <div class="form-group">
          <div class="custom-control custom-checkbox">
            <input type="checkbox" name="remise_avis2_fin" id="virm_avis_fin" class="custom-control-input" {{ (mb_strtolower($drb->remise_avis)=="préparé" && mb_strtolower($drb->moyen_fin)=="ordre de virement") ? 'checked' : '' }} value="préparé" >
            <label for="virm_avis_fin" class="custom-control-label">Avis d'opération</label>
          </div>
          <div class="custom-control custom-checkbox">
            <input type="checkbox" name="releve2_fin" id="virm_releve_fin" class="custom-control-input" {{ (mb_strtolower($drb->releve)=="préparé" && mb_strtolower($drb->moyen_fin)=="ordre de virement") ? 'checked' : '' }} value="préparé" >
            <label for="virm_releve_fin" class="custom-control-label">Relevé</label>
          </div>
        </div>
      </div>
      <div class="form-group col-lg-4 col-sm-12" id="effetElementsFin">
      <label>Effet</label>
        <div class="form-group">
          <div class="custom-control custom-checkbox">
            <input type="checkbox" name="remise_avis3_fin" id="effet_remise_fin" class="custom-control-input" {{ (mb_strtolower($drb->remise_avis)=="préparé" && mb_strtolower($drb->moyen_fin)=="effet") ? 'checked' : '' }} value="préparé" >
            <label for="effet_remise_fin" class="custom-control-label">Remise</label>
          </div>
          <div class="custom-control custom-checkbox">
            <input type="checkbox" name="releve3_fin" id="effet_releve_fin" class="custom-control-input" {{ (mb_strtolower($drb->releve)=="préparé" && mb_strtolower($drb->moyen_fin)=="effet") ? 'checked' : '' }} value="préparé" >
            <label for="effet_releve_fin" class="custom-control-label">Relevé</label>
          </div>
        </div>
      </div>
      <div class="form-group col-lg-4 col-sm-12" id="aucunElementsFin">{{--aucun--}}</div>
      {{-- ./ Moyen de paiement --}}


      <div class="form-group col-12">{{--**************HR**************--}}<hr></div>

      <div class="form-group col-lg-12 col-sm-12"><label>Date dépôt dem. rembours.</label>
        <input class="form-control {{ $errors->has('dt_depo_drb') ? 'is-invalid' : '' }}" value="{{ $drb->dt_depo_drb }}" type="text" onmousemove="checkEtatRbOpt()" name="dt_depo_drb" onmouseover="(this.type='date')" id="date-more" onchange="checkDate()" placeholder="date dépôt" >
        @if ($errors->has('dt_depo_drb'))
          <span class="invalid-feedback" role="alert">
            {{ $errors->first('dt_depo_drb') }}
          </span>
        @endif
      </div>

      <div class="form-group col-12">{{--**************HR**************--}}<hr></div>


      {{--***************************** Moyen de remboursement ****************************--}}
      {{--*********************************************************************************--}}
      {{--*********************************************************************************--}}
      <div class="form-group col-lg-4 col-sm-12">
      <label>Moyen de remboursement</label>
        <div class="form-group">
          <div class="custom-control custom-radio">
            <input type="radio" name="moyen_rb" id="chequeCheck" class="custom-control-input" {{ (mb_strtolower($drb->moyen_rb)=="chèque") ? 'checked' : '' }} value="chèque" />
            <label for="chequeCheck" class="custom-control-label">Chèque</label>
          </div>
          <div class="custom-control custom-radio">
            <input type="radio" name="moyen_rb" id="virmCheck" class="custom-control-input" {{ (mb_strtolower($drb->moyen_rb)=="ordre de virement") ? 'checked' : '' }} value="ordre de virement" />
            <label for="virmCheck" class="custom-control-label">Ordre de virement</label>
          </div>
          <div class="custom-control custom-radio">
            <input type="radio" name="moyen_rb" id="effetCheck" class="custom-control-input" {{ (mb_strtolower($drb->moyen_rb)=="effet") ? 'checked' : '' }} value="effet" />
            <label for="effetCheck" class="custom-control-label">Effet</label>
          </div>
          <div class="custom-control custom-radio">
            <input type="radio" name="moyen_rb" id="aucunCheck" class="custom-control-input" {{ (mb_strtolower($drb->moyen_rb)=="non préparé") ? 'checked' : '' }} value="non préparé" />
            <label for="aucunCheck" class="custom-control-label">Pas encore</label>
          </div>
        </div>
      </div>
      <div class="form-group col-lg-4 col-sm-12" id="chequeElements">
      <label>Chèque</label>
        <div class="form-group">
          <div class="custom-control custom-checkbox">
            <input type="checkbox" name="remise_avis1" id="cheque_remise" class="custom-control-input" {{ (mb_strtolower($drb->remise_avis)=="préparé" && mb_strtolower($drb->moyen_rb)=="chèque") ? 'checked' : '' }} value="préparé" >
            <label for="cheque_remise" class="custom-control-label">Remise</label>
          </div>
          <div class="custom-control custom-checkbox">
            <input type="checkbox" name="releve1" id="cheque_releve" class="custom-control-input" {{ (mb_strtolower($drb->releve)=="préparé" && mb_strtolower($drb->moyen_rb)=="chèque") ? 'checked' : '' }} value="préparé" >
            <label for="cheque_releve" class="custom-control-label">Relevé</label>
          </div>
        </div>
      </div>
      <div class="form-group col-lg-4 col-sm-12" id="virmElements">
      <label>Ordre de virement</label>
        <div class="form-group">
          <div class="custom-control custom-checkbox">
            <input type="checkbox" name="remise_avis2" id="virm_avis" class="custom-control-input" {{ (mb_strtolower($drb->remise_avis)=="préparé" && mb_strtolower($drb->moyen_rb)=="ordre de virement") ? 'checked' : '' }} value="préparé" >
            <label for="virm_avis" class="custom-control-label">Avis d'opération</label>
          </div>
          <div class="custom-control custom-checkbox">
            <input type="checkbox" name="releve2" id="virm_releve" class="custom-control-input" {{ (mb_strtolower($drb->releve)=="préparé" && mb_strtolower($drb->moyen_rb)=="ordre de virement") ? 'checked' : '' }} value="préparé" >
            <label for="virm_releve" class="custom-control-label">Relevé</label>
          </div>
        </div>
      </div>
      <div class="form-group col-lg-4 col-sm-12" id="effetElements">
      <label>Effet</label>
        <div class="form-group">
          <div class="custom-control custom-checkbox">
            <input type="checkbox" name="remise_avis3" id="effet_remise" class="custom-control-input" {{ (mb_strtolower($drb->remise_avis)=="préparé" && mb_strtolower($drb->moyen_rb)=="effet") ? 'checked' : '' }} value="préparé" >
            <label for="effet_remise" class="custom-control-label">Remise</label>
          </div>
          <div class="custom-control custom-checkbox">
            <input type="checkbox" name="releve3" id="effet_releve" class="custom-control-input" {{ (mb_strtolower($drb->releve)=="préparé" && mb_strtolower($drb->moyen_rb)=="effet") ? 'checked' : '' }} value="préparé" >
            <label for="effet_releve" class="custom-control-label">Relevé</label>
          </div>
        </div>
      </div>
      <div class="form-group col-lg-4 col-sm-12" id="aucunElements">{{--aucun--}}</div>
      {{-- ./ Moyen de remboursement --}}

      <div class="form-group col-12">{{--**************HR**************--}}</div>

      <div class="form-group col-lg-3 col-sm-12"><label>Date remboursement</label>
        <input class="form-control {{ $errors->has('dt_rb') ? 'is-invalid' : '' }}" value="{{ $drb->dt_rb }}" type="text" onmousemove="checkEtatRbOpt()" name="dt_rb" onmouseover="(this.type='date')" id="date-more" onchange="checkDate()" placeholder="date rembours." >
        @if ($errors->has('dt_rb'))
          <span class="invalid-feedback" role="alert">
            {{ $errors->first('dt_rb') }}
          </span>
        @endif
      </div>

      <div class="form-group col-lg-3 col-sm-12"><label>Montant remboursement</label><input class="form-control {{ $errors->has('montant_rb') ? 'is-invalid' : '' }}" value="{{ $drb->montant_rb }}" type="text" onmousemove="checkEtatRbOpt()" name="montant_rb" min="0" maxlength="15" onkeypress="return isNumberKey(event)" placeholder="Montant Rembours." >
        @if ($errors->has('montant_rb'))
          <span class="invalid-feedback" role="alert">
          {{ $errors->first('montant_rb') }}
          </span>
        @endif
      </div>



      {{-- Etat Demande Buttons --}}
      <div class="form-group col-lg-6 col-sm-12">
          <input id="etat" class="form-control {{ $errors->has('etat') ? ' is-invalid' : 'etat' }} etat-miss" value="initié" type="hidden" name="etat" maxlength="50" placeholder="état" readonly>
          @if ($errors->has('etat'))
          <span class="invalid-feedback" role="alert">
              {{ $errors->first('etat') }}
            </span>
            @endif
        </div>
        <div class="form-group col-12">
            <div class="callout callout-warning">
                <h5 class="text-bold text-center">État demande</h5>
          <p class="text-center etat-miss" id="etat-txt"></p>
          {{-- <p class="text-center etat-miss" id="etat-nb"></p> --}}
        </div>
    </div>
    <div class="form-group col-lg-4 col-sm-4">
        <a class="btn btn-warning col" id="buEtat1"><i class="fas fa-ellipsis-h"></i> Inité</a>
    </div>
    <div class="form-group col-lg-4 col-sm-4">
        <a class="btn btn-warning col" id="buEtat2"><i class="fas fa-hourglass-end"></i> En cours</a>
    </div>
    <div class="form-group col-lg-4 col-sm-4">
        <a class="btn btn-warning col" id="buEtat3"><i class="fas fa-check"></i> Remboursé</a>
    </div>
      {{-- / Etat Demande --}}

      <div class="form-group col-12"><label>Commentaire</label><textarea class="form-control" type="text" rows="4" name="commentaire" maxlength="900" placeholder="Commentaire ..">{{ $drb->commentaire }}</textarea></div>

    </div><!--./row-->
  </div><!--./card-body-->

  <div class="card-footer text-center">
    <button class="btn bu-add" type="submit" id="edit"><i class="fas fa-pen-square"></i>&nbsp;Modifier</button>
    <a class="btn btn-danger" href="/drb-of"><i class="fas fa-window-close"></i>&nbsp;Annuler</a>
  </div>

  </form>
</div><!-- ./CARD -->



<script type="text/javascript">

  $('#buEtat1').on('click', function() {
    $('#etat-txt').html("initié");
    $('#etat').val("initié");
  });
  $('#buEtat2').on('click', function() {
    $('#etat-txt').html("en cours");
    $('#etat').val("en cours");
  });
  $('#buEtat3').on('click', function() {
    $('#etat-txt').html("remboursé");
    $('#etat').val("remboursé");
  });

  function showChequeElements() {
    $('#chequeElements').css('display', 'inline-block');
    $('#cheque_remise').prop("checked", false);
    $('#cheque_releve').prop("checked", false);

    $('#effetElements').css('display', 'none');
    $('#effet_remise').prop("checked", false);
    $('#effet_releve').prop("checked", false);

    $('#virmElements').css('display', 'none');
    $('#virm_avis').prop("checked", false);
    $('#virm_releve').prop("checked", false);

    $('#aucunElements').css('display', 'none');
  }
  function showVirmElements() {
    $('#virmElements').css('display', 'inline-block');
    $('#virm_avis').prop("checked", false);
    $('#virm_releve').prop("checked", false);

    $('#chequeElements').css('display', 'none');
    $('#cheque_remise').prop("checked", false);
    $('#cheque_releve').prop("checked", false);

    $('#effetElements').css('display', 'none');
    $('#effet_remise').prop("checked", false);
    $('#effet_releve').prop("checked", false);

    $('#aucunElements').css('display', 'none');
  }
  function showEffetElements() {
    $('#effetElements').css('display', 'inline-block');
    $('#effet_remise').prop("checked", false);
    $('#effet_releve').prop("checked", false);

    $('#chequeElements').css('display', 'none');
    $('#cheque_remise').prop("checked", false);
    $('#cheque_releve').prop("checked", false);

    $('#virmElements').css('display', 'none');
    $('#virm_avis').prop("checked", false);
    $('#virm_releve').prop("checked", false);

    $('#aucunElements').css('display', 'none');
  }
  function hideElements() {
    $('#aucunElements').css('display', 'inline-block');
    $('#aucunCheck').prop("checked", true);

    $('#virmElements').css('display', 'none');
    $('#virm_avis').prop("checked", false);
    $('#virm_releve').prop("checked", false);

    $('#chequeElements').css('display', 'none');
    $('#cheque_remise').prop("checked", false);
    $('#cheque_releve').prop("checked", false);

    $('#effetElements').css('display', 'none');
    $('#effet_remise').prop("checked", false);
    $('#effet_releve').prop("checked", false);
  }
  // CLICK EVENTS
  $('#chequeCheck').click(function () {
    showChequeElements();
  });
  $('#virmCheck').click(function () {
    showVirmElements();
  });
  $('#effetCheck').click(function () {
    showEffetElements();
  });
  $('#aucunCheck').click(function () {
    hideElements();
  });
  //---------------------------------------------------------------
  //---------------------------------------------------------------
  //---------------------------------------------------------------
  function showChequeElementsFin() {
    $('#chequeElementsFin').css('display', 'inline-block');
    $('#cheque_remise_fin').prop("checked", false);
    $('#cheque_releve_fin').prop("checked", false);

    $('#virmElementsFin').css('display', 'none');
    $('#virm_avis_fin').prop("checked", false);
    $('#virm_releve_fin').prop("checked", false);

    $('#effetElementsFin').css('display', 'none');
    $('#effet_remise_fin').prop("checked", false);
    $('#effet_releve_fin').prop("checked", false);

    $('#aucunElementsFin').css('display', 'none');
  }
  function showVirmElementsFin() {
    $('#virmElementsFin').css('display', 'inline-block');
    $('#virm_avis_fin').prop("checked", false);
    $('#virm_releve_fin').prop("checked", false);

    $('#chequeElementsFin').css('display', 'none');
    $('#cheque_remise_fin').prop("checked", false);
    $('#cheque_releve_fin').prop("checked", false);

    $('#effetElementsFin').css('display', 'none');
    $('#effet_remise_fin').prop("checked", false);
    $('#effet_releve_fin').prop("checked", false);

    $('#aucunElementsFin').css('display', 'none');
  }
  function showEffetElementsFin() {
    $('#effetElementsFin').css('display', 'inline-block');
    $('#effet_remise_fin').prop("checked", false);
    $('#effet_releve_fin').prop("checked", false);

    $('#chequeElementsFin').css('display', 'none');
    $('#cheque_remise_fin').prop("checked", false);
    $('#cheque_releve_fin').prop("checked", false);

    $('#virmElementsFin').css('display', 'none');
    $('#virm_avis_fin').prop("checked", false);
    $('#virm_releve_fin').prop("checked", false);

    $('#aucunElementsFin').css('display', 'none');
  }
  function hideElementsFin() {
    $('#aucunElementsFin').css('display', 'inline-block');
    $('#aucunCheckFin').prop("checked", true);

    $('#virmElementsFin').css('display', 'none');
    $('#virm_avis_fin').prop("checked", false);
    $('#virm_releve_fin').prop("checked", false);

    $('#chequeElementsFin').css('display', 'none');
    $('#cheque_remise_fin').prop("checked", false);
    $('#cheque_releve_fin').prop("checked", false);

    $('#effetElementsFin').css('display', 'none');
    $('#effet_remise_fin').prop("checked", false);
    $('#effet_releve_fin').prop("checked", false);
  }
  // CLICK EVENTS
  $('#chequeCheckFin').click(function () {
    showChequeElementsFin();
  });
  $('#virmCheckFin').click(function () {
    showVirmElementsFin();
  });
  $('#effetCheckFin').click(function () {
    showEffetElementsFin();
  });
  $('#aucunCheckFin').click(function () {
    hideElementsFin();
  });
  // READY
  $(document).ready(function() {
    @if ($drb->moyen_rb=="chèque")
      showChequeElements();
      @if ($drb->remise_avis=="préparé")
        $('#cheque_remise').prop("checked", true);
      @endif
      @if ($drb->releve=="préparé")
        $('#cheque_releve').prop("checked", true);
      @endif
    @elseif ($drb->moyen_rb=="ordre de virement")
      showVirmElements();
      @if ($drb->remise_avis=="préparé")
        $('#virm_avis').prop("checked", true);
      @endif
      @if ($drb->releve=="préparé")
        $('#virm_releve').prop("checked", true);
      @endif
    @elseif ($drb->moyen_rb=="effet")
      showEffetElements();
      @if ($drb->remise_avis=="préparé")
        $('#effet_remise').prop("checked", true);
      @endif
      @if ($drb->releve=="préparé")
        $('#effet_releve').prop("checked", true);
      @endif
    @elseif ($drb->moyen_rb=="non préparé")
      hideElements();
    @endif
    //-----------------------
    @if ($drb->moyen_fin=="chèque")
      showChequeElementsFin();
      @if ($drb->remise_avis_fin=="préparé")
        $('#cheque_remise_fin').prop("checked", true);
      @endif
      @if ($drb->releve_fin=="préparé")
        $('#cheque_releve_fin').prop("checked", true);
      @endif
    @elseif ($drb->moyen_fin=="ordre de virement")
      showVirmElementsFin();
      @if ($drb->remise_avis_fin=="préparé")
        $('#virm_avis_fin').prop("checked", true);
      @endif
      @if ($drb->releve_fin=="préparé")
        $('#virm_releve_fin').prop("checked", true);
      @endif
    @elseif ($drb->moyen_fin=="effet")
      showEffetElementsFin();
      @if ($drb->remise_avis_fin=="préparé")
        $('#effet_remise_fin').prop("checked", true);
      @endif
      @if ($drb->releve_fin=="préparé")
        $('#effet_releve_fin').prop("checked", true);
      @endif
    @elseif ($drb->moyen_fin=="non préparé")
      hideElementsFin();
    @endif
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


