@extends('layouts.admin')

@section('content')

        @foreach($client as $cl)
        @if ($cl->nrc_entrp==$plan->nrc_e)
            <?php $nrc = $cl->nrc_entrp ?>
            <?php $nom_c = $cl->raisoci ?>
       @endif
        @endforeach

        @foreach($interv as $inv)
        @if ($inv->id_interv==$plan->id_inv)
            <?php $id_i = $inv->id_interv ?>
            <?php $nom_i = $inv->nom ?>
        @endif
        @endforeach



@section('content-wrapper')
<div class="col-sm-6">
        <h1 class="m-0 text-dark">Action formation</h1>
    </div><!-- /.col -->
    <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="/PlanFormation">Action formation</a></li>
            <li class="breadcrumb-item active">N° {{ $plan->n_form }}</li>
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
        <h3 class="card-title">
            Modifier action N° {{ $plan->n_action }}
            @foreach ($plans as $pdf)
                @if ($pdf->id_plan == $plan->id_plan)
                    {{" - Réf. ". $pdf['refpdf']}}
                @endif
            @endforeach
        </h3>
    </div>
    <!-- /.card-header -->
    <form role="form" action="/edit-pf/{{ $plan->n_form }}" method="POST">
      <div class="card-body">
        <div class="row">
            {{ csrf_field() }}

            {{-- <div class="form-group col-lg-3 col-md-6 col-12"><label>N° plan</label><input class="form-control {{ $errors->has('n_form') ? 'is-invalid' : '' }}" name="n_form" type="text" min="0" maxlength="15" onkeypress="return isNumberKey(event)" value="{{$plan->n_form}}" placeholder="n° formation" >
                @if ($errors->has('n_form'))
                    <span class="invalid-feedback" role="alert">
                        {{ $errors->first('n_form') }}
                    </span>
               @endif
            </div> --}}
            @php
              $client = \App\Client::select('clients.nrc_entrp')
                ->join('plans', 'clients.nrc_entrp', 'plans.nrc_e')
                ->join('plan_formations', 'plans.id_plan', 'plan_formations.id_plan')
                ->where('plans.id_plan', $plan->id_plan)
                ->first();
            @endphp

            <input type="hidden" name="nrc_e" id="nrc_e" value="{{$client->nrc_entrp}}" readonly>


            <div class="form-group col-lg-6 col-md-6 col-12">
                <label for="id_plan">Réf. plan de formation </label>
                @if (count($plans)==0)
                <a class="btn bu-icon bu-sm btn-sm" href="/add-cl"><i class="fa fa-plus"></i></a> <!--button add-->
                @endif
                <select class="form-control {{ $errors->has('id_plan') ? ' is-invalid' : '' }}" name="id_plan" id="id_plan" value="{{old('id_plan')}}" readonly>
                <option selected disabled class="text-danger">*</option>
                @foreach ($plans as $pdf)
                    @if ($pdf->id_plan == $plan->id_plan)
                        <option selected value="{{$pdf->id_plan}}">{{$pdf['refpdf']}}</option>
                    @endif
                @endforeach
                </select>

                @if ($errors->has('id_plan'))
                    <span class="invalid-feedback" role="alert">
                    {{ $errors->first('id_plan') }}
                    </span>
                @endif
            </div>

            <div class="form-group col-lg-6 col-md-6 col-12">
                <label for="id_inv">Intervenant</label>
                <select class="form-control {{ $errors->has('id_inv') ? 'is-invalid' : '' }}" name="id_inv" id="id_inv" value="{{$plan->id_inv}}">
                    <option selected disabled>{{--vide--}}</option>
                    @foreach ($interv as $inv)
                        @if ($plan->id_inv == $inv->id_interv)
                        {{-- @if ($plan->id_inv == $inv->id_interv && mb_strtolower($inv->etat) == "occupé") --}}
                            <option selected value="{{$inv->id_interv}}">{{$inv->nom}} {{$inv->prenom}} @if (mb_strtolower($inv->etat) == "occupé") {{"(occupé pour cette mission)"}} @endif</option>
                        {{-- @elseif ($plan->id_inv != $inv->id_interv && mb_strtolower($inv->etat) == "occupé") --}}
                        {{-- @elseif ($plan->id_inv != $inv->id_interv)
                            <option disabled value="{{$inv->id_interv}}">{{$inv->nom}} {{$inv->prenom}} (occupé)</option> --}}
                        @else
                            <option value="{{$inv->id_interv}}">{{$inv->nom}} {{$inv->prenom}}</option>
                       @endif
                    @endforeach
                </select>
                @if ($errors->has('id_inv'))
                <span class="invalid-feedback" role="alert">
                    {{ $errors->first('id_inv') }}
                </span>
               @endif
            </div>


            {{-- <div class="form-group col-lg-3 col-md-6 col-12"><label>Réference</label><input class="form-control {{ $errors->has('refpdf') ? 'is-invalid' : '' }}" value="{{$plan->refpdf}}" type="text" name="refpdf" maxlength="30" placeholder="Réf." >
            @if ($errors->has('refpdf'))
                <span class="invalid-feedback" role="alert">
                    {{ $errors->first('refpdf') }}
                </span>
           @endif
            </div> --}}


        {{-- ***************** DOMAINES ***************** --}}
        <div class="form-group col-lg-6 col-md-6 col-12"><label>Domaines</label>
            <select class="form-control {{ $errors->has('id_dom') ? 'is-invalid' : '' }}" name="id_dom" id="id_dom">
                <option selected disabled><!--vide--></option>
                @foreach ($domain as $dom)
                    @if ($dom->id_domain == $plan->id_dom)
                        <option value="{{$dom->id_domain}}" selected>{{$dom->nom_domain}}</option>
                    @else
                        <option value="{{$dom->id_domain}}">{{$dom->nom_domain}} > {{$dom->ville}} > {{$dom->cout}}</option>
                    @endif
                @endforeach
            </select>
                @if ($errors->has('id_dom'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('id_dom') }}</strong>
                    </span>
               @endif
        </div>
        {{-- *********************** ./ DOMAINES *********************** --}}

        {{-- ***************** THEMES ***************** --}}
        <div class="form-group col-lg-6 col-md-6 col-12"><label>Thème</label>
            <select class="form-control {{ $errors->has('id_thm') ? 'is-invalid' : '' }}" name="id_thm" id="id_thm">
                @foreach ($theme as $thm)
                    @if ($thm->id_theme == $plan->id_thm)
                        <option value="{{$thm->id_theme}}" selected>{{$thm->nom_theme}}</option>
                    @else
                        <option value="{{$thm->id_theme}}">{{$thm->nom_theme}}</option>
                   @endif
                @endforeach
            </select>
            @if ($errors->has('id_thm'))
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('id_thm') }}</strong>
                </span>
            @endif
        </div>
        {{-- ***************** ./ THEMES ***************** --}}

        <div class="form-group col-lg-3 col-md-6 col-12 mb-5">
            
            <label>Nb. heures (durée total)</label>
            <input class="form-control {{ $errors->has('nb_heure') ? 'is-invalid' : '' }}" value="{{$plan->nb_heure}}" type="text" name="nb_heure" id="nb_heure" min="0" maxlength="15" onkeyup="CalcBdgJourn()" onkeypress="return isNumberKey(event)" placeholder="nb. jour" >
            @if ($errors->has('nb_heure'))
                <span class="invalid-feedback" role="alert">
                    {{ $errors->first('nb_heure') }}
                </span>
           @endif

           <label for="nb_dates">Nb. Dates</label>
           <input type="text" class="form-control {{ $errors->has('nb_dates') ? 'is-invalid' : '' }}" value="{{$plan->Nombre_Dates}}" name="nb_dates" id="nb_dates" onkeyup="CalcNbJour();CalcBdgJourn();ValidationNbDatesIfSameDates()" onclick="NbHeurValidation()" onkeypress="return isNumberKey(event)" placeholder="nb. dates">
           @if ($errors->has('nb_dates'))
           <span class="invalid-feedback" role="alert">
             {{$errors->first('nb_dates') }}
           </span>
           @endif
          <span class="text-danger" id="nb_dates_msg"></span>
          <div class="form-check">
            <input type="checkbox" name="same_dates" onchange="ValidationNbDatesIfSameDates()" value="1" {{$plan->Has_Same_Dates == 1 ? 'checked' : ''}} id="same_dates" class="form-check-input">
            <label for="grp_hasnt_same_dates" class="form-check-label">Groupes ayant différent date</label> <br>
            <label class="text-danger" id="sameDateError"></label>
          </div>
            
          <label>Nb. jours</label>
          <input class="form-control {{ $errors->has('nb_jour') ? 'is-invalid' : '' }}" value="{{$plan->nb_jour}}" type="text" name="nb_jour" id="nb_jour" min="0" maxlength="15" onkeyup="CalcBdgJourn()" onkeypress="return isNumberKey(event)" placeholder="nb. jour" >
          @if ($errors->has('nb_jour'))
            <span class="invalid-feedback" role="alert">
                  {{ $errors->first('nb_jour') }}
            </span>
          @endif
        </div>

        <div class="form-group col-lg-3 col-md-6 col-12"><label>Date début</label>
            <input class="form-control {{ $errors->has('dt_debut') ? 'is-invalid' : '' }}" value="{{$plan->dt_debut}}" type="date" name="dt_debut" onmouseover="(this.type='date')" id="" onchange="checkDate()" placeholder="Date début" >
            @if ($errors->has('dt_debut'))
                <span class="invalid-feedback" role="alert">
                    {{ $errors->first('dt_debut') }}
                </span>
           @endif
           <label>Pause</label>
           <div class="form-check">
             <input class="form-check-input" type="radio" value="1" name="pause">
             <label class="form-check-label">
               Oui
             </label>
           </div>
           <div class="form-check">
             <input class="form-check-input" type="radio" value="0" name="pause" checked>
             <label class="form-check-label">
               Non
             </label>
           </div>
        </div>

        <div class="form-group col-lg-3 col-md-6 col-12"><label>Date fin</label>
            <input class="form-control {{ $errors->has('dt_fin') ? 'is-invalid' : '' }}" value="{{$plan->dt_fin}}" type="date" name="dt_fin" onmouseover="(this.type='date')" id="" onchange="checkDate()" placeholder="Date fin" >
            @if ($errors->has('dt_fin'))
                <span class="invalid-feedback" role="alert">
                    {{ $errors->first('dt_fin') }}
                </span>
           @endif
        </div>

        {{-- DOCS --}}
        <div class="form-group col-lg-3 col-md-6 col-12">
            <label>Documents</label>
            <div class="form-group">
              <div class="custom-control custom-checkbox">
                  <input type="checkbox" name="model5" id="model5" class="custom-control-input" @if (mb_strtolower($plan->model5)=="préparé") checked @endif>
                  <label for="model5" class="custom-control-label">Modèles 5</label>
              </div>
              <div class="custom-control custom-checkbox">
                  <input type="checkbox" name="model3" id="model3" class="custom-control-input" @if (mb_strtolower($plan->model3)=="préparé") checked @endif>
                  <label for="model3" class="custom-control-label">Modèles 3</label>
              </div>
              <div class="custom-control custom-checkbox">
                  <input type="checkbox" name="f4" id="f4" class="custom-control-input" @if (mb_strtolower($plan->f4)=="préparé") checked @endif>
                  <label for="f4" class="custom-control-label">Formulaires 4</label>
              </div>
              <div class="custom-control custom-checkbox">
                  <input type="checkbox" name="fiche_eval" id="fiche_eval" class="custom-control-input" @if (mb_strtolower($plan->fiche_eval)=="préparé") checked @endif>
                  <label for="fiche_eval" class="custom-control-label">Fiches d'évaluation</label>
              </div>
              <div class="custom-control custom-checkbox">
                  <input type="checkbox" name="support_form" id="support_form" class="custom-control-input" @if (mb_strtolower($plan->support_form)=="préparé") checked @endif>
                  <label for="support_form" class="custom-control-label">Supports de formation</label>
              </div>
              <div class="custom-control custom-checkbox">
                  <input type="checkbox" name="cv_inv" id="cv_inv" class="custom-control-input" @if (mb_strtolower($plan->cv_inv)=="préparé") checked @endif>
                  <label for="cv_inv" class="custom-control-label">Les CV des intervenants</label>
              </div>
              <div class="custom-control custom-checkbox">
                  <input type="checkbox" name="avis_affich" id="avis_affich" class="custom-control-input" @if (mb_strtolower($plan->avis_affich)=="préparé") checked @endif>
                  <label for="avis_affich" class="custom-control-label">Avis d'affichage</label>
              </div>
            </div>
          </div>
          {{-- ./ DOCS --}}

        <div class="form-group col-lg-3 col-md-6 col-12"><label style="color: transparent">.</label><input class="form-control" type="text" style="background: transparent;border:none;" readonly>
        </div>

        <div class="form-group col-lg-3 col-md-6 col-12">
            <label for="type_form">Type formation</label>
            <?php $typeform =
                ["Intra-entreprise", "Inter-entreprises"];
            ?>
            <select class="form-control {{ $errors->has('type_form') ? 'is-invalid' : '' }}" id="type_form" name="type_form" value="{{$plan->type_form}}">
                <option selected disabled>{{--vide--}}</option>
                @foreach ($typeform as $typef)
                    @if ($plan->type_form == $typef)
                        <option selected value="{{$typef}}">{{$typef}}</option>
                    @else
                        <option value="{{$typef}}">{{$typef}}</option>
                   @endif
                @endforeach
            </select>
                @if ($errors->has('type_form'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('type_form') }}</strong>
                    </span>
               @endif
        </div>

        <div class="form-group col-lg-3 col-md-6 col-12"><label>Organisme</label>
            <select class="form-control {{ $errors->has('organisme') ? 'is-invalid' : '' }}" name="organisme" id="organisme">
                <option selected disabled>-</option>
                @foreach ($cabinet as $cab)
                    @if ($plan->organisme == $cab->raisoci)
                        <option selected value="{{$cab->raisoci}}">{{$cab->raisoci}}</option>
                    @else
                        <option value="{{$cab->raisoci}}">{{$cab->raisoci}}</option>
                   @endif
                @endforeach
            </select>
            @if ($errors->has('organisme'))
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('organisme') }}</strong>
                </span>
           @endif
        </div>

        <div class="form-group col-lg-3 col-md-6 col-12"><label>Lieu</label><input class="form-control {{ $errors->has('lieu') ? 'is-invalid' : '' }}" value="{{$plan->lieu}}" type="text" name="lieu" maxlength="30" placeholder="Lieu" >
        @if ($errors->has('lieu'))
            <span class="invalid-feedback" role="alert">
                {{ $errors->first('lieu') }}
            </span>
        @endif
        </div>

        <div class="form-group col-lg-3 col-md-6 col-12"><label>Nom responsable</label><input class="form-control {{ $errors->has('nom_resp') ? 'is-invalid' : '' }}" value="{{$plan->nom_resp}}" type="text" name="nom_resp" maxlength="30" placeholder="nom resp." >
        @if ($errors->has('nom_resp'))
            <span class="invalid-feedback" role="alert">
                {{ $errors->first('nom_resp') }}
            </span>
        @endif
        </div>

        <div class="form-group col-lg-3 col-md-6 col-12"><label>Nb. groupes</label><input class="form-control {{ $errors->has('nb_grp') ? 'is-invalid' : '' }}" value="{{$plan->nb_grp}}" type="text" name="nb_grp" id="nb_grp" min="0" maxlength="15" onkeypress="return isNumberKey(event)" placeholder="Nombre" >
        @if ($errors->has('nb_grp'))
            <span class="invalid-feedback" role="alert">
                {{ $errors->first('nb_grp') }}
            </span>
        @endif
        </div>

        <div class="form-group col-lg-3 col-md-6 col-12"><label>Nb. total participants</label>
            <input class="form-control {{ $errors->has('nb_partcp_total') ? 'is-invalid' : '' }}" value="{{$plan->nb_partcp_total}}" type="text" name="nb_partcp_total" min="0" maxlength="3" onkeypress="return isNumberKey(event)" placeholder="Nombre" >
            @if ($errors->has('nb_partcp_total'))
                <span class="invalid-feedback" role="alert">
                    {{ $errors->first('nb_partcp_total') }}
                </span>
           @endif
        </div>

        <div class="form-group col-lg-3 col-md-6 col-12"><label>Nb. Cadres</label>
            <input class="form-control {{ $errors->has('nb_cadre') ? 'is-invalid' : '' }}" value="{{$plan->nb_cadre}}" type="text" name="nb_cadre" min="0" maxlength="3" onkeypress="return isNumberKey(event)" placeholder="Nombre" >
            @if ($errors->has('nb_cadre'))
                <span class="invalid-feedback" role="alert">
                    {{ $errors->first('nb_cadre') }}
                </span>
           @endif
        </div>

        <div class="form-group col-lg-3 col-md-6 col-12"><label>Nb. employés</label>
            <input class="form-control {{ $errors->has('nb_employe') ? 'is-invalid' : '' }}" value="{{$plan->nb_employe}}" type="text" name="nb_employe" min="0" maxlength="3" onkeypress="return isNumberKey(event)" placeholder="Nombre" >
            @if ($errors->has('nb_employe'))
                <span class="invalid-feedback" role="alert">
                    {{ $errors->first('nb_employe') }}
                </span>
           @endif
        </div>

        <div class="form-group col-lg-3 col-md-6 col-12"><label>Nb. ouvriers</label>
            <input class="form-control {{ $errors->has('nb_ouvrier') ? 'is-invalid' : '' }}" value="{{$plan->nb_ouvrier}}" type="text" name="nb_ouvrier" min="0" maxlength="3" onkeypress="return isNumberKey(event)" placeholder="Nombre" >
            @if ($errors->has('nb_ouvrier'))
                <span class="invalid-feedback" role="alert">
                    {{ $errors->first('nb_ouvrier') }}
                </span>
           @endif
        </div>

        <div class="form-group col-lg-3 col-md-6 col-12"><label>Budget total (HT)</label>
            <input class="form-control {{ $errors->has('bdg_total') ? 'is-invalid' : '' }}" value="{{$plan->bdg_total}}" type="text" name="bdg_total" id="bdg_total" min="0" maxlength="5" onkeyup="CalcBdgJourn()" onkeypress="return isNumberKey(event)" placeholder="">
            @if ($errors->has('bdg_total'))
                <span class="invalid-feedback" role="alert">
                    {{ $errors->first('bdg_total') }}
                </span>
           @endif
        </div>

        <div class="form-group col-lg-3 col-md-6 col-12"><label>Budget en lettre (TTC)</label>
            <input class="form-control {{ $errors->has('bdg_letter') ? 'is-invalid' : '' }}" value="{{$plan->bdg_letter}}" type="text" name="bdg_letter" id="bdg_letter" min="0" maxlength="15" onkeyup="CalcBdgJourn()" onkeypress="return isNumberKey(event)" placeholder="budget en lettre" readonly>
            @if ($errors->has('bdg_letter'))
                <span class="invalid-feedback" role="alert">
                    {{ $errors->first('bdg_letter') }}
                </span>
           @endif
        </div>

        <div class="form-group col-lg-3 col-md-6 col-12"><label>Budget journalier</label>
            <input class="form-control {{ $errors->has('bdg_jour') ? 'is-invalid' : '' }}" value="{{$plan->bdg_jour}}" type="text" name="bdg_jour" id="bdg_jour" min="0" maxlength="5" onkeypress="return isNumberKey(event)" placeholder="0" readonly>
            @if ($errors->has('bdg_jour'))
                <span class="invalid-feedback" role="alert">
                    {{ $errors->first('bdg_jour') }}
                </span>
           @endif
        </div>

        <div class="form-group col-lg-3 col-md-6 col-12"><label>État</label>
            <select class="form-control {{ $errors->has('etat') ? 'is-invalid' : '' }}" name="etat" id="etat" value="{{$plan->etat}}">
              <?php $etat_plan = ['planifié', 'réalisé', 'annulé' , 'modifié']; ?>
              @foreach ($etat_plan as $etat)
                <option {{($plan->etat == $etat) ? 'selected' : ''}} value="{{$etat}}">{{ucfirst($etat)}}</option>
              @endforeach
            </select>
            @if ($errors->has('etat'))
                <span class="invalid-feedback" role="alert">
                    {{ $errors->first('etat') }}
                </span>
            @endif
        </div>
        <div class="form-group col-lg-3 col-sm-12">
        <label>Heure début</label>
        <div class='input-group date'>
          <input class="form-control timerpicker {{ $errors->has('hr_debut') ? 'is-invalid' : '' }}" value="{{$plan->hr_debut}}" type="text" id="hr_debut" name="hr_debut" />
          <div class="input-group-append" data-target="#timepicker" data-toggle="datetimepicker">
            <div class="input-group-text"><i class="far fa-clock"></i></div>
          </div>
        </div>
        @if ($errors->has('hr_debut'))
          <span class="invalid-feedback" role="alert">
            <strong>{{ $errors->first('hr_debut') }}</strong>
          </span>
        @endif
      </div>

      <div class="form-group col-lg-3 col-sm-12">
        <label>Heure fin</label>
        <div class='input-group date'>
          <input class="form-control timerpicker {{ $errors->has('hr_fin') ? 'is-invalid' : '' }}" value="{{$plan->hr_fin}}" type="text" id="hr_fin" name="hr_fin" />
          <div class="input-group-append" data-target="#timepicker" data-toggle="datetimepicker">
            <div class="input-group-text"><i class="far fa-clock"></i></div>
          </div>
        </div>
        @if ($errors->has('hr_fin'))
          <span class="invalid-feedback" role="alert">
            <strong>{{ $errors->first('hr_fin') }}</strong>
          </span>
        @endif
      </div>

        {{-- <div class="form-group col-lg-3 col-md-6 col-12">
            <label>Documents</label>
            <div class="form-check">
                <div class="form-check">
                    <input type="checkbox" name="fiche_pres" id="fiche_pres" class="form-check-input" value="Préparé">
                    <label for="fiche_pres" class="form-check-label">Fiche de présence</label>
                </div>

                <div class="form-check">
                    <input type="checkbox" name="synt_eval" id="synt_eval" class="form-check-input" value="Préparé">
                    <label for="synt_eval" class="form-check-label">Syntèse d'évaluation</label>
                </div>

                <div class="form-check">
                    <input type="checkbox" name="fiche_eval_indiv" id="fiche_eval_indiv" class="form-check-input" value="Préparé">
                    <label for="fiche_eval_indiv" class="form-check-label">Fiche d'évaluation individuel</label>
                </div>
            </div>
        </div> --}}

            <div class="form-group col-12"><label>Commentaire</label>
                <textarea class="form-control" type="text" rows="4" name="commentaire" maxlength="900" placeholder="Commentaire ..">{{$plan->commentaire}}</textarea>
            </div>

      </div><!--./row-->
    </div><!--./card-body-->


    <div class="card-footer  text-center">
            <button class="btn bu-add" type="submit" id="edit"><i class="fas fa-pen-square icon"></i>Modifier</button>
            <a class="btn bu-danger" href="/PlanFormation"><i class="fas fa-window-close icon"></i>Annuler</a>
    </div>

    </form>
</div><!-- ./CARD -->



{{-- DROP DOWN SCRIPT --}}
<script type="text/javascript">

$(document).ready(function() {

  // calls
  FindDomaineVilleClient('#nrc_e');
  FindThemesDomaine();

        //chercher domain dont la ville est la même du "Client" choisi dans "Plan de formation"
        $(document).on('change', '#nrc_e', function() {
            var nrc = $('#nrc_e').val();
            FindDomaineVilleClient(nrc);
        });

        //chercher le domaine associé au "Thème" choisi dans "Plan de formation"
        $(document).on('change', '#id_dom', function() {
            FindThemesDomaine();
        });

        //chercher l'organisme avec l'id de l'intervenant
        $(document).on('change', '#id_inv', function() {
            var idInv = $(this).val();

            $.ajax({
                type: 'get',
                url: '{!! URL::to('/findorganismeinterv') !!}',
                data: {'idInv': idInv},
                success: function(data) {
                    console.log('success !!');
                    console.log(data);

                    var fillDropDown = '';
                    // var fillDropDown = '<option selected disabled>Sélectionner l\'organisme</option>';
                    for (var i = 0; i < data.length; i++) {
                        fillDropDown += '<option value="' + data[i].raisoci + '">' + data[i].raisoci + '</option>';
                    }
                    $('#organisme').html(""); //clear input values
                    $('#organisme').append(fillDropDown);
                },
                error:function(msg) {
                    console.log('error getting data !!');
                }
            });
        });


    function FindDomaineVilleClient(nrc) {
        var nrc = $(nrc).val();
        $.ajax({
          type: 'get',
          url: '{!! URL::to('/finddomaindependvilleclient') !!}',
          data: {'nrc': nrc},
          success: function(data, client) {
              console.log('success !!', data.data, data.client);
              console.log();

              var fillDropDown = '<option selected disabled>Sélectionner le domaine</option>';
              for (var i = 0; i < data.data.length; i++) {
                //get current domaine id
                let idDomain = $('#id_dom').val();
                fillDropDown += `<option value="${data.data[i].id_domain}" ${(data.data[i].id_domain == idDomain) ? 'selected' : ''}>${data.data[i].nom_domain}</option>`;
              }
              if (data.data.length == 0) {
              fillDropDown = '<option selected>veuillez ajouter un domaine avec la ville du client</option>';
              }
              $('#lieu').val(data.client.raisoci);
              $('#nom_resp').val(data.client.nom_resp);
              $('#id_dom').html(""); //clear input values
              $('#id_dom').append(fillDropDown);
          },
          error: function(msg) {
              console.log('error getting data !!');
          }
        });
    }

    function FindThemesDomaine() {
      var idDomain = $('#id_dom').val();
      var idTheme = $('#id_thm').val();
      $.ajax({
        type: 'get',
        url: '{!! URL::to('/findthemesdomain') !!}',
        data: {'idDomain': idDomain},
        success: function(data) {
            console.log('success themesDomaine !!', data);

            var fillDropDown = '<option selected disabled>Sélectionner le thème</option>';
            for (var i = 0; i < data.length; i++) {
                fillDropDown += `<option value="${data[i].id_theme}" ${(data[i].id_theme == idTheme) ? 'selected' : ''}>${data[i].nom_theme}</option>`;
            }
            $('#bdg_jour').val(data[0].cout); //clear input values
            $('#id_thm').html(""); //clear input values
            $('#id_thm').append(fillDropDown);
        },
        error: function(msg) {
            console.log('error getting data !!');
        }
      });
    }

  }); //ready

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
    toastr.options.timeOut = 0;
    toastr.options.extendedTimeOut = 0;
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
    toastr.options.timeOut = 0;
    toastr.options.extendedTimeOut = 0;
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
    toastr.options.timeOut = 0;
    toastr.options.extendedTimeOut = 0;
    toastr.error("{{ Session::get("error") }}");
  });
</script>
@endif
{{-- TOASTR NOTIFICATIONS --}}



@endsection
