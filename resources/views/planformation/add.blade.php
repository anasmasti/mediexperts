@extends('layouts.admin')

@section('content')


@section('content-wrapper')
<div class="col-sm-6">
    <h1 class="m-0 text-dark">Ajout</h1>
  </div><!-- /.col -->
  <div class="col-sm-6">
    <ol class="breadcrumb float-sm-right">
      <li class="breadcrumb-item"><a href="/PlanFormation">Action plan formation</a></li>
      <li class="breadcrumb-item active">Ajout</li>
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
    <h3 class="card-title">Ajout action formation</h3>
  </div>
  <!-- /.card-header -->
  <form role="form" action="/add-pf" method="POST">
      {{ csrf_field() }}
  <div class="card-body">
    <div class="row">

      @if (count($errors) > 0)
        <div class="alert alert-danger alert-dismissible col-12">
          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
          <h5><i class="icon fas fa-exclamation-triangle"></i>Erreurs</h5>
          <span>Veuillez vérifier les champs</span>
          <span>{{$errors}}</span>
        </div>
      @endif


      <div class="modal" tabindex="-1" role="dialog" id="NbDateModal">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title"> Info  <i class="fas fa-info-circle"></i></h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <p>Nombre Dates Doit être père</p>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
            </div>
          </div>
        </div>
      </div>


      {{-- <div class="form-group col-lg-3 col-md-6 col-12"><label>N° plan</label>
        <input class="form-control {{ $errors->has('n_form') ? 'is-invalid' : '' }}" name="n_form" type="text" min="0" maxlength="15" value="{{old('n_form')}}" placeholder="n° formation" >
        @if ($errors->has('n_form'))
          <span class="invalid-feedback" role="alert">
            {{ $errors->first('n_form') }}
          </span>
        @endif
      </div> --}}

      <div class="form-group col-lg-6 col-12">
        <label for="id_plan">RÉF. Plan formation</label>
        @if (count($plans)==0)
          <a class="btn bu-icon bu-sm btn-sm" href="/add-cl"><i class="fa fa-plus"></i></a> <!--button add-->
        @endif
        <select class="form-control {{ $errors->has('id_plan') ? 'is-invalid' : '' }}" name="id_plan" id="id_plan" value="{{old('id_plan')}}">
          <option selected disabled class="text-danger">*</option>
          @foreach ($plans as $pdf)
            <option value="{{$pdf->id_plan}}">{{$pdf['refpdf']}}</option>
          @endforeach
        </select>
        @if (count($plans)==0)
          <div class="text-danger txt-sm">Veuillez d'abord ajouter un client</div>
        @endif

          @if ($errors->has('id_plan'))
            <span class="invalid-feedback" role="alert">
              {{ $errors->first('id_plan') }}
            </span>
          @endif
      </div>
      {{-- hidden input for : RC entrp --}}
      <input type="hidden" name="nrc" id="nrc" readonly>

      <div class="form-group col-lg-6 col-12">
        <label for="id_inv">Intervenant</label>
        @if (count($interv)==0)
          <a class="btn bu-icon bu-sm btn-sm" href="/add-inv"><i class="fa fa-plus"></i></a> {{--button add--}}
        @endif
        <select class="form-control {{ $errors->has('id_inv') ? 'is-invalid' : '' }}" name="id_inv" id="id_inv" value="{{old('id_inv')}}">
          <option selected disabled>{{--vide--}}</option>
          @php $nbIntervAvailable = 0; @endphp
          @foreach ($interv as $inv)
            {{-- @if (mb_strtolower($inv->etat) == "occupé") --}}
              {{-- <option disabled value="{{$inv->id_interv}}">{{$inv->nom}} {{$inv->prenom}} (occupé)</option> --}}
            {{-- @else --}}
              <option value="{{$inv->id_interv}}">{{$inv->nom}} {{$inv->prenom}}</option>
              @php $nbIntervAvailable += 1; @endphp
            {{-- @endif --}}
          @endforeach
        </select>
        @if (count($interv)==0)
        <div class="text-danger txt-sm">Veuillez d'abord ajouter un intervenant</div>
        @endif
        @if ($nbIntervAvailable == 0)
        <div class="text-danger txt-sm"><a href="/add-inv">
          Aucun intervenant n'est disponible. Souhaitez-vous l'ajouter ?</a></div>
        @endif

          @if ($errors->has('id_inv'))
          <span class="invalid-feedback" role="alert">
            {{ $errors->first('id_inv') }}
          </span>
          @endif
      </div>

      {{-- <div class="form-group col-lg-3 col-md-6 col-12"><label>Réference</label><input class="form-control {{ $errors->has('refpdf') ? 'is-invalid' : '' }}" value="{{old('refpdf')}}" type="text" name="refpdf" maxlength="30" placeholder="Réf." >
      @if ($errors->has('refpdf'))
        <span class="invalid-feedback" role="alert">
          {{ $errors->first('refpdf') }}
        </span>
      @endif
      </div> --}}


      {{-- ***************** DOMAINES ***************** --}}
      <div class="form-group col-lg-6 col-12"><label>Domaines</label>
        @if (count($domain)==0)
          <a class="btn bu-icon bu-sm btn-sm" href="/add-domain"><i class="fa fa-plus"></i></a>
        @endif
        <select class="form-control {{ $errors->has('id_dom') ? 'is-invalid' : '' }}" name="id_dom" id="id_dom">
          {{-- <option selected disabled>chargement..</option> --}}
          {{-- <option selected disabled><!--vide--></option>
          @foreach ($domain as $dom)
            <option value="{{$dom->id_domain}}">{{$dom->nom_domain}}</option>
          @endforeach --}}
        </select>
        @if (count($domain)==0)
          <div class="text-danger txt-sm">Veuillez d'abord ajouter un domaine</div>
        @endif
          @if ($errors->has('id_dom'))
            <span class="invalid-feedback" role="alert">
              <strong>{{ $errors->first('id_dom') }}</strong>
            </span>
          @endif
      </div>
      {{-- *********************** ./ DOMAINES *********************** --}}
      {{-- ***************** THEMES ***************** --}}
      <div class="form-group col-lg-6 col-12"><label>Thème</label>
        @if (count($theme)==0)
          <a class="btn bu-icon bu-sm btn-sm" href="/add-theme"><i class="fa fa-plus"></i></a> <!--button add-->
        @endif
        <select class="form-control {{ $errors->has('id_thm') ? 'is-invalid' : '' }}" name="id_thm" id="id_thm">
          {{-- <option selected disabled><!--vide--></option>
          @foreach ($theme as $th)
            <option value="{{$th->id_theme}}">{{$th->nom_theme}}</option>
          @endforeach --}}
        </select>
        @if (count($theme)==0)
          <div class="text-danger txt-sm">Veuillez associer un thème au domaine sélectionné</div>
        @endif
        @if ($errors->has('id_thm'))
          <span class="invalid-feedback" role="alert">
            <strong>{{ $errors->first('id_thm') }}</strong>
          </span>
        @endif
      </div>
      {{-- ***************** ./ THEMES ***************** --}}

      
      <div class="form-group col-lg-3 col-md-6 col-12 mb-5">

        <label>Nb. d’heures par jour </label>
          <input class="form-control bg-warning {{ $errors->has('nb_heure') ? 'is-invalid' : '' }}" type="text" name="nb_heure" id="nb_heure" min="0" maxlength="15" onkeyup="CalcBdgJourn();CalcNbJour()" onchange="NbHeurValidation()" onkeypress="return isNumberKey(event)" placeholder="nb. heurs" >
          @if ($errors->has('nb_heure'))
            <span class="invalid-feedback" role="alert">
              {{ $errors->first('nb_heure') }}
            </span>
          @endif

          <label for="nb_dates">Nb. Dates</label>
          <input type="text" class="form-control {{ $errors->has('nb_dates') ? 'is-invalid' : '' }}" name="nb_dates" id="nb_dates" onkeyup="CalcNbJour();CalcBdgJourn();ValidationNbDatesIfSameDates()" onclick="NbHeurValidation()" onkeypress="return isNumberKey(event)" placeholder="nb. dates">
          @if ($errors->has('nb_dates'))
          <span class="invalid-feedback" role="alert">
            {{$errors->first('nb_dates') }}
          </span>
          @endif
          <span class="text-danger" id="nb_dates_msg"></span>
          <div class="form-check">
            <input type="checkbox" value="1" onchange="ValidationNbDatesIfSameDates()" name="same_dates" id="same_dates" class="form-check-input">
            <label for="grp_hasnt_same_dates" class="form-check-label">Groupe ayant même dates</label> <br>
            <label class="text-danger" id="sameDateError"></label>
          </div>

        <label>Nb. de jours </label>
        <input class="form-control {{ $errors->has('nb_jour') ? 'is-invalid' : '' }}  " value="{{old('nb_jour')}}" type="text" onkeyup="CalcNbJour();CalcBdgJourn()" name="nb_jour" id="nb_jour" min="0" maxlength="15"  onkeypress="return isNumberKey(event)" placeholder="nb. jour">
        @if ($errors->has('nb_jour'))
          <span class="invalid-feedback" role="alert">
            {{ $errors->first('nb_jour') }}
          </span>
        @endif

      </div>
     

      <div class="form-group col-lg-3 col-md-6 col-12"><label>Date début</label>
        <input class="form-control {{ $errors->has('dt_debut') ? 'is-invalid' : '' }}" value="{{old('dt_debut')}}" type="text" name="dt_debut" onmouseover="(this.type='date')" id="" onchange="checkDate()" placeholder="Date début" >
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
        <input class="form-control {{ $errors->has('dt_fin') ? 'is-invalid' : '' }}" value="{{old('dt_fin')}}" type="text" name="dt_fin" onmouseover="(this.type='date')" id="" onchange="checkDate()" placeholder="Date fin" >
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
            <input type="checkbox" name="model5" id="model5" class="custom-control-input" value="préparé">
            <label for="model5" class="custom-control-label">Modèles 5</label>
          </div>
          <div class="custom-control custom-checkbox">
            <input type="checkbox" name="model3" id="model3" class="custom-control-input" value="préparé">
            <label for="model3" class="custom-control-label">Modèles 3</label>
          </div>
          <div class="custom-control custom-checkbox">
            <input type="checkbox" name="f4" id="f4" class="custom-control-input" value="préparé">
            <label for="f4" class="custom-control-label">Formulaires 4</label>
          </div>
          <div class="custom-control custom-checkbox">
            <input type="checkbox" name="fiche_eval" id="fiche_eval" class="custom-control-input" value="préparé">
            <label for="fiche_eval" class="custom-control-label">Fiches d'évaluation</label>
          </div>
          <div class="custom-control custom-checkbox">
            <input type="checkbox" name="support_form" id="support_form" class="custom-control-input" value="préparé">
            <label for="support_form" class="custom-control-label">Supports de formation</label>
          </div>
          <div class="custom-control custom-checkbox">
            <input type="checkbox" name="cv_inv" id="cv_inv" class="custom-control-input" value="préparé">
            <label for="cv_inv" class="custom-control-label">Les CV des intervenants</label>
          </div>
          <div class="custom-control custom-checkbox">
            <input type="checkbox" name="avis_affich" id="avis_affich" class="custom-control-input" value="préparé">
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
        <select class="form-control {{ $errors->has('type_form') ? 'is-invalid' : '' }}" id="type_form" name="type_form" value="{{old('type_form')}}">
          {{-- <option selected disabled>vide</option> --}}
          @foreach ($typeform as $typef)
            <option value="{{$typef}}">{{$typef}}</option>
          @endforeach
        </select>
          @if ($errors->has('type_form'))
            <span class="invalid-feedback" role="alert">
              <strong>{{ $errors->first('type_form') }}</strong>
            </span>
          @endif
      </div>

      {{-- <div class="form-group col-lg-3 col-md-6 col-12"><label>Organisme</label><input class="form-control {{ $errors->has('organisme') ? 'is-invalid' : '' }}" value="{{old('organisme')}}" type="text" name="organisme" maxlength="30" placeholder="Organisme" >
      @if ($errors->has('organisme'))
        <span class="invalid-feedback" role="alert">
          {{ $errors->first('organisme') }}
        </span>
      @endif
      </div> --}}

      <div class="form-group col-lg-3 col-md-6 col-12"><label>Organisme</label>
        <select class="form-control {{ $errors->has('organisme') ? 'is-invalid' : '' }}" name="organisme"  id="organisme" readonly >
          <option selected disabled>-</option>
          {{-- @foreach ($cabinet as $cab)
            <option value="{{$cab->raisoci}}">{{$cab->raisoci}}</option>
          @endforeach --}}
        </select>
        @if ($errors->has('organisme'))
          <span class="invalid-feedback" role="alert">
            <strong>{{ $errors->first('organisme') }}</strong>
          </span>
        @endif
      </div>

      <div class="form-group col-lg-3 col-md-6 col-12"><label>Lieu</label><input class="form-control {{ $errors->has('lieu') ? 'is-invalid' : '' }}" value="{{old('lieu')}}" type="text" id="lieu" name="lieu" maxlength="30" placeholder="Lieu" readonly>
      @if ($errors->has('lieu'))
        <span class="invalid-feedback" role="alert">
          {{ $errors->first('lieu') }}
        </span>
      @endif
      </div>

      <div class="form-group col-lg-3 col-md-6 col-12"><label>Nom responsable</label><input class="form-control {{ $errors->has('nom_resp') ? 'is-invalid' : '' }}" value="{{old('nom_resp')}}" type="text" id="nom_resp" name="nom_resp" maxlength="30" placeholder="nom resp." readonly>
      @if ($errors->has('nom_resp'))
        <span class="invalid-feedback" role="alert">
          {{ $errors->first('nom_resp') }}
        </span>
      @endif
      </div>

      <div class="form-group col-lg-3 col-md-6 col-12"><label>Nb. groupes</label><input class="form-control bg-warning {{ $errors->has('nb_grp') ? 'is-invalid' : '' }}" value="1" id="nb_grp" type="text" name="nb_grp" min="0" maxlength="15" onkeypress="return isNumberKey(event)" placeholder="Nombre" >
      @if ($errors->has('nb_grp'))
        <span class="invalid-feedback" role="alert">
          {{ $errors->first('nb_grp') }}
        </span>
      @endif
      </div>

      <div class="form-group col-lg-3 col-md-6 col-12"><label>Nb. total participants</label>
        <input class="form-control bg-warning {{ $errors->has('nb_partcp_total') ? 'is-invalid' : '' }}" value="5" type="text" name="nb_partcp_total" min="0" maxlength="3" onkeypress="return isNumberKey(event)" placeholder="Nombre" >
        @if ($errors->has('nb_partcp_total'))
          <span class="invalid-feedback" role="alert">
            {{ $errors->first('nb_partcp_total') }}
          </span>
        @endif
      </div>

      <div class="form-group col-lg-3 col-md-6 col-12"><label>Nb. Cadres</label>
        <input class="form-control {{ $errors->has('nb_cadre') ? 'is-invalid' : '' }}" value="{{old('nb_cadre')}}" type="text" name="nb_cadre" min="0" maxlength="3" onkeypress="return isNumberKey(event)" placeholder="Nombre" >
        @if ($errors->has('nb_cadre'))
          <span class="invalid-feedback" role="alert">
            {{ $errors->first('nb_cadre') }}
          </span>
        @endif
      </div>

      <div class="form-group col-lg-3 col-md-6 col-12"><label>Nb. employés</label>
        <input class="form-control {{ $errors->has('nb_employe') ? 'is-invalid' : '' }}" value="{{old('nb_employe')}}" type="text" name="nb_employe" min="0" maxlength="3" onkeypress="return isNumberKey(event)" placeholder="Nombre" >
        @if ($errors->has('nb_employe'))
          <span class="invalid-feedback" role="alert">
            {{ $errors->first('nb_employe') }}
          </span>
        @endif
      </div>

      <div class="form-group col-lg-3 col-md-6 col-12"><label>Nb. ouvriers</label>
        <input class="form-control {{ $errors->has('nb_ouvrier') ? 'is-invalid' : '' }}" value="{{old('nb_ouvrier')}}" type="text" name="nb_ouvrier" min="0" maxlength="3" onkeypress="return isNumberKey(event)" placeholder="Nombre" >
        @if ($errors->has('nb_ouvrier'))
          <span class="invalid-feedback" role="alert">
            {{ $errors->first('nb_ouvrier') }}
          </span>
        @endif
      </div>

      <div class="form-group col-lg-3 col-md-6 col-12"><label>Budget total (HT)</label>
        <input class="form-control {{ $errors->has('bdg_total') ? 'is-invalid' : '' }}" value="{{old('bdg_total')}}" type="text" name="bdg_total" id="bdg_total" min="0" maxlength="5" onkeyup="CalcBdgJourn()" onkeypress="return isNumberKey(event)" placeholder="">
        @if ($errors->has('bdg_total'))
          <span class="invalid-feedback" role="alert">
            {{ $errors->first('bdg_total') }}
          </span>
        @endif
      </div>

      <div class="form-group col-lg-3 col-md-6 col-12"><label>Budget en Lettre (TTC)</label>
        <input class="form-control {{ $errors->has('bdg_total') ? 'is-invalid' : '' }}" value="{{old('bdg_letter')}}" type="text" name="bdg_letter" id="bdg_letter" min="0" maxlength="15" onkeyup="CalcBdgJourn()" onkeypress="return isNumberKey(event)" placeholder="budget en lettre" readonly>
        @if ($errors->has('bdg_letter'))
          <span class="invalid-feedback" role="alert">
            {{ $errors->first('bdg_letter') }}
          </span>
        @endif
      </div>

      <div class="form-group col-lg-3 col-md-6 col-12"><label>Budget journalier</label>
        <input class="form-control {{ $errors->has('bdg_jour') ? 'is-invalid' : '' }}" value="{{old('bdg_jour')}}" type="text" name="bdg_jour" id="bdg_jour" min="0" maxlength="5" onkeypress="return isNumberKey(event)" placeholder="0" readonly>
        @if ($errors->has('bdg_jour'))
          <span class="invalid-feedback" role="alert">
            {{ $errors->first('bdg_jour') }}
          </span>
        @endif
      </div>

      <div class="form-group col-lg-3 col-md-6 col-12"><label>État</label>
        <select class="form-control {{ $errors->has('etat') ? 'is-invalid' : '' }}" name="etat" id="etat" value="{{old('etat')}}">
          <option selected disabled class="text-danger">*</option>
          @php $etat_plan = ['planifié', 'réalisé', 'annulé']; @endphp
          @foreach ($etat_plan as $etat)
            <option value="{{ $etat }}">{{ $etat }}</option>
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
          <input class="form-control {{ $errors->has('hr_debut') ? 'is-invalid' : '' }}" value="{{old('hr_debut') ? old('hr_debut') : "09:00"}}" type="time" name="hr_debut" />
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
          <input class="form-control timerpicker {{ $errors->has('hr_fin') ? 'is-invalid' : '' }}" value="{{old('hr_fin') ? old('hr_fin') : "16:00"}}" type="time" name="hr_fin" />
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

      <div class="form-group col-12"><label>Commentaire</label>
        <textarea class="form-control" type="text" rows="4" name="commentaire" maxlength="1000" placeholder="Commentaire ..">{{old('commentaire')}}</textarea>
      </div>

    </div><!--./row-->
  </div><!--./card-body-->


  <div class="card-footer text-center">
    @if (count($client) != 0 && $nbIntervAvailable >= 1)
      <button class="btn bu-add" type="submit" id="add"><i class="fas fa-plus-circle"></i> Ajouter </button>
    @endif
    <a class="btn bu-danger" href="/PlanFormation"><i class="fas fa-window-close"></i> Annuler</a>
  </div>
  </form>

</div><!-- ./CARD -->



{{-- DROP DOWN SCRIPT --}}
<script type="text/javascript">

var nbSelectedPers = 0;
var nbPers = 0;

// function CheckNbPers() {
//   let checkboxPers = document.getElementsByName('personnel');
//   let
// }

$(document).ready(function() {

    $(document).on('change', '#id_plan', function() {
    var idPlan = $(this).val();
    var nrc = null;

    $.ajax({
      type: 'get',
      url: '{!! URL::to('/find-client-plan') !!}',
      data: {'idPlan': idPlan},
      success: function(data) {
        console.log('success !!', data.nrc_entrp);
        nrc = data.nrc_entrp;
        $('#nrc').val(nrc);

        setTimeout(() => {
          $.ajax({
            type: 'get',
            url: '{!! URL::to('/finddomaindependvilleclient') !!}',
            data: {'nrc': nrc},
            success: function(data, client) {
                console.log('success !!', data.data, data.client);
                console.log();

                var fillDropDown = '<option selected disabled>Sélectionner le domaine</option>';
                for (var i = 0; i < data.data.length; i++) {
                fillDropDown += '<option value="'+ data.data[i].id_domain + '">' + data.data[i].nom_domain + '</option>';
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
        }, 1000);

      }, //success
      error: function(err) {
        console.log('error getting data !!', err);
      }
    });
  });

  //chercher domain dont la ville est la même du "Client" choisi dans "Plan de formation"
  $(document).on('change', '#nrc', function() {

  });

  //chercher le domaine associé au "Thème" choisi dans "Plan de formation"
  $(document).on('change', '#id_dom', function() {
    var idDomain = $(this).val();

    $.ajax({
      type: 'get',
      url: '{!! URL::to('/findthemesdomain') !!}',
      data: {'idDomain': idDomain},
      success: function(data) {
        console.log('success !!', data);
        var fillDropDown = '<option selected disabled>Sélectionner le thème</option>';
        for (var i = 0; i < data.length; i++) {
          fillDropDown += '<option value="'+ data[i].id_theme + '">' + data[i].nom_theme + '</option>';
        }
        $('#bdg_jour').val(data[0].cout); //clear input values
        $('#id_thm').html(""); //clear input values
        $('#id_thm').append(fillDropDown);
      },
      error: function(msg) {
        console.log('error getting data !!');
      }
    });
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
<style>

</style>



@endsection


