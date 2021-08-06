@extends('layouts.admin')

@section('content')

  @php
    $entrp = \App\Client::select('raisoci', 'nrc_entrp')->where('nrc_entrp', $df->nrc_e)->first();
  @endphp

@section('content-wrapper')
<div class="col-sm-6">
    <h1 class="m-0 text-dark">Demande financement</h1>
  </div><!-- /.col -->
  <div class="col-sm-6">
    <ol class="breadcrumb float-sm-right">
      <li class="breadcrumb-item"><a href="/df">Demande financement</a></li>
      <li class="breadcrumb-item active">{{$entrp['raisoci']}}</li>
    </ol>
  </div><!-- /.col -->
@endsection


{{-- jquery scripts --}}
<script src={{ asset('js/jquery.js') }}></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>

<div class="modal" tabindex="-1" role="dialog" id="msg_error_accord">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header bg-danger text-lite">
            <h5 class="modal-title">Il y a une erreur</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            Accord informations requises
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
          </div>
        </div>
      </div>
  </div>
{{-- jquery scripts --}}

<!-- CARD -->
<div class="card card-dark">
  <!-- card-header -->
  <div class="card-header">
    <h3 class="card-title">Modifier Demande {{ " > ".$df->type_miss." > ".$entrp['raisoci'] }}</h3>
  </div>
  <!-- /.card-header -->
  <form role="form" action="/edit-df/{{$df->n_df}}" method="POST">
  <div class="card-body" id="cardDf">
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

    {{-- <div class="form-group col-lg-3 col-md-6 col-sm-6 col-12"><label>N° demande financement</label>
      <input class="form-control {{ $errors->has('n_df') ? 'is-invalid' : '' }}" value="auto incrémenté.." type="text" name="n_df" id="n_df" min="0" maxlength="20" onkeypress="return isNumberKey(event)" placeholder="N° demande" readonly>
      @if ($errors->has('n_df'))
        <span class="invalid-feedback" role="alert">
        {{ $errors->first('n_df') }}
        </span>
      @endif
    </div> --}}

    <div class="form-group col-lg-9 col-12">
      <label>Entreprise</label>
      @if (count($client)==0)
        <a class="btn bu-icon bu-sm btn-sm" href="/add-cl"><i class="fa fa-plus"></i></a>
      @endif
      <select class="form-control {{ $errors->has('nrc_e') ? 'is-invalid' : '' }}" name="nrc_e" id="nrc_e" readonly>
        <option disabled selected></option>
        @foreach ($client as $cl)
          @if ($cl->nrc_entrp == $df->nrc_e)
            <option value="{{ $cl->nrc_entrp }}" selected>{{ $cl->raisoci }}</option>
          @else
            {{-- <option value="{{ $cl->nrc_entrp }}">{{ $cl->raisoci }}</option> --}}
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

    <div class="form-group col-lg-3 col-md-6 col-sm-6 col-12">
        <label for="gc_rattach">GIAC rattachement</label>
        <input type="text" class="form-control {{ $errors->has('gc_rattach') ? ' is-invalid' : '' }}" name="gc_rattach" id="gc_rattach" readonly>
        @if ($errors->has('gc_rattach'))
            <span class="invalid-feedback" role="alert">
                {{ $errors->first('gc_rattach') }}
            </span>
        @endif
    </div>
    {{-- @foreach ($client as $cl)
        <input id="gc_entrp" value="{{$cl->giac_rattach}}" type="hidden" name="gc_entrp" readonly>
    @endforeach --}}
    {{-- HIDDEN INPIT FOR GIAC --}}


    <div class="form-group col-lg-3 col-md-6 col-sm-6 col-12">
        <label>Type Mission</label>
        <select class="form-control {{ $errors->has('type_miss') ? ' is-invalid' : '' }}" name="type_miss" id="type_miss" onchange="checkEtat()">
          @php $typemission = ["diagnostic stratégique", "ingénierie de formation", "normal"]; @endphp
          @foreach ($typemission as $mission)
            @if (mb_strtolower($mission) == mb_strtolower($df->type_miss))
              <option value="{{$mission}}" selected>{{ucfirst($mission)}}</option>
            @elseif (mb_strtolower($mission) == mb_strtolower($df->type_miss))
              <option value="{{$mission}}" selected>{{ucfirst($mission)}}</option>
            @else
              <option value="{{$mission}}">{{ucfirst($mission)}}</option>
            @endif
          @endforeach
        </select>
          @if ($errors->has('type_miss'))
            <span class="invalid-feedback" role="alert">
              {{ $errors->first('type_miss') }}
            </span>
          @endif
    </div>
    <div class="form-group col-lg-3 col-md-6 col-sm-6 col-12">
        <label>Type Contrat</label>
        <select class="form-control" name="type_contrat" id="type_contrat" >
            @php
            $etatcontrats =['normal','tiers payant'];
            for ($i=0; $i < 2; $i++) { 
                if($etatcontrats[$i] == $df->type_contrat){
                    echo ' <option value="normal" selected>'.$etatcontrats[$i].'</option>';
                    $etatcontrats[$i] = 'n';
                }
            }
            if($etatcontrats[0] == 'n')
            {echo '<option value="tiers payant" >'.$etatcontrats[1].'</option>';}
            else {
                {echo '<option value="tiers payant" >'.$etatcontrats[0].'</option>';}
            }
         

             
            @endphp
           
        </select>
          @if ($errors->has('type_miss'))
            <span class="invalid-feedback" role="alert">
              {{ $errors->first('type_miss') }}
            </span>
          @endif
    </div>
    <div class="form-group col-lg-3 col-md-6 col-sm-6 col-12"><label>Année d'exercice</label>
        <input class="form-control {{ $errors->has('annee_exerc') ? ' is-invalid' : '' }}" value="{{$df->annee_exerc}}" type="text" name="annee_exerc" id="annee_exerc" min="4" maxlength="4" onkeypress="return isNumberKey(event)" placeholder="Année">
        @if ($errors->has('annee_exerc'))
            <span class="invalid-feedback" role="alert">
            {{ $errors->first('annee_exerc') }}
            </span>
        @endif
    </div>
    <div class="form-group col-lg-6 col-md-6 col-sm-6 col-12">
    <label>CSF</label>
        <div class="form-group">
            <div class="custom-control custom-checkbox">
                <input type="checkbox" name="d_eligib_csf_entrp" id="d_eligib_csf_entrp" class="custom-control-input" value="préparé" @if (mb_strtolower($df->d_eligib_csf_entrp)=="préparé") checked @endif>
                <label for="d_eligib_csf_entrp" class="custom-control-label">Éligibilité CSF entreprise</label>
            </div>
        </div>
    </div>


    <div class="form-group col-lg-3 col-md-6 col-sm-6 col-12"><label>Nombre d'intervenants</label>
        <input class="form-control {{ $errors->has('nb_interv') ? ' is-invalid' : '' }}" value="{{$df->nb_interv}}" type="text" name="nb_interv" id="nb_interv" min="0" maxlength="3" onkeypress="return isNumberKey(event)" placeholder="Nb. interv.">
        @if ($errors->has('nb_interv'))
            <span class="invalid-feedback" role="alert">
            {{ $errors->first('nb_interv') }}
            </span>
        @endif
    </div>
    <div class="form-group col-lg-3 col-md-6 col-sm-6 col-12"><label>Date demande</label>
        <input class="form-control {{ $errors->has('dt_df') ? ' is-invalid' : '' }}" value="{{$df->dt_df}}" type="text" name="dt_df" id="dt_df" onmouseover="(this.type='date')" placeholder="Date demande finan.">
        @if ($errors->has('dt_df'))
            <span class="invalid-feedback" role="alert">
            {{ $errors->first('dt_df') }}
            </span>
        @endif
    </div>
    <div class="form-group col-lg-3 col-md-6 col-sm-6 col-12"><label>Jour homme demandé</label>
        <input class="form-control {{ $errors->has('jr_hm_demande') ? ' is-invalid' : '' }}" value="{{$df->jr_hm_demande}}" type="text" name="jr_hm_demande" id="jr_hm_demande" min="0" maxlength="6" onkeypress="return isNumberKey(event)" placeholder="Nb jours">
        @if ($errors->has('jr_hm_demande'))
            <span class="invalid-feedback" role="alert">
            {{ $errors->first('jr_hm_demande') }}
            </span>
        @endif
    </div>
    <div class="form-group col-lg-3 col-md-6 col-sm-6 col-12"><label>Budget demandé</label>
        <input class="form-control {{ $errors->has('bdg_demande') ? ' is-invalid' : '' }}" value="{{$df->bdg_demande}}" type="text" name="bdg_demande" id="bdg_demande" min="0" maxlength="15" onkeypress="return isNumberKey(event)" placeholder="en DH (HT)">
        @if ($errors->has('bdg_demande'))
            <span class="invalid-feedback" role="alert">
            {{ $errors->first('bdg_demande') }}
            </span>
        @endif
    </div>

    <div class="form-group col-lg-3 col-md-6 col-sm-6 col-12">
      <label for="prc_cote_part_demande">Pourcentage quote part</label>
      <select class="form-control {{ $errors->has('prc_cote_part_demande') ? 'is-invalid' : '' }}" onchange="CalcQuotePart()"  name="prc_cote_part_demande" id="prc_cote_part_demande">
        @php $percent = ["20%", "30%"]; @endphp
            <option selected disabled><span class="text-danger">*</span></option>
            @foreach ($percent as $perc)
          @if ($df->prc_cote_part_demande == $perc)
            <option selected value="{{$perc}}">{{$perc}}</option>
          @else
            <option value="{{$perc}}">{{$perc}}</option>
          @endif
        @endforeach
      </select>
      @if ($errors->has('prc_cote_part_demande'))
        <span class="invalid-feedback" role="alert">
          {{ $errors->first('prc_cote_part_demande') }}
        </span>
      @endif
    </div>



    <div class="form-group col-12">{{--**************HR**************--}}<hr></div>

    <div class="form-group col-12">
        <h3 class="text-secondary">Dossier CSF</h3>
    </div>

    <div class="form-group col-12">
        <table class="table table-sm table-bordered">
            <thead class="thead-light">
                <tr id="tr_">
                    <th scope="col" style="width:50%">Dossier CSF</th>
                    <th scope="col" class="text-center" style="width:10%">Cabinet</th>
                    <th scope="col" class="text-center" style="width:10%">Client</th>
                    <th scope="col" class="text-center" style="width:10%">OFPPT</th>
                    <th scope="col" class="text-center" style="width:10%">Aucun</th>
                </tr>
            </thead>
            <tbody>
            <!--BEGIN OF : tr-->
            <tr id="tr_dem_csf">
                <td>Demande de CSF</td>
                <td>
                    <div class="custom-control custom-radio text-center">
                        <input type="radio" name="dem_csf" id="dem_csf_cab" class="custom-control-input" value="cabinet" @if (mb_strtolower($df->dem_csf)=="cabinet") checked @endif>
                        <label for="dem_csf_cab" class="custom-control-label">&nbsp;</label>
                    </div>
                </td>
                <td>
                    <div class="custom-control custom-radio text-center">
                        <input type="radio" name="dem_csf" id="dem_csf_cl" class="custom-control-input" value="client" @if (mb_strtolower($df->dem_csf)=="client") checked @endif>
                        <label for="dem_csf_cl" class="custom-control-label">&nbsp;</label>
                    </div>
                </td>
                <td>
                    <div class="custom-control custom-radio text-center">
                        <input type="radio" name="dem_csf" id="dem_csf_opt" class="custom-control-input" value="ofppt" @if (mb_strtolower($df->dem_csf)=="ofppt") checked @endif>
                        <label for="dem_csf_opt" class="custom-control-label">&nbsp;</label>
                    </div>
                </td>
                <td>
                    <div class="custom-control custom-radio text-center">
                        <input type="radio" name="dem_csf" id="dem_csf_none" class="custom-control-input" value="non préparé" @if (mb_strtolower($df->dem_csf)=="non préparé") checked @endif>
                        <label for="dem_csf_none" class="custom-control-label">&nbsp;</label>
                    </div>
                </td>
            </tr>
            <!--END OF : tr-->
            <!--BEGIN OF : tr-->
            <tr id="tr_f1">
                <td>Formulaire F1</td>
                <td>
                    <div class="custom-control custom-radio text-center">
                        <input type="radio" name="f1" id="f1_cab" class="custom-control-input" value="cabinet" @if (mb_strtolower($df->f1)=="cabinet") checked @endif>
                        <label for="f1_cab" class="custom-control-label">&nbsp;</label>
                    </div>
                </td>
                <td>
                    <div class="custom-control custom-radio text-center">
                        <input type="radio" name="f1" id="f1_cl" class="custom-control-input" value="client" @if (mb_strtolower($df->f1)=="client") checked @endif>
                        <label for="f1_cl" class="custom-control-label">&nbsp;</label>
                    </div>
                </td>
                <td>
                    <div class="custom-control custom-radio text-center">
                        <input type="radio" name="f1" id="f1_opt" class="custom-control-input" value="ofppt" @if (mb_strtolower($df->f1)=="ofppt") checked @endif>
                        <label for="f1_opt" class="custom-control-label">&nbsp;</label>
                    </div>
                </td>
                <td>
                    <div class="custom-control custom-radio text-center">
                        <input type="radio" name="f1" id="f1_none" class="custom-control-input" value="non préparé" @if (mb_strtolower($df->f1)=="non préparé") checked @endif>
                        <label for="f1_none" class="custom-control-label">&nbsp;</label>
                    </div>
                </td>
            </tr>
            <!--END OF : tr-->
            <!--BEGIN OF : tr-->
            <tr id="tr_d_statut">
                <td>Status</td>
                <td>
                    <div class="custom-control custom-radio text-center">
                        <input type="radio" name="d_statut" id="d_statut_cab" class="custom-control-input" value="cabinet" @if (mb_strtolower($df->d_statut)=="cabinet") checked @endif>
                        <label for="d_statut_cab" class="custom-control-label">&nbsp;</label>
                    </div>
                </td>
                <td>
                    <div class="custom-control custom-radio text-center">
                        <input type="radio" name="d_statut" id="d_statut_cl" class="custom-control-input" value="client" @if (mb_strtolower($df->d_statut)=="client") checked @endif>
                        <label for="d_statut_cl" class="custom-control-label">&nbsp;</label>
                    </div>
                </td>
                <td>
                    <div class="custom-control custom-radio text-center">
                        <input type="radio" name="d_statut" id="d_statut_opt" class="custom-control-input" value="ofppt" @if (mb_strtolower($df->d_statut)=="ofppt") checked @endif>
                        <label for="d_statut_opt" class="custom-control-label">&nbsp;</label>
                    </div>
                </td>
                <td>
                    <div class="custom-control custom-radio text-center">
                        <input type="radio" name="d_statut" id="d_statut_none" class="custom-control-input" value="non préparé" @if (mb_strtolower($df->d_statut)=="non préparé") checked @endif>
                        <label for="d_statut_none" class="custom-control-label">&nbsp;</label>
                    </div>
                </td>
            </tr>
            <!--END OF : tr-->
            <!--BEGIN OF : tr-->
            <tr id="tr_d_rc">
                <td>Registre de commerce</td>
                <td>
                    <div class="custom-control custom-radio text-center">
                        <input type="radio" name="d_rc" id="d_rc_cab" class="custom-control-input" value="cabinet" @if (mb_strtolower($df->d_rc)=="cabinet") checked @endif>
                        <label for="d_rc_cab" class="custom-control-label">&nbsp;</label>
                    </div>
                </td>
                <td>
                    <div class="custom-control custom-radio text-center">
                        <input type="radio" name="d_rc" id="d_rc_cl" class="custom-control-input" value="client" @if (mb_strtolower($df->d_rc)=="client") checked @endif>
                        <label for="d_rc_cl" class="custom-control-label">&nbsp;</label>
                    </div>
                </td>
                <td>
                    <div class="custom-control custom-radio text-center">
                        <input type="radio" name="d_rc" id="d_rc_opt" class="custom-control-input" value="ofppt" @if (mb_strtolower($df->d_rc)=="ofppt") checked @endif>
                        <label for="d_rc_opt" class="custom-control-label">&nbsp;</label>
                    </div>
                </td>
                <td>
                    <div class="custom-control custom-radio text-center">
                        <input type="radio" name="d_rc" id="d_rc_none" class="custom-control-input" value="non préparé" @if (mb_strtolower($df->d_rc)=="non préparé") checked @endif>
                        <label for="d_rc_none" class="custom-control-label">&nbsp;</label>
                    </div>
                </td>
            </tr>
            <!--END OF : tr-->
            <!--BEGIN OF : tr-->
            <tr id="tr_at_domic_banc">
                <td>Attestation de domiciliation bancaire du client</td>
                <td>
                    <div class="custom-control custom-radio text-center">
                        <input type="radio" name="at_domic_banc" id="at_domic_banc_cab" class="custom-control-input" value="cabinet" @if (mb_strtolower($df->at_domic_banc)=="cabinet") checked @endif>
                        <label for="at_domic_banc_cab" class="custom-control-label">&nbsp;</label>
                    </div>
                </td>
                <td>
                    <div class="custom-control custom-radio text-center">
                        <input type="radio" name="at_domic_banc" id="at_domic_banc_cl" class="custom-control-input" value="client" @if (mb_strtolower($df->at_domic_banc)=="client") checked @endif>
                        <label for="at_domic_banc_cl" class="custom-control-label">&nbsp;</label>
                    </div>
                </td>
                <td>
                    <div class="custom-control custom-radio text-center">
                        <input type="radio" name="at_domic_banc" id="at_domic_banc_opt" class="custom-control-input" value="ofppt" @if (mb_strtolower($df->at_domic_banc)=="ofppt") checked @endif>
                        <label for="at_domic_banc_opt" class="custom-control-label">&nbsp;</label>
                    </div>
                </td>
                <td>
                    <div class="custom-control custom-radio text-center">
                        <input type="radio" name="at_domic_banc" id="at_domic_banc_none" class="custom-control-input" value="non préparé" @if (mb_strtolower($df->at_domic_banc)=="non préparé") checked @endif>
                        <label for="at_domic_banc_none" class="custom-control-label">&nbsp;</label>
                    </div>
                </td>
            </tr>
            <!--END OF : tr-->

            <!--BEGIN OF : tr-->
            <tr id="tr_d_pouvoir">
                <td>PV des pouvoirs</td>
                <td>
                    <div class="custom-control custom-radio text-center">
                        <input type="radio" name="d_pouvoir" id="d_pouvoir_cab" class="custom-control-input" value="cabinet" @if (mb_strtolower($df->d_pouvoir)=="cabinet") checked @endif>
                        <label for="d_pouvoir_cab" class="custom-control-label">&nbsp;</label>
                    </div>
                </td>
                <td>
                    <div class="custom-control custom-radio text-center">
                        <input type="radio" name="d_pouvoir" id="d_pouvoir_cl" class="custom-control-input" value="client" @if (mb_strtolower($df->d_pouvoir)=="client") checked @endif>
                        <label for="d_pouvoir_cl" class="custom-control-label">&nbsp;</label>
                    </div>
                </td>
                <td>
                    <div class="custom-control custom-radio text-center">
                        <input type="radio" name="d_pouvoir" id="d_pouvoir_opt" class="custom-control-input" value="ofppt" @if (mb_strtolower($df->d_pouvoir)=="ofppt") checked @endif>
                        <label for="d_pouvoir_opt" class="custom-control-label">&nbsp;</label>
                    </div>
                </td>
                <td>
                    <div class="custom-control custom-radio text-center">
                        <input type="radio" name="d_pouvoir" id="d_pouvoir_none" class="custom-control-input" value="non préparé" @if (mb_strtolower($df->d_pouvoir)=="non préparé") checked @endif>
                        <label for="d_pouvoir_none" class="custom-control-label">&nbsp;</label>
                    </div>
                </td>
            </tr>
            <!--END OF : tr-->
        </tbody>
    </table>

    </div>

    <div class="form-group col-lg-6 col-md-6 col-sm-6 col-12">
        <label>Attes. CSF & Date retrait</label>
        <div class="input-group">
            <div class="input-group-prepend">
                <span class="input-group-text">
                    <input type="checkbox" name="at_csf_entrp" id="at_csf_entrp" value="préparé" @if (mb_strtolower($df->at_csf_entrp)=="préparé") checked @endif>
                </span>
            </div>
            <input class="form-control {{ $errors->has('dt_at_csf') ? 'is-invalid' : '' }}" value="{{$df->dt_at_csf}}" type="text" name="dt_at_csf" id="dt_at_csf" onmouseover="(this.type='date')" placeholder="Date réalisation">
        </div>
    </div>

    <div class="form-group col-lg-6 col-md-6 col-sm-6 col-12">
        <label for="bdg_pf">Budget Plan formation</label>
        <input class="form-control {{ $errors->has('bdg_pf') ? ' is-invalid' : '' }}" value="{{$df->bdg_pf}}" type="text" id="bdg_pf" name="bdg_pf" maxlength="50" placeholder="en DH" >
        @if ($errors->has('bdg_pf'))
            <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('bdg_pf') }}</strong>
            </span>
        @endif
    </div>

    <div class="form-group col-12">{{--**************HR**************--}}<hr></div>

    {{-- ************************************************************************************ --}}
    {{-- ***************           ********************************************************** --}}
    {{-- ***************    ****     ******************************************************** --}}
    {{-- ***************    ******   ******************************************************** --}}
    {{-- ***************    *****   ********************************************************* --}}
    {{-- ***************    ****    ********************************************************* --}}
    {{-- ***************    *******   ******************************************************* --}}
    {{-- ***************    *******   ******************************************************* --}}
    {{-- ***************            ********************************************************* --}}
    {{-- ************************************************************************************ --}}


    <div class="form-group col-12">
        <h3 class="text-secondary">Demande financement GIAC</h3>
    </div>
    <div class="form-group col-12">
    <table class="table table-sm table-bordered">
        <thead class="thead-light">
            <tr id="header">
                <th scope="col" style="width:50%">Dossier GIAC</th>
                <th scope="col" class="text-center" style="width:10%">Cabinet</th>
                <th scope="col" class="text-center" style="width:10%">Client</th>
                <th scope="col" class="text-center" style="width:10%">GIAC</th>
                <th scope="col" class="text-center" style="width:10%">Aucun</th>
            </tr>
        </thead>
        <tbody>
            <!--BEGIN OF : tr-->
            <tr id="tr_d_bulltin_adhes">
                <td>Bulletin d'adhésion / Ré-adhèsion (GIAC Tech.)</td>
                <td>
                    <div class="custom-control custom-radio text-center">
                        <input type="radio" name="d_bulltin_adhes" id="d_bulltin_adhes_cab" class="custom-control-input" value="cabinet" @if (mb_strtolower($df->d_bulltin_adhes)=="cabinet") checked @endif>
                        <label for="d_bulltin_adhes_cab" class="custom-control-label">&nbsp;</label>
                    </div>
                </td>
                <td>
                    <div class="custom-control custom-radio text-center">
                        <input type="radio" name="d_bulltin_adhes" id="d_bulltin_adhes_cl" class="custom-control-input" value="client" @if (mb_strtolower($df->d_bulltin_adhes)=="client") checked @endif>
                        <label for="d_bulltin_adhes_cl" class="custom-control-label">&nbsp;</label>
                    </div>
                </td>
                <td>
                    <div class="custom-control custom-radio text-center">
                        <input type="radio" name="d_bulltin_adhes" id="d_bulltin_adhes_gc" class="custom-control-input" value="giac" @if (mb_strtolower($df->d_bulltin_adhes)=="giac") checked @endif>
                        <label for="d_bulltin_adhes_gc" class="custom-control-label">&nbsp;</label>
                    </div>
                </td>
                <td>
                    <div class="custom-control custom-radio text-center">
                        <input type="radio" name="d_bulltin_adhes" id="d_bulltin_adhes_none" class="custom-control-input" value="non préparé" @if (mb_strtolower($df->d_bulltin_adhes)=="non préparé") checked @endif>
                        <label for="d_bulltin_adhes_none" class="custom-control-label">&nbsp;</label>
                    </div>
                </td>
            </tr>
            <!--END OF : tr-->

            <!--BEGIN OF : tr-->
            <tr id="tr_d_df_DS">
                <td>Demande financement DS</td>
                <td>
                    <div class="custom-control custom-radio text-center">
                        <input type="radio" name="d_df_DS" id="d_df_DS_cab" class="custom-control-input" value="cabinet" @if (mb_strtolower($df->d_df_DS)=="cabinet") checked @endif>
                        <label for="d_df_DS_cab" class="custom-control-label">&nbsp;</label>
                    </div>
                </td>
                <td>
                    <div class="custom-control custom-radio text-center">
                        <input type="radio" name="d_df_DS" id="d_df_DS_cl" class="custom-control-input" value="client" @if (mb_strtolower($df->d_df_DS)=="client") checked @endif>
                        <label for="d_df_DS_cl" class="custom-control-label">&nbsp;</label>
                    </div>
                </td>
                <td>
                    <div class="custom-control custom-radio text-center">
                        <input type="radio" name="d_df_DS" id="d_df_DS_gc" class="custom-control-input" value="giac" @if (mb_strtolower($df->d_df_DS)=="giac") checked @endif>
                        <label for="d_df_DS_gc" class="custom-control-label">&nbsp;</label>
                    </div>
                </td>
                <td>
                    <div class="custom-control custom-radio text-center">
                        <input type="radio" name="d_df_DS" id="d_df_DS_none" class="custom-control-input" value="non préparé" @if (mb_strtolower($df->d_df_DS)=="non préparé") checked @endif>
                        <label for="d_df_DS_none" class="custom-control-label">&nbsp;</label>
                    </div>
                </td>
            </tr>
            <!--END OF : tr-->

            <!--BEGIN OF : tr-->
            <tr id="tr_d_df_IF">
                <td>Demande financement IF</td>
                <td>
                    <div class="custom-control custom-radio text-center">
                        <input type="radio" name="d_df_IF" id="d_df_IF_cab" class="custom-control-input" value="cabinet" @if (mb_strtolower($df->d_df_IF)=="cabinet") checked @endif>
                        <label for="d_df_IF_cab" class="custom-control-label">&nbsp;</label>
                    </div>
                </td>
                <td>
                    <div class="custom-control custom-radio text-center">
                        <input type="radio" name="d_df_IF" id="d_df_IF_cl" class="custom-control-input" value="client" @if (mb_strtolower($df->d_df_IF)=="client") checked @endif>
                        <label for="d_df_IF_cl" class="custom-control-label">&nbsp;</label>
                    </div>
                </td>
                <td>
                    <div class="custom-control custom-radio text-center">
                        <input type="radio" name="d_df_IF" id="d_df_IF_gc" class="custom-control-input" value="giac" @if (mb_strtolower($df->d_df_IF)=="giac") checked @endif>
                        <label for="d_df_IF_gc" class="custom-control-label">&nbsp;</label>
                    </div>
                </td>
                <td>
                    <div class="custom-control custom-radio text-center">
                        <input type="radio" name="d_df_IF" id="d_df_IF_none" class="custom-control-input" value="non préparé" @if (mb_strtolower($df->d_df_IF)=="non préparé") checked @endif>
                        <label for="d_df_IF_none" class="custom-control-label">&nbsp;</label>
                    </div>
                </td>
            </tr>
            <!--END OF : tr-->
            <!--BEGIN OF : tr-->
            <tr id="tr_d_cheque">
                <td>Chèques</td>
                <td>
                    {{-- <div class="custom-control custom-radio text-center">
                        <input type="radio" name="d_cheque" id="d_cheque_cab" class="custom-control-input" value="cabinet" @if (mb_strtolower($df->d_cheque)=="cabinet") checked @endif>
                        <label for="d_cheque_cab" class="custom-control-label">&nbsp;</label>
                    </div> --}}
                </td>
                <td>
                    <div class="custom-control custom-radio text-center">
                        <input type="radio" name="d_cheque" id="d_cheque_cl" class="custom-control-input" value="client" @if (mb_strtolower($df->d_cheque)=="client") checked @endif>
                        <label for="d_cheque_cl" class="custom-control-label">&nbsp;</label>
                    </div>
                </td>
                <td>
                    <div class="custom-control custom-radio text-center">
                        <input type="radio" name="d_cheque" id="d_cheque_gc" class="custom-control-input" value="giac" @if (mb_strtolower($df->d_cheque)=="giac") checked @endif>
                        <label for="d_cheque_gc" class="custom-control-label">&nbsp;</label>
                    </div>
                </td>
                <td>
                    <div class="custom-control custom-radio text-center">
                        <input type="radio" name="d_cheque" id="d_cheque_none" class="custom-control-input" value="non préparé" @if (mb_strtolower($df->d_cheque)=="non préparé") checked @endif>
                        <label for="d_cheque_none" class="custom-control-label">&nbsp;</label>
                    </div>
                </td>
            </tr>
            <!--END OF : tr-->
            <!--BEGIN OF : tr-->
            <tr id="tr_f_renseign_entrp">
                <td>Fiche de renseignement de l'entreprise</td>
                <td>
                    <div class="custom-control custom-radio text-center">
                        <input type="radio" name="f_renseign_entrp" id="f_renseign_entrp_cab" class="custom-control-input" value="cabinet" @if (mb_strtolower($df->f_renseign_entrp)=="cabinet") checked @endif>
                        <label for="f_renseign_entrp_cab" class="custom-control-label">&nbsp;</label>
                    </div>
                </td>
                <td>
                    <div class="custom-control custom-radio text-center">
                        <input type="radio" name="f_renseign_entrp" id="f_renseign_entrp_cl" class="custom-control-input" value="client" @if (mb_strtolower($df->f_renseign_entrp)=="client") checked @endif>
                        <label for="f_renseign_entrp_cl" class="custom-control-label">&nbsp;</label>
                    </div>
                </td>
                <td>
                    <div class="custom-control custom-radio text-center">
                        <input type="radio" name="f_renseign_entrp" id="f_renseign_entrp_gc" class="custom-control-input" value="giac" @if (mb_strtolower($df->f_renseign_entrp)=="giac") checked @endif>
                        <label for="f_renseign_entrp_gc" class="custom-control-label">&nbsp;</label>
                    </div>
                </td>
                <td>
                    <div class="custom-control custom-radio text-center">
                        <input type="radio" name="f_renseign_entrp" id="f_renseign_entrp_none" class="custom-control-input" value="non préparé" @if (mb_strtolower($df->f_renseign_entrp)=="non préparé") checked @endif>
                        <label for="f_renseign_entrp_none" class="custom-control-label">&nbsp;</label>
                    </div>
                </td>
            </tr>
            <!--END OF : tr-->
            <!--BEGIN OF : tr-->
            <tr id="tr_d_honor">
                <td>Déclaration sur l'honneur</td>
                <td>
                    <div class="custom-control custom-radio text-center">
                        <input type="radio" name="d_honor" id="d_honor_cab" class="custom-control-input" value="cabinet" @if (mb_strtolower($df->d_honor)=="cabinet") checked @endif>
                        <label for="d_honor_cab" class="custom-control-label">&nbsp;</label>
                    </div>
                </td>
                <td>
                    <div class="custom-control custom-radio text-center">
                        <input type="radio" name="d_honor" id="d_honor_cl" class="custom-control-input" value="client" @if (mb_strtolower($df->d_honor)=="client") checked @endif>
                        <label for="d_honor_cl" class="custom-control-label">&nbsp;</label>
                    </div>
                </td>
                <td>
                    <div class="custom-control custom-radio text-center">
                        <input type="radio" name="d_honor" id="d_honor_gc" class="custom-control-input" value="giac" @if (mb_strtolower($df->d_honor)=="giac") checked @endif>
                        <label for="d_honor_gc" class="custom-control-label">&nbsp;</label>
                    </div>
                </td>
                <td>
                    <div class="custom-control custom-radio text-center">
                        <input type="radio" name="d_honor" id="d_honor_none" class="custom-control-input" value="non préparé" @if (mb_strtolower($df->d_honor)=="non préparé") checked @endif>
                        <label for="d_honor_none" class="custom-control-label">&nbsp;</label>
                    </div>
                </td>
            </tr>
            <!--END OF : tr-->
            <!--BEGIN OF : tr-->
            <tr id="tr_f_etude_DS">
                <td>Fiche d'étude DS</td>
                <td>
                    <div class="custom-control custom-radio text-center">
                        <input type="radio" name="f_etude_DS" id="f_etude_DS_cab" class="custom-control-input" value="cabinet" @if (mb_strtolower($df->f_etude_DS)=="cabinet") checked @endif>
                        <label for="f_etude_DS_cab" class="custom-control-label">&nbsp;</label>
                    </div>
                </td>
                <td>
                    <div class="custom-control custom-radio text-center">
                        <input type="radio" name="f_etude_DS" id="f_etude_DS_cl" class="custom-control-input" value="client" @if (mb_strtolower($df->f_etude_DS)=="client") checked @endif>
                        <label for="f_etude_DS_cl" class="custom-control-label">&nbsp;</label>
                    </div>
                </td>
                <td>
                    <div class="custom-control custom-radio text-center">
                        <input type="radio" name="f_etude_DS" id="f_etude_DS_gc" class="custom-control-input" value="giac" @if (mb_strtolower($df->f_etude_DS)=="giac") checked @endif>
                        <label for="f_etude_DS_gc" class="custom-control-label">&nbsp;</label>
                    </div>
                </td>
                <td>
                    <div class="custom-control custom-radio text-center">
                        <input type="radio" name="f_etude_DS" id="f_etude_DS_none" class="custom-control-input" value="non préparé" @if (mb_strtolower($df->f_etude_DS)=="non préparé") checked @endif>
                        <label for="f_etude_DS_none" class="custom-control-label">&nbsp;</label>
                    </div>
                </td>
            </tr>
            <!--END OF : tr-->
            <!--BEGIN OF : tr-->
            <tr id="tr_f_etude_IF">
                <td>Fiche d'étude IF</td>
                <td>
                    <div class="custom-control custom-radio text-center">
                        <input type="radio" name="f_etude_IF" id="f_etude_IF_cab" class="custom-control-input" value="cabinet" @if (mb_strtolower($df->f_etude_IF)=="cabinet") checked @endif>
                        <label for="f_etude_IF_cab" class="custom-control-label">&nbsp;</label>
                    </div>
                </td>
                <td>
                    <div class="custom-control custom-radio text-center">
                        <input type="radio" name="f_etude_IF" id="f_etude_IF_cl" class="custom-control-input" value="client" @if (mb_strtolower($df->f_etude_IF)=="client") checked @endif>
                        <label for="f_etude_IF_cl" class="custom-control-label">&nbsp;</label>
                    </div>
                </td>
                <td>
                    <div class="custom-control custom-radio text-center">
                        <input type="radio" name="f_etude_IF" id="f_etude_IF_gc" class="custom-control-input" value="giac" @if (mb_strtolower($df->f_etude_IF)=="giac") checked @endif>
                        <label for="f_etude_IF_gc" class="custom-control-label">&nbsp;</label>
                    </div>
                </td>
                <td>
                    <div class="custom-control custom-radio text-center">
                        <input type="radio" name="f_etude_IF" id="f_etude_IF_none" class="custom-control-input" value="non préparé" @if (mb_strtolower($df->f_etude_IF)=="non préparé") checked @endif>
                        <label for="f_etude_IF_none" class="custom-control-label">&nbsp;</label>
                    </div>
                </td>
            </tr>
            <!--END OF : tr-->
            <!--BEGIN OF : tr-->
            <tr id="tr_l_tierpay_DS">
                <td>Lettre de tiers-payant DS</td>
                <td>
                    <div class="custom-control custom-radio text-center">
                        <input type="radio" name="l_tierpay_DS" id="l_tierpay_DS_cab" class="custom-control-input" value="cabinet" @if (mb_strtolower($df->l_tierpay_DS)=="cabinet") checked @endif>
                        <label for="l_tierpay_DS_cab" class="custom-control-label">&nbsp;</label>
                    </div>
                </td>
                <td>
                    <div class="custom-control custom-radio text-center">
                        <input type="radio" name="l_tierpay_DS" id="l_tierpay_DS_cl" class="custom-control-input" value="client" @if (mb_strtolower($df->l_tierpay_DS)=="client") checked @endif>
                        <label for="l_tierpay_DS_cl" class="custom-control-label">&nbsp;</label>
                    </div>
                </td>
                <td>
                    <div class="custom-control custom-radio text-center">
                        <input type="radio" name="l_tierpay_DS" id="l_tierpay_DS_gc" class="custom-control-input" value="giac" @if (mb_strtolower($df->l_tierpay_DS)=="giac") checked @endif>
                        <label for="l_tierpay_DS_gc" class="custom-control-label">&nbsp;</label>
                    </div>
                </td>
                <td>
                    <div class="custom-control custom-radio text-center">
                        <input type="radio" name="l_tierpay_DS" id="l_tierpay_DS_none" class="custom-control-input" value="non préparé" @if (mb_strtolower($df->l_tierpay_DS)=="non préparé") checked @endif>
                        <label for="l_tierpay_DS_none" class="custom-control-label">&nbsp;</label>
                    </div>
                </td>
            </tr>
            <!--END OF : tr-->
            <!--BEGIN OF : tr-->
            <tr id="tr_l_tierpay_IF">
                <td>Lettre de tiers-payant IF</td>
                <td>
                    <div class="custom-control custom-radio text-center">
                        <input type="radio" name="l_tierpay_IF" id="l_tierpay_IF_cab" class="custom-control-input" value="cabinet" @if (mb_strtolower($df->l_tierpay_IF)=="cabinet") checked @endif>
                        <label for="l_tierpay_IF_cab" class="custom-control-label">&nbsp;</label>
                    </div>
                </td>
                <td>
                    <div class="custom-control custom-radio text-center">
                        <input type="radio" name="l_tierpay_IF" id="l_tierpay_IF_cl" class="custom-control-input" value="client" @if (mb_strtolower($df->l_tierpay_IF)=="client") checked @endif>
                        <label for="l_tierpay_IF_cl" class="custom-control-label">&nbsp;</label>
                    </div>
                </td>
                <td>
                    <div class="custom-control custom-radio text-center">
                        <input type="radio" name="l_tierpay_IF" id="l_tierpay_IF_gc" class="custom-control-input" value="giac" @if (mb_strtolower($df->l_tierpay_IF)=="giac") checked @endif>
                        <label for="l_tierpay_IF_gc" class="custom-control-label">&nbsp;</label>
                    </div>
                </td>
                <td>
                    <div class="custom-control custom-radio text-center">
                        <input type="radio" name="l_tierpay_IF" id="l_tierpay_IF_none" class="custom-control-input" value="non préparé" @if (mb_strtolower($df->l_tierpay_IF)=="non préparé") checked @endif>
                        <label for="l_tierpay_IF_none" class="custom-control-label">&nbsp;</label>
                    </div>
                </td>
            </tr>
            <!--END OF : tr-->

            <!--BEGIN OF : tr-->
            <tr id="tr_doss_jury">
                <td>Dossier Juridique (Statut, PV, RIB, RC)</td>
                <td>
                    <div class="custom-control custom-radio text-center">
                    </div>
                </td>
                <td>
                    <div class="custom-control custom-radio text-center">
                        <input type="radio" name="doss_jury" id="doss_jury_cl" class="custom-control-input" value="client" @if (mb_strtolower($df->doss_jury)=="client") checked @endif>
                        <label for="doss_jury_cl" class="custom-control-label">&nbsp;</label>
                    </div>
                </td>
                <td>
                    <div class="custom-control custom-radio text-center">
                        <input type="radio" name="doss_jury" id="doss_jury_gc" class="custom-control-input" value="giac" @if (mb_strtolower($df->doss_jury)=="giac") checked @endif>
                        <label for="doss_jury_gc" class="custom-control-label">&nbsp;</label>
                    </div>
                </td>
                <td>
                    <div class="custom-control custom-radio text-center">
                        <input type="radio" name="doss_jury" id="doss_jury_none" class="custom-control-input" value="non préparé" @if (mb_strtolower($df->doss_jury)=="non préparé") checked @endif>
                        <label for="doss_jury_none" class="custom-control-label">&nbsp;</label>
                    </div>
                </td>
            </tr>
            <!--END OF : tr-->
            <!--BEGIN OF : tr-->
            <tr id="tr_at_csf_doc">
                <td>Attestation CSF</td>
                <td>
                    <div class="custom-control custom-radio text-center">
                        <input type="radio" name="at_csf_doc" id="at_csf_doc_cab" class="custom-control-input" value="cabinet" @if (mb_strtolower($df->at_csf_doc)=="cabinet") checked @endif>
                        <label for="at_csf_doc_cab" class="custom-control-label">&nbsp;</label>
                    </div>
                </td>
                <td>
                    <div class="custom-control custom-radio text-center">
                        <input type="radio" name="at_csf_doc" id="at_csf_doc_cl" class="custom-control-input" value="client" @if (mb_strtolower($df->at_csf_doc)=="client") checked @endif>
                        <label for="at_csf_doc_cl" class="custom-control-label">&nbsp;</label>
                    </div>
                </td>
                <td>
                    <div class="custom-control custom-radio text-center">
                        <input type="radio" name="at_csf_doc" id="at_csf_doc_gc" class="custom-control-input" value="giac" @if (mb_strtolower($df->at_csf_doc)=="giac") checked @endif>
                        <label for="at_csf_doc_gc" class="custom-control-label">&nbsp;</label>
                    </div>
                </td>
                <td>
                    <div class="custom-control custom-radio text-center">
                        <input type="radio" name="at_csf_doc" id="at_csf_doc_none" class="custom-control-input" value="non préparé" @if (mb_strtolower($df->at_csf_doc)=="non préparé") checked @endif>
                        <label for="at_csf_doc_none" class="custom-control-label">&nbsp;</label>
                    </div>
                </td>
            </tr>
            <!--END OF : tr-->

            <!--BEGIN OF : tr-->
            <tr id="td_d_model6_g6">
                <td colspan="5">
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" name="d_model6_n_1" id="d_model6_n_1" class="custom-control-input" value="préparé" @if (mb_strtolower($df->d_model6_n_1)=="préparé") checked @endif>
                        <label for="d_model6_n_1" class="custom-control-label">Modèle 6 (N-1)</label>
                    </div>
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" name="d_model6_n_2" id="d_model6_n_2" class="custom-control-input" value="préparé" @if (mb_strtolower($df->d_model6_n_2)=="préparé") checked @endif>
                        <label for="d_model6_n_2" class="custom-control-label">Modèle 6 (N-2)</label>
                    </div>

                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" name="d_honor_act_form" id="d_honor_act_form" class="custom-control-input" value="préparé" @if (mb_strtolower($df->d_honor_act_form)=="préparé") checked @endif>
                        <label for="d_honor_act_form" class="custom-control-label">Déclaration sur l'honneur de réalisation actions de formation (G6)</label>
                    </div>
                </td>
            </tr>
            <!--END OF : tr-->

            </tbody>
        </table>
    </div>

<div class="form-group col-12">
    <table class="table table-sm table-bordered">
        <thead class="thead-light">
            <tr id="tr_">
                <th scope="col" style="width:50%">Cabinet documents</th>
                <th scope="col" class="text-center" style="width:10%">Cabinet</th>
                <th scope="col" class="text-center" style="width:10%">GIAC</th>
                <th scope="col" class="text-center" style="width:10%">Aucun</th>
            </tr>
        </thead>
        <tbody>

            <!--BEGIN OF : tr-->
            <tr id="tr_at_qual_cab">
                <td>Attestation qualification cabinet</td>
                <td>
                    <div class="custom-control custom-radio text-center">
                        <input type="radio" name="at_qual_cab" id="at_qual_cab_cab" class="custom-control-input" value="cabinet" @if (mb_strtolower($df->at_qual_cab)=="cabinet") checked @endif>
                        <label for="at_qual_cab_cab" class="custom-control-label">&nbsp;</label>
                    </div>
                </td>
                <td>
                    <div class="custom-control custom-radio text-center">
                        <input type="radio" name="at_qual_cab" id="at_qual_cab_gc" class="custom-control-input" value="giac" @if (mb_strtolower($df->at_qual_cab)=="giac") checked @endif>
                        <label for="at_qual_cab_gc" class="custom-control-label">&nbsp;</label>
                    </div>
                </td>
                <td>
                    <div class="custom-control custom-radio text-center">
                        <input type="radio" name="at_qual_cab" id="at_qual_cab_none" class="custom-control-input" value="non préparé" @if (mb_strtolower($df->at_qual_cab)=="non préparé") checked @endif>
                        <label for="at_qual_cab_none" class="custom-control-label">&nbsp;</label>
                    </div>
                </td>
            </tr>
            <!--END OF : tr-->
            <!--BEGIN OF : tr-->
            <tr id="tr_f_renseign_cab">
                <td>Fiche de renseignement du cabinet</td>
                <td>
                    <div class="custom-control custom-radio text-center">
                        <input type="radio" name="f_renseign_cab" id="f_renseign_cab_cab" class="custom-control-input" value="cabinet" @if (mb_strtolower($df->f_renseign_cab)=="cabinet") checked @endif>
                        <label for="f_renseign_cab_cab" class="custom-control-label">&nbsp;</label>
                    </div>
                </td>
                <td>
                    <div class="custom-control custom-radio text-center">
                        <input type="radio" name="f_renseign_cab" id="f_renseign_cab_gc" class="custom-control-input" value="giac" @if (mb_strtolower($df->f_renseign_cab)=="giac") checked @endif>
                        <label for="f_renseign_cab_gc" class="custom-control-label">&nbsp;</label>
                    </div>
                </td>
                <td>
                    <div class="custom-control custom-radio text-center">
                        <input type="radio" name="f_renseign_cab" id="f_renseign_cab_none" class="custom-control-input" value="non préparé" @if (mb_strtolower($df->f_renseign_cab)=="non préparé") checked @endif>
                        <label for="f_renseign_cab_none" class="custom-control-label">&nbsp;</label>
                    </div>
                </td>
            </tr>
            <!--END OF : tr-->
            <!--BEGIN OF : tr-->
            <tr id="tr_d_eligib_csf_cab">
                <td>Attestation d'éligibilité du cabinet</td>
                <td>
                    <div class="custom-control custom-radio text-center">
                        <input type="radio" name="d_eligib_csf_cab" id="d_eligib_csf_cab_cab" class="custom-control-input" value="cabinet" @if (mb_strtolower($df->d_eligib_csf_cab)=="cabinet") checked @endif>
                        <label for="d_eligib_csf_cab_cab" class="custom-control-label">&nbsp;</label>
                    </div>
                </td>
                <td>
                    <div class="custom-control custom-radio text-center">
                        <input type="radio" name="d_eligib_csf_cab" id="d_eligib_csf_cab_gc" class="custom-control-input" value="giac" @if (mb_strtolower($df->d_eligib_csf_cab)=="giac") checked @endif>
                        <label for="d_eligib_csf_cab_gc" class="custom-control-label">&nbsp;</label>
                    </div>
                </td>
                <td>
                    <div class="custom-control custom-radio text-center">
                        <input type="radio" name="d_eligib_csf_cab" id="d_eligib_csf_cab_none" class="custom-control-input" value="non préparé" @if (mb_strtolower($df->d_eligib_csf_cab)=="non préparé") checked @endif>
                        <label for="d_eligib_csf_cab_none" class="custom-control-label">&nbsp;</label>
                    </div>
                </td>
            </tr>
            <!--END OF : tr-->
            <!--BEGIN OF : tr-->
            <tr id="tr_at_compte">
                <td>Attestation de compte</td>
                <td>
                    <div class="custom-control custom-radio text-center">
                        <input type="radio" name="at_compte" id="at_compte_cab" class="custom-control-input" value="cabinet" @if (mb_strtolower($df->at_compte)=="cabinet") checked @endif>
                        <label for="at_compte_cab" class="custom-control-label">&nbsp;</label>
                    </div>
                </td>
                <td>
                    <div class="custom-control custom-radio text-center">
                        <input type="radio" name="at_compte" id="at_compte_gc" class="custom-control-input" value="giac" @if (mb_strtolower($df->at_compte)=="giac") checked @endif>
                        <label for="at_compte_gc" class="custom-control-label">&nbsp;</label>
                    </div>
                </td>
                <td>
                    <div class="custom-control custom-radio text-center">
                        <input type="radio" name="at_compte" id="at_compte_none" class="custom-control-input" value="non préparé" @if (mb_strtolower($df->at_compte)=="non préparé") checked @endif>
                        <label for="at_compte_none" class="custom-control-label">&nbsp;</label>
                    </div>
                </td>
            </tr>
            <!--END OF : tr-->
            <!--BEGIN OF : tr-->
            <tr id="tr_d_fact_proforama_ds">
                <td>Facture proforma DS</td>
                <td>
                    <div class="custom-control custom-radio text-center">
                        <input type="radio" name="d_fact_proforama_ds" id="d_fact_proforama_ds_cab" class="custom-control-input" value="cabinet" @if (mb_strtolower($df->d_fact_proforama_ds)=="cabinet") checked @endif>
                        <label for="d_fact_proforama_ds_cab" class="custom-control-label">&nbsp;</label>
                    </div>
                </td>
                <td>
                    <div class="custom-control custom-radio text-center">
                        <input type="radio" name="d_fact_proforama_ds" id="d_fact_proforama_ds_gc" class="custom-control-input" value="giac" @if (mb_strtolower($df->d_fact_proforama_ds)=="giac") checked @endif>
                        <label for="d_fact_proforama_ds_gc" class="custom-control-label">&nbsp;</label>
                    </div>
                </td>
                <td>
                    <div class="custom-control custom-radio text-center">
                        <input type="radio" name="d_fact_proforama_ds" id="d_fact_proforama_ds_none" class="custom-control-input" value="non préparé" @if (mb_strtolower($df->d_fact_proforama_ds)=="non préparé") checked @endif>
                        <label for="d_fact_proforama_ds_none" class="custom-control-label">&nbsp;</label>
                    </div>
                </td>
            </tr>
            <!--END OF : tr-->
            <!--BEGIN OF : tr-->
            <tr id="tr_d_fact_proforama_if">
                <td>Facture proforma IF</td>
                <td>
                    <div class="custom-control custom-radio text-center">
                        <input type="radio" name="d_fact_proforama_if" id="d_fact_proforama_if_cab" class="custom-control-input" value="cabinet" @if (mb_strtolower($df->d_fact_proforama_if)=="cabinet") checked @endif>
                        <label for="d_fact_proforama_if_cab" class="custom-control-label">&nbsp;</label>
                    </div>
                </td>
                <td>
                    <div class="custom-control custom-radio text-center">
                        <input type="radio" name="d_fact_proforama_if" id="d_fact_proforama_if_gc" class="custom-control-input" value="giac" @if (mb_strtolower($df->d_fact_proforama_if)=="giac") checked @endif>
                        <label for="d_fact_proforama_if_gc" class="custom-control-label">&nbsp;</label>
                    </div>
                </td>
                <td>
                    <div class="custom-control custom-radio text-center">
                        <input type="radio" name="d_fact_proforama_if" id="d_fact_proforama_if_none" class="custom-control-input" value="non préparé" @if (mb_strtolower($df->d_fact_proforama_if)=="non préparé") checked @endif>
                        <label for="d_fact_proforama_if_none" class="custom-control-label">&nbsp;</label>
                    </div>
                </td>
            </tr>
            <!--END OF : tr-->
            <!--BEGIN OF : tr-->
            <tr id="tr_d_propal_DS">
                <td>Propal de DS</td>
                <td>
                    <div class="custom-control custom-radio text-center">
                        <input type="radio" name="d_propal_DS" id="d_propal_DS_cab" class="custom-control-input" value="cabinet" @if (mb_strtolower($df->d_propal_DS)=="cabinet") checked @endif>
                        <label for="d_propal_DS_cab" class="custom-control-label">&nbsp;</label>
                    </div>
                </td>
                <td>
                    <div class="custom-control custom-radio text-center">
                        <input type="radio" name="d_propal_DS" id="d_propal_DS_gc" class="custom-control-input" value="giac" @if (mb_strtolower($df->d_propal_DS)=="giac") checked @endif>
                        <label for="d_propal_DS_gc" class="custom-control-label">&nbsp;</label>
                    </div>
                </td>
                <td>
                    <div class="custom-control custom-radio text-center">
                        <input type="radio" name="d_propal_DS" id="d_propal_DS_none" class="custom-control-input" value="non préparé" @if (mb_strtolower($df->d_propal_DS)=="non préparé") checked @endif>
                        <label for="d_propal_DS_none" class="custom-control-label">&nbsp;</label>
                    </div>
                </td>
            </tr>
            <!--END OF : tr-->
            <!--BEGIN OF : tr-->
            <tr id="tr_d_propal_IF">
                <td>Propal de IF</td>
                <td>
                    <div class="custom-control custom-radio text-center">
                        <input type="radio" name="d_propal_IF" id="d_propal_IF_cab" class="custom-control-input" value="cabinet" @if (mb_strtolower($df->d_propal_IF)=="cabinet") checked @endif>
                        <label for="d_propal_IF_cab" class="custom-control-label">&nbsp;</label>
                    </div>
                </td>
                <td>
                    <div class="custom-control custom-radio text-center">
                        <input type="radio" name="d_propal_IF" id="d_propal_IF_gc" class="custom-control-input" value="giac" @if (mb_strtolower($df->d_propal_IF)=="giac") checked @endif>
                        <label for="d_propal_IF_gc" class="custom-control-label">&nbsp;</label>
                    </div>
                </td>
                <td>
                    <div class="custom-control custom-radio text-center">
                        <input type="radio" name="d_propal_IF" id="d_propal_IF_none" class="custom-control-input" value="non préparé" @if (mb_strtolower($df->d_propal_IF)=="non préparé") checked @endif>
                        <label for="d_propal_IF_none" class="custom-control-label">&nbsp;</label>
                    </div>
                </td>
            </tr>
            <!--END OF : tr-->
            <!--BEGIN OF : tr-->
            <tr id="tr_d_cv_consult_miss">
                <td>CV des consultants désignés pour la mission</td>
                <td>
                    <div class="custom-control custom-radio text-center">
                        <input type="radio" name="d_cv_consult_miss" id="d_cv_consult_miss_cab" class="custom-control-input" value="cabinet" @if (mb_strtolower($df->d_cv_consult_miss)=="cabinet") checked @endif>
                        <label for="d_cv_consult_miss_cab" class="custom-control-label">&nbsp;</label>
                    </div>
                </td>
                <td>
                    <div class="custom-control custom-radio text-center">
                        <input type="radio" name="d_cv_consult_miss" id="d_cv_consult_miss_gc" class="custom-control-input" value="giac" @if (mb_strtolower($df->d_cv_consult_miss)=="giac") checked @endif>
                        <label for="d_cv_consult_miss_gc" class="custom-control-label">&nbsp;</label>
                    </div>
                </td>
                <td>
                    <div class="custom-control custom-radio text-center">
                        <input type="radio" name="d_cv_consult_miss" id="d_cv_consult_miss_none" class="custom-control-input" value="non préparé" @if (mb_strtolower($df->d_cv_consult_miss)=="non préparé") checked @endif>
                        <label for="d_cv_consult_miss_none" class="custom-control-label">&nbsp;</label>
                    </div>
                </td>
            </tr>
            <!--END OF : tr-->
        </tbody>
    </table>
</div>

    {{-- ********************************************************************************************** --}}
    {{-- ****************                     ********************************************************* --}}
    {{-- **************       ************************************************************************* --}}
    {{-- ***************     ************************************************************************** --}}
    {{-- ******************         ******************************************************************* --}}
    {{-- *************************          *********************************************************** --}}
    {{-- ********************************        ****************************************************** --}}
    {{-- ***********************************     ****************************************************** --}}
    {{-- *********************************      ******************************************************* --}}
    {{-- *****************************      *********************************************************** --}}
    {{-- **************                  ************************************************************** --}}
    {{-- ********************************************************************************************** --}}



    <div class="form-group col-lg-6 col-md-6 col-sm-6 col-12"><label>Date dépôt demande financement</label>
        <input class="form-control {{ $errors->has('dt_depos_df') ? ' is-invalid' : 'dt_depos_df' }}" value="{{$df->dt_depos_df}}" type="text" name="dt_depos_df" onmouseover="(this.type='date')" id="dt_depos_df" placeholder="Date dépôt demande">
        @if ($errors->has('dt_depos_df'))
            <span class="invalid-feedback" role="alert">
            {{ $errors->first('dt_depos_df') }}
            </span>
        @endif
    </div>

    <div class="form-group col-lg-6 col-12">
        <label>Accusé</label>
        <div class="form-group">
            <div class="custom-control custom-checkbox">
                <input type="checkbox" name="accus_depos" id="accus_depos" class="custom-control-input" value="préparé" @if (mb_strtolower($df->accus_depos)=="préparé") checked @endif>
                <label for="accus_depos" class="custom-control-label">Accusé dépôt</label>
            </div>
        </div>
    </div>

    <div class="form-group col-12">{{--**************HR**************--}}<hr></div>

    <div class="form-group col-12">
        <h3 class="text-secondary">Accord</h3>
    </div>

    <div class="form-group col-lg-6 col-md-6 col-sm-6 col-12"><label>Date d'accord</label>
        <input class="form-control {{ $errors->has('dt_accord') ? ' is-invalid' : 'dt_accord' }}" value="{{$df->dt_accord}}" type="text" name="dt_accord" onmouseover="(this.type='date')" id="dt_accord" placeholder="Date dépôt demande">
        @if ($errors->has('dt_accord'))
            <span class="invalid-feedback" role="alert">
            {{ $errors->first('dt_accord') }}
            </span>
        @endif
    </div>
    <div class="form-group col-lg-6 col-md-6 col-sm-6 col-12">
        <label> N° Contrat</label>
        <input class="form-control" type="text" name="n_contrat" value="{{$df->n_contrat}}" placeholder="Saisir N° Contrat">
    </div>

    <div class="form-group col-12">
    <table class="table table-sm table-bordered">
        <thead class="thead-light">
            <tr id="header">
                <th scope="col" style="width:50%">Contrats</th>
                <th scope="col" class="text-center" style="width:10%">Cabinet</th>
                <th scope="col" class="text-center" style="width:10%">Client</th>
                <th scope="col" class="text-center" style="width:10%">GIAC</th>
                <th scope="col" class="text-center" style="width:10%">Aucun</th>
            </tr>
        </thead>
        <tbody>
            <!--BEGIN OF : tr-->
            <tr id="tr_ct_DS">
                <td>Contrat DS</td>
                <td>
                    <div class="custom-control custom-radio text-center">
                        <input type="radio" name="ct_DS" id="ct_DS_cab" class="custom-control-input" value="cabinet" @if (mb_strtolower($df->ct_DS)=="cabinet") checked @endif>
                        <label for="ct_DS_cab" class="custom-control-label">&nbsp;</label>
                    </div>
                </td>
                <td>
                    <div class="custom-control custom-radio text-center">
                        <input type="radio" name="ct_DS" id="ct_DS_cl" class="custom-control-input" value="client" @if (mb_strtolower($df->ct_DS)=="client") checked @endif>
                        <label for="ct_DS_cl" class="custom-control-label">&nbsp;</label>
                    </div>
                </td>
                <td>
                    <div class="custom-control custom-radio text-center">
                        <input type="radio" name="ct_DS" id="ct_DS_gc" class="custom-control-input" value="giac" @if (mb_strtolower($df->ct_DS)=="giac") checked @endif>
                        <label for="ct_DS_gc" class="custom-control-label">&nbsp;</label>
                    </div>
                </td>
                <td>
                    <div class="custom-control custom-radio text-center">
                        <input type="radio" name="ct_DS" id="ct_DS_none" class="custom-control-input" value="non préparé" @if (mb_strtolower($df->ct_DS)=="non préparé") checked @endif>
                        <label for="ct_DS_none" class="custom-control-label">&nbsp;</label>
                    </div>
                </td>
            </tr>
            <!--END OF : tr-->
            <!--BEGIN OF : tr-->
            <tr id="tr_ct_IF">
                <td>Contrat IF</td>
                <td>
                    <div class="custom-control custom-radio text-center">
                        <input type="radio" name="ct_IF" id="ct_IF_cab" class="custom-control-input" value="cabinet" @if (mb_strtolower($df->ct_IF)=="cabinet") checked @endif>
                        <label for="ct_IF_cab" class="custom-control-label">&nbsp;</label>
                    </div>
                </td>
                <td>
                    <div class="custom-control custom-radio text-center">
                        <input type="radio" name="ct_IF" id="ct_IF_cl" class="custom-control-input" value="client" @if (mb_strtolower($df->ct_IF)=="client") checked @endif>
                        <label for="ct_IF_cl" class="custom-control-label">&nbsp;</label>
                    </div>
                </td>
                <td>
                    <div class="custom-control custom-radio text-center">
                        <input type="radio" name="ct_IF" id="ct_IF_gc" class="custom-control-input" value="giac" @if (mb_strtolower($df->ct_IF)=="giac") checked @endif>
                        <label for="ct_IF_gc" class="custom-control-label">&nbsp;</label>
                    </div>
                </td>
                <td>
                    <div class="custom-control custom-radio text-center">
                        <input type="radio" name="ct_IF" id="ct_IF_none" class="custom-control-input" value="non préparé" @if (mb_strtolower($df->ct_IF)=="non préparé") checked @endif>
                        <label for="ct_IF_none" class="custom-control-label">&nbsp;</label>
                    </div>
                </td>
            </tr>
            <!--END OF : tr-->
        </tbody>
    </table>
    </div>


    <div class="form-group col-lg-3 col-md-6 col-sm-6 col-12"><label>Date dépôt contrat</label>
        <input class="form-control {{ $errors->has('dt_dep_contrat') ? ' is-invalid' : '' }}" value="{{$df->dt_dep_contrat}}" type="text" name="dt_dep_contrat" onmouseover="(this.type='date')" id="dt_dep_contrat" placeholder="Date début miss.">
        @if ($errors->has('dt_dep_contrat'))
            <span class="invalid-feedback" role="alert">
            {{ $errors->first('dt_dep_contrat') }}
            </span>
        @endif
    </div>

    <div class="form-group col-lg-3 col-md-6 col-sm-6 col-12"><label>Date début mission</label>
        <input class="form-control {{ $errors->has('dt_debut_miss') ? ' is-invalid' : '' }}" value="{{$df->dt_debut_miss}}" type="text" name="dt_debut_miss" onmouseover="(this.type='date')" id="dt_debut_miss" placeholder="Date début miss.">
        @if ($errors->has('dt_debut_miss'))
            <span class="invalid-feedback" role="alert">
            {{ $errors->first('dt_debut_miss') }}
            </span>
        @endif
    </div>
    <div class="form-group col-lg-3 col-md-6 col-sm-6 col-12"><label>Date fin mission</label>
        <input class="form-control {{ $errors->has('dt_fin_miss') ? ' is-invalid' : '' }}" value="{{$df->dt_fin_miss}}" type="text" name="dt_fin_miss" id="dt_fin_miss" onmouseover="(this.type='date')" placeholder="Date fin miss.">
        @if ($errors->has('dt_fin_miss'))
            <span class="invalid-feedback" role="alert">
            {{ $errors->first('dt_fin_miss') }}
            </span>
        @endif
    </div>
    <div class="form-group col-lg-3 col-md-6 col-sm-6 col-12"><label>Jour homme validé</label>
        <input class="form-control {{ $errors->has('jr_hm_valid') ? ' is-invalid' : '' }}" value="{{$df->jr_hm_valid}}" type="text" name="jr_hm_valid" id="jr_hm_valid" min="0" maxlength="6" onkeypress="return isNumberKey(event)" placeholder="Nb jours">
        @if ($errors->has('jr_hm_valid'))
            <span class="invalid-feedback" role="alert">
            {{ $errors->first('jr_hm_valid') }}
            </span>
        @endif
    </div>
    <div class="form-group col-lg-3 col-md-6 col-sm-6 col-12"><label>Budget accordé</label>
        <input class="form-control {{ $errors->has('bdg_accord') ? ' is-invalid' : '' }}" value="{{$df->bdg_accord}}" type="text" name="bdg_accord" id="bdg_accord" min="0" maxlength="15" onkeypress="return isNumberKey(event)" placeholder="en DH (HT)">
        @if ($errors->has('bdg_accord'))
            <span class="invalid-feedback" role="alert">
            {{ $errors->first('bdg_accord') }}
            </span>
        @endif
    </div>
    <div class="form-group col-lg-3 col-md-6 col-sm-6 col-12"><label>Budget en lettre (TTC)</label>
        <input class="form-control {{ $errors->has('bdg_letter') ? ' is-invalid' : '' }}" type="text" name="bdg_letter" id="bdg_letter" min="0" maxlength="200" value="{{$df->bdg_letter}}" placeholder="budget (TTC)">
        @if ($errors->has('bdg_letter'))
            <span class="invalid-feedback" role="alert">
            {{ $errors->first('bdg_letter') }}
            </span>
        @endif
    </div>
    <div class="form-group col-lg-3 col-md-6 col-sm-6 col-12">
      <label for="prc_cote_part">Pourcentage quote part</label>
      <select class="form-control {{ $errors->has('prc_cote_part') ? 'is-invalid' : '' }}" onchange="CalcQuotePart()"  name="prc_cote_part" id="prc_cote_part">
        @php $percent = ["20%", "30%"]; @endphp
            <option selected disabled><span class="text-danger">*</span></option>
            @foreach ($percent as $perc)
          @if ($df->prc_cote_part == $perc)
            <option selected value="{{$perc}}">{{$perc}}</option>
          @else
            <option value="{{$perc}}">{{$perc}}</option>
          @endif
        @endforeach
      </select>
      @if ($errors->has('prc_cote_part'))
        <span class="invalid-feedback" role="alert">
          {{ $errors->first('prc_cote_part') }}
        </span>
      @endif
    </div>

    <div class="form-group col-lg-3 col-md-6 col-sm-6 col-12"><label>Quote part entreprise</label>
      <input class="form-control {{ $errors->has('cote_part_entrp') ? 'is-invalid' : 'cote_part_entrp' }}" value="{{$df->cote_part_entrp}}" type="text" name="cote_part_entrp" id="cote_part_entrp" min="0" maxlength="15" onkeypress="return isNumberKey(event)" placeholder="auto calculé.." readonly>
      @if ($errors->has('cote_part_entrp'))
        <span class="invalid-feedback" role="alert">
        {{ $errors->first('cote_part_entrp') }}
        </span>
      @endif
    </div>

    <div class="form-group col-12">{{--**************HR**************--}}<hr></div>

    <div class="form-group col-lg-3 col-sm-12">
    <label>{{----}}</label>
    <div class="form-group">
        <div class="custom-control custom-checkbox">
            <input type="checkbox" name="av_realis_DS" id="av_realis_DS" class="custom-control-input" value="préparé" @if (mb_strtolower($df->av_realis_DS)=="préparé") checked @endif>
            <label for="av_realis_DS" class="custom-control-label">Avis de réalisation DS</label>
        </div>
        <div class="custom-control custom-checkbox">
            <input type="checkbox" name="av_realis_IF" id="av_realis_IF" class="custom-control-input" value="préparé" @if (mb_strtolower($df->av_realis_IF)=="préparé") checked @endif>
            <label for="av_realis_IF" class="custom-control-label">Avis de réalisation IF</label>
        </div>
        <div class="custom-control custom-checkbox">
            <input type="checkbox" name="planing_DS" id="planing_DS" class="custom-control-input" value="préparé" @if (mb_strtolower($df->planing_DS)=="préparé") checked @endif>
            <label for="planing_DS" class="custom-control-label">Planing DS</label>
        </div>
        <div class="custom-control custom-checkbox">
            <input type="checkbox" name="planing_IF" id="planing_IF" class="custom-control-input" value="préparé" @if (mb_strtolower($df->planing_IF)=="préparé") checked @endif>
            <label for="planing_IF" class="custom-control-label">Planing IF</label>
        </div>
    </div>
    </div>
    <div class="form-group col-lg-3 col-md-6 col-sm-6 col-12"><label>Date envoi avis</label>
        <input class="form-control {{ $errors->has('dt_envoi_av') ? ' is-invalid' : '' }}" value="{{$df->dt_envoi_av}}" type="text" name="dt_envoi_av" id="dt_envoi_av" onmouseover="(this.type='date')" placeholder="Date fin miss.">
        @if ($errors->has('dt_envoi_av'))
            <span class="invalid-feedback" role="alert">
            {{ $errors->first('dt_envoi_av') }}
            </span>
        @endif
    </div>

    <div class="form-group col-lg-3 col-md-6 col-sm-6 col-12">
    <label>Rapport réalisé</label>
    <div class="input-group">
        <div class="input-group-prepend">
            <span class="input-group-text">
                <input type="checkbox" name="rpt_realis" id="rpt_realis" value="préparé" @if (mb_strtolower($df->rpt_realis)=="préparé") checked @endif>
            </span>
        </div>
        <input class="form-control {{ $errors->has('dt_fin_realis') ? ' is-invalid' : 'dt_fin_realis' }}" value="{{$df->dt_fin_realis}}" type="text" name="dt_fin_realis" id="dt_fin_realis" onmouseover="(this.type='date')" placeholder="Date réalisation">
            @if ($errors->has('dt_fin_realis'))
                <span class="invalid-feedback" role="alert">
                    {{ $errors->first('dt_fin_realis') }}
                </span>
            @endif
    </div>
    </div>


    <div class="form-group col-12">{{--**************HR**************--}}<hr></div>

    <div class="form-group col-12">
        <h3 class="text-secondary">Approbation</h3>
    </div>


    <div class="form-group col-lg-3 col-md-6 col-sm-6 col-12">
        <label>{{----}}</label>
        <div class="form-group">
            <div class="custom-control custom-checkbox">
                <input type="checkbox" name="p_garde_DS" id="p_garde_DS" id="p_garde_DS" class="custom-control-input" value="préparé" @if (mb_strtolower($df->p_garde_DS)=="préparé") checked @endif>
                <label for="p_garde_DS" class="custom-control-label">Page de garde DS</label>
            </div>
            <div class="custom-control custom-checkbox">
                <input type="checkbox" name="p_garde_IF" id="p_garde_IF" id="p_garde_IF" class="custom-control-input" value="préparé" @if (mb_strtolower($df->p_garde_IF)=="préparé") checked @endif>
                <label for="p_garde_IF" class="custom-control-label">Page de garde IF</label>
            </div>
            <div class="custom-control custom-checkbox">
                <input type="checkbox" name="f2" id="f2" id="f2" class="custom-control-input" value="préparé" @if (mb_strtolower($df->f2)=="préparé") checked @endif>
                <label for="f2" class="custom-control-label">Formulaire F2</label>
            </div>
        </div>
    </div>
    <div class="form-group col-lg-3 col-md-6 col-sm-6 col-12">
        <label>{{----}}</label>
        <div class="form-group">
            <div class="custom-control custom-checkbox">
                <input type="checkbox" name="dem_approb_ds" id="dem_approb_ds" id="dem_approb_ds" class="custom-control-input" value="préparé" @if (mb_strtolower($df->dem_approb_ds)=="préparé") checked @endif>
                <label for="dem_approb_ds" class="custom-control-label">Demande d'approb. DS</label>
            </div>
            <div class="custom-control custom-checkbox">
                <input type="checkbox" name="dem_approb_if" id="dem_approb_if" id="dem_approb_if" class="custom-control-input" value="préparé" @if (mb_strtolower($df->dem_approb_if)=="préparé") checked @endif>
                <label for="dem_approb_if" class="custom-control-label">Demande d'approb. IF</label>
            </div>
            <div class="custom-control custom-checkbox">
                <input type="checkbox" name="model_1" id="model_1" id="model_1" class="custom-control-input" value="préparé" @if (mb_strtolower($df->model_1)=="préparé") checked @endif>
                <label for="model_1" class="custom-control-label">Modèle 1</label>
            </div>
        </div>
    </div>

    <div class="form-group col-lg-3 col-md-6 col-sm-6 col-12">
    <label>Rapport déposé</label>
    <div class="input-group">
        <div class="input-group-prepend">
        <span class="input-group-text">
            <input type="checkbox" name="rpt_depose" id="rpt_depose" value="préparé" @if (mb_strtolower($df->rpt_depose)=="préparé") checked @endif>
        </span>
        </div>
        <input class="form-control {{ $errors->has('dt_depos_rpt') ? ' is-invalid' : 'dt_depos_rpt' }}" value="{{$df->dt_depos_rpt}}" type="text" name="dt_depos_rpt" id="dt_depos_rpt" onmouseover="(this.type='date')" placeholder="Date dépôt">
            @if ($errors->has('dt_depos_rpt'))
                <span class="invalid-feedback" role="alert">
                    {{ $errors->first('dt_depos_rpt') }}
                </span>
            @endif
    </div>
    </div>

    <div class="form-group col-lg-3 col-md-6 col-sm-6 col-12">
    <label>Attestation d'approbation</label>
    <div class="input-group">
        <div class="input-group-prepend">
        <span class="input-group-text">
            <input type="checkbox" name="at_approb" id="at_approb" value="préparé" @if (mb_strtolower($df->at_approb)=="préparé") checked @endif>
        </span>
        </div>
        <input class="form-control {{ $errors->has('dt_approb') ? ' is-invalid' : 'dt_approb' }}" value="{{$df->dt_approb}}" type="text" name="dt_approb" id="dt_approb" onmouseover="(this.type='date')" placeholder="Date d'approbation">
            @if ($errors->has('dt_approb'))
                <span class="invalid-feedback" role="alert">
                    {{ $errors->first('dt_approb') }}
                </span>
            @endif
    </div>
    </div>

    <div class="form-group col-12">{{--**************HR**************--}}<hr /></div>

    <div class="form-group col-12 text-center">
        <h4>État demande</h4>
        <div class="btn-group btn-group-toggle" data-toggle="buttons">
            <label class="btn {{ mb_strtolower($df->etat)=='initié' ? 'btn-success active' : 'btn-warning' }}" name="btnEtat">
                Initié
                <i class="fas fa-battery-quarter"></i>
                <input type="radio" name="etat" id="option1" autocomplete="off" value="initié"
                  {{ mb_strtolower($df->etat)=='initié' ? 'checked' : '' }}>
            </label>

            <label class="btn {{ mb_strtolower($df->etat)=='instruction dossier' ? 'btn-success active' : 'btn-warning' }}" name="btnEtat">
                Instruction dossier
                <i class="fas fa-hourglass-half"></i>
                <input type="radio" name="etat" id="option2" autocomplete="off" value="instruction dossier"
                  {{ mb_strtolower($df->etat)=='instruction dossier' ? 'checked' : '' }}>
            </label>

            <label class="btn {{ mb_strtolower($df->etat)=='déposé' ? 'btn-success active' : 'btn-warning' }}" name="btnEtat">
                Déposé
                <i class="fas fa-folder-open"></i>
                <input type="radio" name="etat" id="option3" autocomplete="off" value="déposé"
                  {{ mb_strtolower($df->etat)=='déposé' ? 'checked' : '' }}>
            </label>

            <label class="btn {{ mb_strtolower($df->etat)=='accordé' ? 'btn-success active' : 'btn-warning' }}" name="btnEtat">
                Accordé
                <i class="fas fa-signature"></i>
                <input type="radio" name="etat" id="option4" onchange="AccordValidate()" autocomplete="off" value="accordé"
                  {{ mb_strtolower($df->etat)=='accordé' ? 'checked' : '' }}>
            </label>

            <label class="btn {{ mb_strtolower($df->etat)=='réalisé' ? 'btn-success active' : 'btn-warning' }}" name="btnEtat">
                Réalisé
                <i class="fas fa-check-square"></i>
                <input type="radio" name="etat" id="option5" onchange="AccordValidate()" autocomplete="off" value="réalisé"
                  {{ mb_strtolower($df->etat)=='réalisé' ? 'checked' : '' }}>
            </label>

            <label class="btn {{ mb_strtolower($df->etat)=='approuvé' ? 'btn-success active' : 'btn-warning' }}" name="btnEtat">
                Approuvé
                <i class="fas fa-check-double"></i>
                <input type="radio" name="etat" onchange="AccordValidate()" id="option6" autocomplete="off" value="approuvé"
                  {{ mb_strtolower($df->etat)=='approuvé' ? 'checked' : '' }}>
            </label>

            <label class="btn {{ mb_strtolower($df->etat)=='annulé' ? 'btn-danger active' : 'btn-danger' }}" name="btnEtat">
                Annulé
                <i class="fas fa-times"></i>
                <input type="radio" name="etat" id="option0" autocomplete="off" value="annulé"
                  {{ mb_strtolower($df->etat)=='annulé' ? 'checked' : '' }}>
            </label>
        </div>
    </div>

    <div class="form-group col-12"><label>Commentaire</label><textarea class="form-control" type="text" rows="4" name="commentaire" maxlength="4900" placeholder="Commentaire ..">{{$df->commentaire}}</textarea></div>


    </div><!--./row-->
  </div><!--./card-body-->

  <div class="card-footer text-center">
    <button class="btn bu-add" type="submit" id="edit"><i class="fas fa-pen-square"></i>&nbsp;Modifier</button>
    <a class="btn btn-danger" href="/df"><i class="fas fa-window-close"></i>&nbsp;Annuler</a>
  </div>

  </form>
</div><!-- ./CARD -->





{{-- DROP DOWN SCRIPT --}}
<script type="text/javascript">

  $(document).ready(function() {
      //chercher le giac associé au client choisi dans "DF"
      // $(document).on('change', '#nrc_e', function(){
      var nrc = $('#nrc_e').val();

      $.ajax({
          type: 'get',
          url: '{!! URL::to('/findgiacsclient') !!}',
          data: {'nrc': nrc},
          success:function(data) {
              console.log('success !!');
              console.log(data);
              $('#gc_rattach').val(data.giac_rattach);
          },
          error:function(msg) {
              console.log('error getting data !!');
          }
      });

      // calculer quote part et ecrire bdg en lettres
      setInterval(() => {
        checkEtat();
        CalcQuotePart();
        CalcBdgAccordTTC();
      }, 500);

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
