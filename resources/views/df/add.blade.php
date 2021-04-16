@extends('layouts.admin')

@section('content')


@section('content-wrapper')
<div class="col-sm-6">
        <h1 class="m-0 text-dark">Ajout</h1>
    </div><!-- /.col -->
    <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="/df">Demande financement</a></li>
            <li class="breadcrumb-item active">Ajout</li>
        </ol>
    </div><!-- /.col -->
@endsection


{{-- jquery scripts --}}
<script src={{ asset('js/jquery.js') }}></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
{{-- jquery scripts --}}
<script src={{ asset('js/myjs.js') }}></script>


<<<<<<< HEAD
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
=======

>>>>>>> 8e98022b2ba40f1be478fb4f7c866cf02e101a62

<!-- CARD -->
<div class="card card-dark">
    <!-- card-header -->
    <div class="card-header" id="cardDf">
        <h3 class="card-title">Ajout demande financement</h3>
    </div>
    <!-- /.card-header -->
    <form role="form" action="/add-df" method="POST">
    <div class="card-body{{-- table-responsive table-striped cus-card-height--}}">
        <div class="row">
            {{ csrf_field() }}

            @if (session()->has('added'))
                <div class="alert alert-success alert-dismissible col-12">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <h5><i class="icon fas fa-check"></i>Succès</h5>
                    <span>Ajouté avec succès</span>
                </div>
            @endif
            @if (count($errors) > 0)
                <div class="alert alert-danger alert-dismissible col-12">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <h5><i class="icon fas fa-exclamation-triangle"></i>Erreurs</h5>
                    <span>Veuillez vérifier les champs</span>
                    <span>{{$errors}}</span>
                </div>
            @endif


            <div class="form-group col-lg-9 col-12">
                <label>Entreprise</label>
                @if (count($client)==0)
                    <a class="btn bu-icon bu-sm btn-sm" href="/add-cl"><i class="fa fa-plus"></i></a>
                @endif
                <select class="form-control {{ $errors->has('nrc_e') ? ' is-invalid' : '' }}" name="nrc_e" id="nrc_e" onchange="checkEtat()">
                    <option disabled selected></option>
                    @foreach ($client as $cl)
                        @if ($cl->nrc_entrp == $cl->nrc_entrp)
                            <option value="{{ $cl->nrc_entrp }}">{{ $cl->raisoci }}</option>
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

            <div class="form-group col-lg-3 col-md-6 col-12">
                <label for="gc_rattach">GIAC rattachement</label>
                <input type="text" class="form-control {{ $errors->has('gc_rattach') ? ' is-invalid' : '' }}" name="gc_rattach" id="gc_rattach" readonly>
                @if ($errors->has('gc_rattach'))
                    <span class="invalid-feedback" role="alert">
                        {{ $errors->first('gc_rattach') }}
                    </span>
                @endif
            </div>

            <div class="form-group col-lg-3 col-md-6 col-12">
                <label for="prc_cote_part_demande">Poucent. quote part demandé</label>
                <select class="form-control {{ $errors->has('prc_cote_part_demande') ? ' is-invalid' : '' }}" name="prc_cote_part_demande" id="prc_cote_part_demande">
                    @php $percent = ["20%", "30%"]; @endphp
                    <option selected disabled><span class="text-danger">*</span></option>
                    @foreach ($percent as $perc)
                        <option value="{{$perc}}">{{$perc}}</option>
                    @endforeach
                </select>
                @if ($errors->has('prc_cote_part_demande'))
                    <span class="invalid-feedback" role="alert">
                        {{ $errors->first('prc_cote_part_demande') }}
                    </span>
                @endif
            </div>


            <div class="form-group col-lg-3 col-md-6 col-12">
                <label>Type Mission</label>
                <select class="form-control {{ $errors->has('type_miss') ? ' is-invalid' : '' }}" name="type_miss" id="type_miss" onchange="checkEtat()">
                    <option disabled selected>*</option>
                    <option value="diagnostic stratégique">diagnostic stratégique</option>
                    <option value="Ingénierie de formation">Ingénierie de formation</option>
                    {{-- <option value="diagnostic stratégique et ingénierie de formation">diagnostic stratégique et ingénierie de formation</option> --}}
                    {{-- <option value="Plan de formation">Plan de formation</option> --}}
                </select>
                    @if ($errors->has('type_miss'))
                        <span class="invalid-feedback" role="alert">
                            {{ $errors->first('type_miss') }}
                        </span>
                    @endif
            </div>
            <div class="form-group col-lg-3 col-md-6 col-12"><label>Année d'exercice</label>
                <input class="form-control {{ $errors->has('annee_exerc') ? ' is-invalid' : '' }}" value="{{old('annee_exerc')}}" type="text" name="annee_exerc" id="annee_exerc" min="4" maxlength="4" onkeypress="return isNumberKey(event)" placeholder="Année">
                @if ($errors->has('annee_exerc'))
                    <span class="invalid-feedback" role="alert">
                    {{ $errors->first('annee_exerc') }}
                    </span>
                @endif
            </div>
            <div class="form-group col-lg-6 col-md-6 col-12">
            <label>CSF</label>
                <div class="form-group">
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" name="d_eligib_csf_entrp" id="d_eligib_csf_entrp" class="custom-control-input" value="Préparé">
                        <label for="d_eligib_csf_entrp" class="custom-control-label">Éligibilité CSF entreprise</label>
                    </div>
                </div>
            </div>


            <div class="form-group col-lg-3 col-md-6 col-12"><label>Nombre d'intervenants</label>
                <input class="form-control {{ $errors->has('nb_interv') ? ' is-invalid' : '' }}" value="{{old('nb_interv')}}" type="text" name="nb_interv" id="nb_interv" min="0" maxlength="3" onkeypress="return isNumberKey(event)" placeholder="Nb. interv.">
                @if ($errors->has('nb_interv'))
                    <span class="invalid-feedback" role="alert">
                    {{ $errors->first('nb_interv') }}
                    </span>
                @endif
            </div>
            <div class="form-group col-lg-3 col-md-6 col-12"><label>Date demande</label>
                <input class="form-control {{ $errors->has('dt_df') ? ' is-invalid' : '' }}" value="{{old('dt_df')}}" type="text" name="dt_df" id="dt_df" onmouseover="(this.type='date')" placeholder="Date demande finan.">
                @if ($errors->has('dt_df'))
                    <span class="invalid-feedback" role="alert">
                    {{ $errors->first('dt_df') }}
                    </span>
                @endif
            </div>
            <div class="form-group col-lg-3 col-md-6 col-12"><label>Jour homme demandé</label>
                <input class="form-control {{ $errors->has('jr_hm_demande') ? ' is-invalid' : '' }}" value="{{old('jr_hm_demande')}}" type="text" name="jr_hm_demande" id="jr_hm_demande" min="0" maxlength="15" onkeypress="return isNumberKey(event)" placeholder="Nb jours">
                @if ($errors->has('jr_hm_demande'))
                    <span class="invalid-feedback" role="alert">
                    {{ $errors->first('jr_hm_demande') }}
                    </span>
                @endif
            </div>
            <div class="form-group col-lg-3 col-md-6 col-12"><label>Budget demandé</label>
                <input class="form-control {{ $errors->has('bdg_demande') ? ' is-invalid' : '' }}" value="{{old('bdg_demande')}}" type="text" name="bdg_demande" id="bdg_demande" min="0" maxlength="15" onkeypress="return isNumberKey(event)" placeholder="en DH (HT)">
                @if ($errors->has('bdg_demande'))
                    <span class="invalid-feedback" role="alert">
                    {{ $errors->first('bdg_demande') }}
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
                                <input type="radio" name="dem_csf" id="dem_csf_cab" class="custom-control-input" value="cabinet">
                                <label for="dem_csf_cab" class="custom-control-label">&nbsp;</label>
                            </div>
                        </td>
                        <td>
                            <div class="custom-control custom-radio text-center">
                                <input type="radio" name="dem_csf" id="dem_csf_cl" class="custom-control-input" value="client">
                                <label for="dem_csf_cl" class="custom-control-label">&nbsp;</label>
                            </div>
                        </td>
                        <td>
                            <div class="custom-control custom-radio text-center">
                                <input type="radio" name="dem_csf" id="dem_csf_opt" class="custom-control-input" value="ofppt">
                                <label for="dem_csf_opt" class="custom-control-label">&nbsp;</label>
                            </div>
                        </td>
                        <td>
                            <div class="custom-control custom-radio text-center">
                                <input type="radio" name="dem_csf" id="dem_csf_none" class="custom-control-input" value="non préparé" checked>
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
                                <input type="radio" name="f1" id="f1_cab" class="custom-control-input" value="cabinet">
                                <label for="f1_cab" class="custom-control-label">&nbsp;</label>
                            </div>
                        </td>
                        <td>
                            <div class="custom-control custom-radio text-center">
                                <input type="radio" name="f1" id="f1_cl" class="custom-control-input" value="client">
                                <label for="f1_cl" class="custom-control-label">&nbsp;</label>
                            </div>
                        </td>
                        <td>
                            <div class="custom-control custom-radio text-center">
                                <input type="radio" name="f1" id="f1_opt" class="custom-control-input" value="ofppt">
                                <label for="f1_opt" class="custom-control-label">&nbsp;</label>
                            </div>
                        </td>
                        <td>
                            <div class="custom-control custom-radio text-center">
                                <input type="radio" name="f1" id="f1_none" class="custom-control-input" value="non préparé" checked>
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
                                <input type="radio" name="d_statut" id="d_statut_cab" class="custom-control-input" value="cabinet">
                                <label for="d_statut_cab" class="custom-control-label">&nbsp;</label>
                            </div>
                        </td>
                        <td>
                            <div class="custom-control custom-radio text-center">
                                <input type="radio" name="d_statut" id="d_statut_cl" class="custom-control-input" value="client">
                                <label for="d_statut_cl" class="custom-control-label">&nbsp;</label>
                            </div>
                        </td>
                        <td>
                            <div class="custom-control custom-radio text-center">
                                <input type="radio" name="d_statut" id="d_statut_opt" class="custom-control-input" value="ofppt">
                                <label for="d_statut_opt" class="custom-control-label">&nbsp;</label>
                            </div>
                        </td>
                        <td>
                            <div class="custom-control custom-radio text-center">
                                <input type="radio" name="d_statut" id="d_statut_none" class="custom-control-input" value="non préparé" checked>
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
                                <input type="radio" name="d_rc" id="d_rc_cab" class="custom-control-input" value="cabinet">
                                <label for="d_rc_cab" class="custom-control-label">&nbsp;</label>
                            </div>
                        </td>
                        <td>
                            <div class="custom-control custom-radio text-center">
                                <input type="radio" name="d_rc" id="d_rc_cl" class="custom-control-input" value="client">
                                <label for="d_rc_cl" class="custom-control-label">&nbsp;</label>
                            </div>
                        </td>
                        <td>
                            <div class="custom-control custom-radio text-center">
                                <input type="radio" name="d_rc" id="d_rc_opt" class="custom-control-input" value="ofppt">
                                <label for="d_rc_opt" class="custom-control-label">&nbsp;</label>
                            </div>
                        </td>
                        <td>
                            <div class="custom-control custom-radio text-center">
                                <input type="radio" name="d_rc" id="d_rc_none" class="custom-control-input" value="non préparé" checked>
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
                                <input type="radio" name="at_domic_banc" id="at_domic_banc_cab" class="custom-control-input" value="cabinet">
                                <label for="at_domic_banc_cab" class="custom-control-label">&nbsp;</label>
                            </div>
                        </td>
                        <td>
                            <div class="custom-control custom-radio text-center">
                                <input type="radio" name="at_domic_banc" id="at_domic_banc_cl" class="custom-control-input" value="client">
                                <label for="at_domic_banc_cl" class="custom-control-label">&nbsp;</label>
                            </div>
                        </td>
                        <td>
                            <div class="custom-control custom-radio text-center">
                                <input type="radio" name="at_domic_banc" id="at_domic_banc_opt" class="custom-control-input" value="ofppt">
                                <label for="at_domic_banc_opt" class="custom-control-label">&nbsp;</label>
                            </div>
                        </td>
                        <td>
                            <div class="custom-control custom-radio text-center">
                                <input type="radio" name="at_domic_banc" id="at_domic_banc_none" class="custom-control-input" value="non préparé" checked>
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
                                <input type="radio" name="d_pouvoir" id="d_pouvoir_cab" class="custom-control-input" value="cabinet">
                                <label for="d_pouvoir_cab" class="custom-control-label">&nbsp;</label>
                            </div>
                        </td>
                        <td>
                            <div class="custom-control custom-radio text-center">
                                <input type="radio" name="d_pouvoir" id="d_pouvoir_cl" class="custom-control-input" value="client">
                                <label for="d_pouvoir_cl" class="custom-control-label">&nbsp;</label>
                            </div>
                        </td>
                        <td>
                            <div class="custom-control custom-radio text-center">
                                <input type="radio" name="d_pouvoir" id="d_pouvoir_opt" class="custom-control-input" value="ofppt">
                                <label for="d_pouvoir_opt" class="custom-control-label">&nbsp;</label>
                            </div>
                        </td>
                        <td>
                            <div class="custom-control custom-radio text-center">
                                <input type="radio" name="d_pouvoir" id="d_pouvoir_none" class="custom-control-input" value="non préparé" checked>
                                <label for="d_pouvoir_none" class="custom-control-label">&nbsp;</label>
                            </div>
                        </td>
                    </tr>
                    <!--END OF : tr-->
                </tbody>
            </table>

            </div>

            <div class="form-group col-lg-6 col-md-6 col-12">
                <label>Attes. CSF & Date retrait</label>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text">
                            <input type="checkbox" name="at_csf_entrp" id="at_csf_entrp" value="préparé">
                        </span>
                    </div>
                    <input class="form-control {{ $errors->has('dt_at_csf') ? 'is-invalid' : '' }}" value="{{old('dt_at_csf')}}" type="text" name="dt_at_csf" id="dt_at_csf" onmouseover="(this.type='date')" placeholder="Date réalisation">
                </div>
            </div>

            <div class="form-group col-lg-6 col-md-6 col-12">
                <label for="bdg_pf">Budget Plan formation</label>
                <input class="form-control {{ $errors->has('bdg_pf') ? ' is-invalid' : '' }}" value="{{old('bdg_pf')}}" type="text" id="bdg_pf" name="bdg_pf" maxlength="50" placeholder="en DH" >
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
                                <input type="radio" name="d_bulltin_adhes" id="d_bulltin_adhes_cab" class="custom-control-input" value="cabinet">
                                <label for="d_bulltin_adhes_cab" class="custom-control-label">&nbsp;</label>
                            </div>
                        </td>
                        <td>
                            <div class="custom-control custom-radio text-center">
                                <input type="radio" name="d_bulltin_adhes" id="d_bulltin_adhes_cl" class="custom-control-input" value="client">
                                <label for="d_bulltin_adhes_cl" class="custom-control-label">&nbsp;</label>
                            </div>
                        </td>
                        <td>
                            <div class="custom-control custom-radio text-center">
                                <input type="radio" name="d_bulltin_adhes" id="d_bulltin_adhes_gc" class="custom-control-input" value="giac">
                                <label for="d_bulltin_adhes_gc" class="custom-control-label">&nbsp;</label>
                            </div>
                        </td>
                        <td>
                            <div class="custom-control custom-radio text-center">
                                <input type="radio" name="d_bulltin_adhes" id="d_bulltin_adhes_none" class="custom-control-input" value="non préparé" checked>
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
                                <input type="radio" name="d_df_DS" id="d_df_DS_cab" class="custom-control-input" value="cabinet">
                                <label for="d_df_DS_cab" class="custom-control-label">&nbsp;</label>
                            </div>
                        </td>
                        <td>
                            <div class="custom-control custom-radio text-center">
                                <input type="radio" name="d_df_DS" id="d_df_DS_cl" class="custom-control-input" value="client">
                                <label for="d_df_DS_cl" class="custom-control-label">&nbsp;</label>
                            </div>
                        </td>
                        <td>
                            <div class="custom-control custom-radio text-center">
                                <input type="radio" name="d_df_DS" id="d_df_DS_gc" class="custom-control-input" value="giac">
                                <label for="d_df_DS_gc" class="custom-control-label">&nbsp;</label>
                            </div>
                        </td>
                        <td>
                            <div class="custom-control custom-radio text-center">
                                <input type="radio" name="d_df_DS" id="d_df_DS_none" class="custom-control-input" value="non préparé" checked>
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
                                <input type="radio" name="d_df_IF" id="d_df_IF_cab" class="custom-control-input" value="cabinet">
                                <label for="d_df_IF_cab" class="custom-control-label">&nbsp;</label>
                            </div>
                        </td>
                        <td>
                            <div class="custom-control custom-radio text-center">
                                <input type="radio" name="d_df_IF" id="d_df_IF_cl" class="custom-control-input" value="client">
                                <label for="d_df_IF_cl" class="custom-control-label">&nbsp;</label>
                            </div>
                        </td>
                        <td>
                            <div class="custom-control custom-radio text-center">
                                <input type="radio" name="d_df_IF" id="d_df_IF_gc" class="custom-control-input" value="giac">
                                <label for="d_df_IF_gc" class="custom-control-label">&nbsp;</label>
                            </div>
                        </td>
                        <td>
                            <div class="custom-control custom-radio text-center">
                                <input type="radio" name="d_df_IF" id="d_df_IF_none" class="custom-control-input" value="non préparé" checked>
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
                                <input type="radio" name="d_cheque" id="d_cheque_cab" class="custom-control-input" value="cabinet">
                                <label for="d_cheque_cab" class="custom-control-label">&nbsp;</label>
                            </div> --}}
                        </td>
                        <td>
                            <div class="custom-control custom-radio text-center">
                                <input type="radio" name="d_cheque" id="d_cheque_cl" class="custom-control-input" value="client">
                                <label for="d_cheque_cl" class="custom-control-label">&nbsp;</label>
                            </div>
                        </td>
                        <td>
                            <div class="custom-control custom-radio text-center">
                                <input type="radio" name="d_cheque" id="d_cheque_gc" class="custom-control-input" value="giac">
                                <label for="d_cheque_gc" class="custom-control-label">&nbsp;</label>
                            </div>
                        </td>
                        <td>
                            <div class="custom-control custom-radio text-center">
                                <input type="radio" name="d_cheque" id="d_cheque_none" class="custom-control-input" value="non préparé" checked>
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
                                <input type="radio" name="f_renseign_entrp" id="f_renseign_entrp_cab" class="custom-control-input" value="cabinet">
                                <label for="f_renseign_entrp_cab" class="custom-control-label">&nbsp;</label>
                            </div>
                        </td>
                        <td>
                            <div class="custom-control custom-radio text-center">
                                <input type="radio" name="f_renseign_entrp" id="f_renseign_entrp_cl" class="custom-control-input" value="client">
                                <label for="f_renseign_entrp_cl" class="custom-control-label">&nbsp;</label>
                            </div>
                        </td>
                        <td>
                            <div class="custom-control custom-radio text-center">
                                <input type="radio" name="f_renseign_entrp" id="f_renseign_entrp_gc" class="custom-control-input" value="giac">
                                <label for="f_renseign_entrp_gc" class="custom-control-label">&nbsp;</label>
                            </div>
                        </td>
                        <td>
                            <div class="custom-control custom-radio text-center">
                                <input type="radio" name="f_renseign_entrp" id="f_renseign_entrp_none" class="custom-control-input" value="non préparé" checked>
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
                                <input type="radio" name="d_honor" id="d_honor_cab" class="custom-control-input" value="cabinet">
                                <label for="d_honor_cab" class="custom-control-label">&nbsp;</label>
                            </div>
                        </td>
                        <td>
                            <div class="custom-control custom-radio text-center">
                                <input type="radio" name="d_honor" id="d_honor_cl" class="custom-control-input" value="client">
                                <label for="d_honor_cl" class="custom-control-label">&nbsp;</label>
                            </div>
                        </td>
                        <td>
                            <div class="custom-control custom-radio text-center">
                                <input type="radio" name="d_honor" id="d_honor_gc" class="custom-control-input" value="giac">
                                <label for="d_honor_gc" class="custom-control-label">&nbsp;</label>
                            </div>
                        </td>
                        <td>
                            <div class="custom-control custom-radio text-center">
                                <input type="radio" name="d_honor" id="d_honor_none" class="custom-control-input" value="non préparé" checked>
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
                                <input type="radio" name="f_etude_DS" id="f_etude_DS_cab" class="custom-control-input" value="cabinet">
                                <label for="f_etude_DS_cab" class="custom-control-label">&nbsp;</label>
                            </div>
                        </td>
                        <td>
                            <div class="custom-control custom-radio text-center">
                                <input type="radio" name="f_etude_DS" id="f_etude_DS_cl" class="custom-control-input" value="client">
                                <label for="f_etude_DS_cl" class="custom-control-label">&nbsp;</label>
                            </div>
                        </td>
                        <td>
                            <div class="custom-control custom-radio text-center">
                                <input type="radio" name="f_etude_DS" id="f_etude_DS_gc" class="custom-control-input" value="giac">
                                <label for="f_etude_DS_gc" class="custom-control-label">&nbsp;</label>
                            </div>
                        </td>
                        <td>
                            <div class="custom-control custom-radio text-center">
                                <input type="radio" name="f_etude_DS" id="f_etude_DS_none" class="custom-control-input" value="non préparé" checked>
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
                                <input type="radio" name="f_etude_IF" id="f_etude_IF_cab" class="custom-control-input" value="cabinet">
                                <label for="f_etude_IF_cab" class="custom-control-label">&nbsp;</label>
                            </div>
                        </td>
                        <td>
                            <div class="custom-control custom-radio text-center">
                                <input type="radio" name="f_etude_IF" id="f_etude_IF_cl" class="custom-control-input" value="client">
                                <label for="f_etude_IF_cl" class="custom-control-label">&nbsp;</label>
                            </div>
                        </td>
                        <td>
                            <div class="custom-control custom-radio text-center">
                                <input type="radio" name="f_etude_IF" id="f_etude_IF_gc" class="custom-control-input" value="giac">
                                <label for="f_etude_IF_gc" class="custom-control-label">&nbsp;</label>
                            </div>
                        </td>
                        <td>
                            <div class="custom-control custom-radio text-center">
                                <input type="radio" name="f_etude_IF" id="f_etude_IF_none" class="custom-control-input" value="non préparé" checked>
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
                                <input type="radio" name="l_tierpay_DS" id="l_tierpay_DS_cab" class="custom-control-input" value="cabinet">
                                <label for="l_tierpay_DS_cab" class="custom-control-label">&nbsp;</label>
                            </div>
                        </td>
                        <td>
                            <div class="custom-control custom-radio text-center">
                                <input type="radio" name="l_tierpay_DS" id="l_tierpay_DS_cl" class="custom-control-input" value="client">
                                <label for="l_tierpay_DS_cl" class="custom-control-label">&nbsp;</label>
                            </div>
                        </td>
                        <td>
                            <div class="custom-control custom-radio text-center">
                                <input type="radio" name="l_tierpay_DS" id="l_tierpay_DS_gc" class="custom-control-input" value="giac">
                                <label for="l_tierpay_DS_gc" class="custom-control-label">&nbsp;</label>
                            </div>
                        </td>
                        <td>
                            <div class="custom-control custom-radio text-center">
                                <input type="radio" name="l_tierpay_DS" id="l_tierpay_DS_none" class="custom-control-input" value="non préparé" checked>
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
                                <input type="radio" name="l_tierpay_IF" id="l_tierpay_IF_cab" class="custom-control-input" value="cabinet">
                                <label for="l_tierpay_IF_cab" class="custom-control-label">&nbsp;</label>
                            </div>
                        </td>
                        <td>
                            <div class="custom-control custom-radio text-center">
                                <input type="radio" name="l_tierpay_IF" id="l_tierpay_IF_cl" class="custom-control-input" value="client">
                                <label for="l_tierpay_IF_cl" class="custom-control-label">&nbsp;</label>
                            </div>
                        </td>
                        <td>
                            <div class="custom-control custom-radio text-center">
                                <input type="radio" name="l_tierpay_IF" id="l_tierpay_IF_gc" class="custom-control-input" value="giac">
                                <label for="l_tierpay_IF_gc" class="custom-control-label">&nbsp;</label>
                            </div>
                        </td>
                        <td>
                            <div class="custom-control custom-radio text-center">
                                <input type="radio" name="l_tierpay_IF" id="l_tierpay_IF_none" class="custom-control-input" value="non préparé" checked>
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
                                <input type="radio" name="doss_jury" id="doss_jury_cl" class="custom-control-input" value="client">
                                <label for="doss_jury_cl" class="custom-control-label">&nbsp;</label>
                            </div>
                        </td>
                        <td>
                            <div class="custom-control custom-radio text-center">
                                <input type="radio" name="doss_jury" id="doss_jury_gc" class="custom-control-input" value="giac">
                                <label for="doss_jury_gc" class="custom-control-label">&nbsp;</label>
                            </div>
                        </td>
                        <td>
                            <div class="custom-control custom-radio text-center">
                                <input type="radio" name="doss_jury" id="doss_jury_none" class="custom-control-input" value="non préparé" checked>
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
                                <input type="radio" name="at_csf_doc" id="at_csf_doc_cab" class="custom-control-input" value="cabinet">
                                <label for="at_csf_doc_cab" class="custom-control-label">&nbsp;</label>
                            </div>
                        </td>
                        <td>
                            <div class="custom-control custom-radio text-center">
                                <input type="radio" name="at_csf_doc" id="at_csf_doc_cl" class="custom-control-input" value="client">
                                <label for="at_csf_doc_cl" class="custom-control-label">&nbsp;</label>
                            </div>
                        </td>
                        <td>
                            <div class="custom-control custom-radio text-center">
                                <input type="radio" name="at_csf_doc" id="at_csf_doc_gc" class="custom-control-input" value="giac">
                                <label for="at_csf_doc_gc" class="custom-control-label">&nbsp;</label>
                            </div>
                        </td>
                        <td>
                            <div class="custom-control custom-radio text-center">
                                <input type="radio" name="at_csf_doc" id="at_csf_doc_none" class="custom-control-input" value="non préparé" checked>
                                <label for="at_csf_doc_none" class="custom-control-label">&nbsp;</label>
                            </div>
                        </td>
                    </tr>
                    <!--END OF : tr-->

                    <!--BEGIN OF : tr-->
                    <tr id="td_d_model6_g6">
                        <td colspan="5">
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" name="d_model6_n_1" id="d_model6_n_1" class="custom-control-input" value="préparé">
                                <label for="d_model6_n_1" class="custom-control-label">Modèle 6 (N-1)</label>
                            </div>
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" name="d_model6_n_2" id="d_model6_n_2" class="custom-control-input" value="préparé">
                                <label for="d_model6_n_2" class="custom-control-label">Modèle 6 (N-2)</label>
                            </div>

                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" name="d_honor_act_form" id="d_honor_act_form" class="custom-control-input" value="préparé">
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
                                <input type="radio" name="at_qual_cab" id="at_qual_cab_cab" class="custom-control-input" value="cabinet">
                                <label for="at_qual_cab_cab" class="custom-control-label">&nbsp;</label>
                            </div>
                        </td>
                        <td>
                            <div class="custom-control custom-radio text-center">
                                <input type="radio" name="at_qual_cab" id="at_qual_cab_gc" class="custom-control-input" value="giac">
                                <label for="at_qual_cab_gc" class="custom-control-label">&nbsp;</label>
                            </div>
                        </td>
                        <td>
                            <div class="custom-control custom-radio text-center">
                                <input type="radio" name="at_qual_cab" id="at_qual_cab_none" class="custom-control-input" value="non préparé" checked>
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
                                <input type="radio" name="f_renseign_cab" id="f_renseign_cab_cab" class="custom-control-input" value="cabinet">
                                <label for="f_renseign_cab_cab" class="custom-control-label">&nbsp;</label>
                            </div>
                        </td>
                        <td>
                            <div class="custom-control custom-radio text-center">
                                <input type="radio" name="f_renseign_cab" id="f_renseign_cab_gc" class="custom-control-input" value="giac">
                                <label for="f_renseign_cab_gc" class="custom-control-label">&nbsp;</label>
                            </div>
                        </td>
                        <td>
                            <div class="custom-control custom-radio text-center">
                                <input type="radio" name="f_renseign_cab" id="f_renseign_cab_none" class="custom-control-input" value="non préparé" checked>
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
                                <input type="radio" name="d_eligib_csf_cab" id="d_eligib_csf_cab_cab" class="custom-control-input" value="cabinet">
                                <label for="d_eligib_csf_cab_cab" class="custom-control-label">&nbsp;</label>
                            </div>
                        </td>
                        <td>
                            <div class="custom-control custom-radio text-center">
                                <input type="radio" name="d_eligib_csf_cab" id="d_eligib_csf_cab_gc" class="custom-control-input" value="giac">
                                <label for="d_eligib_csf_cab_gc" class="custom-control-label">&nbsp;</label>
                            </div>
                        </td>
                        <td>
                            <div class="custom-control custom-radio text-center">
                                <input type="radio" name="d_eligib_csf_cab" id="d_eligib_csf_cab_none" class="custom-control-input" value="non préparé" checked>
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
                                <input type="radio" name="at_compte" id="at_compte_cab" class="custom-control-input" value="cabinet">
                                <label for="at_compte_cab" class="custom-control-label">&nbsp;</label>
                            </div>
                        </td>
                        <td>
                            <div class="custom-control custom-radio text-center">
                                <input type="radio" name="at_compte" id="at_compte_gc" class="custom-control-input" value="giac">
                                <label for="at_compte_gc" class="custom-control-label">&nbsp;</label>
                            </div>
                        </td>
                        <td>
                            <div class="custom-control custom-radio text-center">
                                <input type="radio" name="at_compte" id="at_compte_none" class="custom-control-input" value="non préparé" checked>
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
                                <input type="radio" name="d_fact_proforama_ds" id="d_fact_proforama_ds_cab" class="custom-control-input" value="cabinet">
                                <label for="d_fact_proforama_ds_cab" class="custom-control-label">&nbsp;</label>
                            </div>
                        </td>
                        <td>
                            <div class="custom-control custom-radio text-center">
                                <input type="radio" name="d_fact_proforama_ds" id="d_fact_proforama_ds_gc" class="custom-control-input" value="giac">
                                <label for="d_fact_proforama_ds_gc" class="custom-control-label">&nbsp;</label>
                            </div>
                        </td>
                        <td>
                            <div class="custom-control custom-radio text-center">
                                <input type="radio" name="d_fact_proforama_ds" id="d_fact_proforama_ds_none" class="custom-control-input" value="non préparé" checked>
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
                                <input type="radio" name="d_fact_proforama_if" id="d_fact_proforama_if_cab" class="custom-control-input" value="cabinet">
                                <label for="d_fact_proforama_if_cab" class="custom-control-label">&nbsp;</label>
                            </div>
                        </td>
                        <td>
                            <div class="custom-control custom-radio text-center">
                                <input type="radio" name="d_fact_proforama_if" id="d_fact_proforama_if_gc" class="custom-control-input" value="giac">
                                <label for="d_fact_proforama_if_gc" class="custom-control-label">&nbsp;</label>
                            </div>
                        </td>
                        <td>
                            <div class="custom-control custom-radio text-center">
                                <input type="radio" name="d_fact_proforama_if" id="d_fact_proforama_if_none" class="custom-control-input" value="non préparé" checked>
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
                                <input type="radio" name="d_propal_DS" id="d_propal_DS_cab" class="custom-control-input" value="cabinet">
                                <label for="d_propal_DS_cab" class="custom-control-label">&nbsp;</label>
                            </div>
                        </td>
                        <td>
                            <div class="custom-control custom-radio text-center">
                                <input type="radio" name="d_propal_DS" id="d_propal_DS_gc" class="custom-control-input" value="giac">
                                <label for="d_propal_DS_gc" class="custom-control-label">&nbsp;</label>
                            </div>
                        </td>
                        <td>
                            <div class="custom-control custom-radio text-center">
                                <input type="radio" name="d_propal_DS" id="d_propal_DS_none" class="custom-control-input" value="non préparé" checked>
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
                                <input type="radio" name="d_propal_IF" id="d_propal_IF_cab" class="custom-control-input" value="cabinet">
                                <label for="d_propal_IF_cab" class="custom-control-label">&nbsp;</label>
                            </div>
                        </td>
                        <td>
                            <div class="custom-control custom-radio text-center">
                                <input type="radio" name="d_propal_IF" id="d_propal_IF_gc" class="custom-control-input" value="giac">
                                <label for="d_propal_IF_gc" class="custom-control-label">&nbsp;</label>
                            </div>
                        </td>
                        <td>
                            <div class="custom-control custom-radio text-center">
                                <input type="radio" name="d_propal_IF" id="d_propal_IF_none" class="custom-control-input" value="non préparé" checked>
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
                                <input type="radio" name="d_cv_consult_miss" id="d_cv_consult_miss_cab" class="custom-control-input" value="cabinet">
                                <label for="d_cv_consult_miss_cab" class="custom-control-label">&nbsp;</label>
                            </div>
                        </td>
                        <td>
                            <div class="custom-control custom-radio text-center">
                                <input type="radio" name="d_cv_consult_miss" id="d_cv_consult_miss_gc" class="custom-control-input" value="giac">
                                <label for="d_cv_consult_miss_gc" class="custom-control-label">&nbsp;</label>
                            </div>
                        </td>
                        <td>
                            <div class="custom-control custom-radio text-center">
                                <input type="radio" name="d_cv_consult_miss" id="d_cv_consult_miss_none" class="custom-control-input" value="non préparé" checked>
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
                <input class="form-control {{ $errors->has('dt_depos_df') ? ' is-invalid' : 'dt_depos_df' }}" value="{{old('dt_depos_df')}}" type="text" name="dt_depos_df" onmouseover="(this.type='date')" id="dt_depos_df" placeholder="Date dépôt demande">
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
                        <input type="checkbox" name="accus_depos" id="accus_depos" class="custom-control-input" value="préparé">
                        <label for="accus_depos" class="custom-control-label">Accusé dépôt</label>
                    </div>
                </div>
            </div>

            <div class="form-group col-12">{{--**************HR**************--}}<hr></div>

            <div class="form-group col-12">
                <h3 class="text-secondary">Accord</h3>
            </div>

            <div class="form-group col-lg-6 col-md-6 col-sm-6 col-12"><label>Date d'accord</label>
                <input class="form-control {{ $errors->has('dt_accord') ? ' is-invalid' : 'dt_accord' }}" value="{{old('dt_accord')}}" type="text" name="dt_accord" onmouseover="(this.type='date')" id="dt_accord" placeholder="Date dépôt demande">
                @if ($errors->has('dt_accord'))
                    <span class="invalid-feedback" role="alert">
                    {{ $errors->first('dt_accord') }}
                    </span>
                @endif
            </div>

          {{-- <div class="form-group col-lg-6 col-md-6 col-sm-6 col-12">
            <label> N° Contrat</label>
            <input class="form-control" type="text" name="n_contrat" id="n_contrat" placeholder="Saisir N° Contrat">
          </div> --}}

            {{-- <div class="form-group col-lg-3 col-md-6 col-12">
            <label for=""></label>
                <div class="custom-control custom-checkbox">
                    <input type="checkbox" name="ct_DS" id="ct_DS" class="custom-control-input" value="Préparé">
                    <label for="ct_DS" class="custom-control-label">Contract DS</label>
                </div>
                <div class="custom-control custom-checkbox">
                    <input type="checkbox" name="ct_IF" id="ct_IF" class="custom-control-input" value="Préparé">
                    <label for="ct_IF" class="custom-control-label">Contract IF</label>
                </div>
            </div> --}}

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
                                <input type="radio" name="ct_DS" id="ct_DS_cab" class="custom-control-input" value="cabinet">
                                <label for="ct_DS_cab" class="custom-control-label">&nbsp;</label>
                            </div>
                        </td>
                        <td>
                            <div class="custom-control custom-radio text-center">
                                <input type="radio" name="ct_DS" id="ct_DS_cl" class="custom-control-input" value="client">
                                <label for="ct_DS_cl" class="custom-control-label">&nbsp;</label>
                            </div>
                        </td>
                        <td>
                            <div class="custom-control custom-radio text-center">
                                <input type="radio" name="ct_DS" id="ct_DS_gc" class="custom-control-input" value="giac">
                                <label for="ct_DS_gc" class="custom-control-label">&nbsp;</label>
                            </div>
                        </td>
                        <td>
                            <div class="custom-control custom-radio text-center">
                                <input type="radio" name="ct_DS" id="ct_DS_none" class="custom-control-input" value="non préparé" checked>
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
                                <input type="radio" name="ct_IF" id="ct_IF_cab" class="custom-control-input" value="cabinet">
                                <label for="ct_IF_cab" class="custom-control-label">&nbsp;</label>
                            </div>
                        </td>
                        <td>
                            <div class="custom-control custom-radio text-center">
                                <input type="radio" name="ct_IF" id="ct_IF_cl" class="custom-control-input" value="client">
                                <label for="ct_IF_cl" class="custom-control-label">&nbsp;</label>
                            </div>
                        </td>
                        <td>
                            <div class="custom-control custom-radio text-center">
                                <input type="radio" name="ct_IF" id="ct_IF_gc" class="custom-control-input" value="giac">
                                <label for="ct_IF_gc" class="custom-control-label">&nbsp;</label>
                            </div>
                        </td>
                        <td>
                            <div class="custom-control custom-radio text-center">
                                <input type="radio" name="ct_IF" id="ct_IF_none" class="custom-control-input" value="non préparé" checked>
                                <label for="ct_IF_none" class="custom-control-label">&nbsp;</label>
                            </div>
                        </td>
                    </tr>
                    <!--END OF : tr-->
                </tbody>
            </table>
            </div>


            <div class="form-group col-lg-3 col-md-6 col-12"><label>Date dépôt contrat</label>
                <input class="form-control {{ $errors->has('dt_dep_contrat') ? ' is-invalid' : '' }}" value="{{old('dt_dep_contrat')}}" type="text" name="dt_dep_contrat" onmouseover="(this.type='date')" id="dt_dep_contrat" placeholder="Date début miss.">
                @if ($errors->has('dt_dep_contrat'))
                    <span class="invalid-feedback" role="alert">
                    {{ $errors->first('dt_dep_contrat') }}
                    </span>
                @endif
            </div>

            <div class="form-group col-lg-3 col-md-6 col-12"><label>Date début mission</label>
                <input class="form-control {{ $errors->has('dt_debut_miss') ? ' is-invalid' : '' }}" value="{{old('dt_debut_miss')}}" type="text" name="dt_debut_miss" onmouseover="(this.type='date')" id="dt_debut_miss" placeholder="Date début miss.">
                @if ($errors->has('dt_debut_miss'))
                    <span class="invalid-feedback" role="alert">
                    {{ $errors->first('dt_debut_miss') }}
                    </span>
                @endif
            </div>
            <div class="form-group col-lg-3 col-md-6 col-12"><label>Date fin mission</label>
                <input class="form-control {{ $errors->has('dt_fin_miss') ? ' is-invalid' : '' }}" value="{{old('dt_fin_miss')}}" type="text" name="dt_fin_miss" id="dt_fin_miss" onmouseover="(this.type='date')" placeholder="Date fin miss.">
                @if ($errors->has('dt_fin_miss'))
                    <span class="invalid-feedback" role="alert">
                    {{ $errors->first('dt_fin_miss') }}
                    </span>
                @endif
            </div>
            <div class="form-group col-lg-3 col-md-6 col-12"><label>Jour homme validé</label>
                <input class="form-control {{ $errors->has('jr_hm_valid') ? ' is-invalid' : '' }}" value="{{old('jr_hm_valid')}}" type="text" name="jr_hm_valid" id="jr_hm_valid" min="0" maxlength="16" onkeypress="return isNumberKey(event)" placeholder="Nb jours">
                @if ($errors->has('jr_hm_valid'))
                    <span class="invalid-feedback" role="alert">
                    {{ $errors->first('jr_hm_valid') }}
                    </span>
                @endif
            </div>
            <div class="form-group col-lg-3 col-md-6 col-12"><label>Budget accordé</label>
                <input class="form-control {{ $errors->has('bdg_accord') ? ' is-invalid' : '' }}" value="{{old('bdg_accord')}}" type="text" name="bdg_accord" id="bdg_accord" min="0" maxlength="15" onkeypress="return isNumberKey(event)" placeholder="en DH (HT)">
                @if ($errors->has('bdg_accord'))
                    <span class="invalid-feedback" role="alert">
                    {{ $errors->first('bdg_accord') }}
                    </span>
                @endif
            </div>
            <div class="form-group col-lg-3 col-md-6 col-sm-6 col-12"><label>Budget en lettre (TTC)</label>
                <input class="form-control {{ $errors->has('bdg_letter') ? ' is-invalid' : '' }}" type="text" name="bdg_letter" id="bdg_letter" min="0" maxlength="200" placeholder="budget (TTC)">
                @if ($errors->has('bdg_letter'))
                    <span class="invalid-feedback" role="alert">
                    {{ $errors->first('bdg_letter') }}
                    </span>
                @endif
            </div>
            <div class="form-group col-lg-3 col-md-6 col-12">
                <label for="prc_cote_part">Poucentage quote part</label>
                <select class="form-control {{ $errors->has('prc_cote_part') ? ' is-invalid' : '' }}" onchange="CalcQuotePart()" name="prc_cote_part" id="prc_cote_part">
                    @php $percent = ["20%", "30%"]; @endphp
                    <option selected disabled><span class="text-danger">*</span></option>
                    @foreach ($percent as $perc)
                        <option value="{{$perc}}">{{$perc}}</option>
                    @endforeach
                </select>
                @if ($errors->has('prc_cote_part'))
                    <span class="invalid-feedback" role="alert">
                        {{ $errors->first('prc_cote_part') }}
                    </span>
                @endif
            </div>
            <div class="form-group col-lg-3 col-md-6 col-12"><label>Quote part entreprise</label><input class="form-control {{ $errors->has('cote_part_entrp') ? ' is-invalid' : 'cote_part_entrp' }}" value="{{old('cote_part_entrp')}}" type="text" name="cote_part_entrp" id="cote_part_entrp" min="0" maxlength="15" onkeypress="return isNumberKey(event)" placeholder="auto calculé.." readonly>
                @if ($errors->has('cote_part_entrp'))
                    <span class="invalid-feedback" role="alert">
                    {{ $errors->first('cote_part_entrp') }}
                    </span>
                @endif
            </div>

            <div class="form-group col-12">{{--**************HR**************--}}<hr></div>

            <div class="form-group col-12">
                <h3 class="text-secondary">Réalisation</h3>
            </div>


            <div class="form-group col-lg-3 col-md-6 col-12">
            <label>{{----}}</label>
            <div class="form-group">
                <div class="custom-control custom-checkbox">
                    <input type="checkbox" name="av_realis_DS" id="av_realis_DS" class="custom-control-input" value="Préparé">
                    <label for="av_realis_DS" class="custom-control-label">Avis de réalisation DS</label>
                </div>
                <div class="custom-control custom-checkbox">
                    <input type="checkbox" name="av_realis_IF" id="av_realis_IF" class="custom-control-input" value="Préparé">
                    <label for="av_realis_IF" class="custom-control-label">Avis de réalisation IF</label>
                </div>
                <div class="custom-control custom-checkbox">
                    <input type="checkbox" name="planing_DS" id="planing_DS" class="custom-control-input" value="Préparé">
                    <label for="planing_DS" class="custom-control-label">Planing DS</label>
                </div>
                <div class="custom-control custom-checkbox">
                    <input type="checkbox" name="planing_IF" id="planing_IF" class="custom-control-input" value="Préparé">
                    <label for="planing_IF" class="custom-control-label">Planing IF</label>
                </div>
            </div>
            </div>
            <div class="form-group col-lg-3 col-md-6 col-12"><label>Date envoi avis</label>
                <input class="form-control {{ $errors->has('dt_envoi_av') ? ' is-invalid' : '' }}" value="{{old('dt_envoi_av')}}" type="text" name="dt_envoi_av" id="dt_envoi_av" onmouseover="(this.type='date')" placeholder="Date fin miss.">
                @if ($errors->has('dt_envoi_av'))
                    <span class="invalid-feedback" role="alert">
                    {{ $errors->first('dt_envoi_av') }}
                    </span>
                @endif
            </div>

            <div class="form-group col-lg-3 col-md-6 col-12">
            <label>Rapport réalisé</label>
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text">
                        <input type="checkbox" name="rpt_realis" id="rpt_realis" value="Préparé">
                    </span>
                </div>
                <input class="form-control {{ $errors->has('dt_fin_realis') ? ' is-invalid' : 'dt_fin_realis' }}" value="{{old('dt_fin_realis')}}" type="text" name="dt_fin_realis" id="dt_fin_realis" onmouseover="(this.type='date')" placeholder="Date réalisation">
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


            <div class="form-group col-lg-3 col-md-6 col-12">
                <label>{{----}}</label>
                <div class="form-group">
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" name="p_garde_DS" id="p_garde_DS" id="p_garde_DS" class="custom-control-input" value="Préparé">
                        <label for="p_garde_DS" class="custom-control-label">Page de garde DS</label>
                    </div>
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" name="p_garde_IF" id="p_garde_IF" id="p_garde_IF" class="custom-control-input" value="Préparé">
                        <label for="p_garde_IF" class="custom-control-label">Page de garde IF</label>
                    </div>
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" name="f2" id="f2" id="f2" class="custom-control-input" value="Préparé">
                        <label for="f2" class="custom-control-label">Formulaire F2</label>
                    </div>
                </div>
            </div>
            <div class="form-group col-lg-3 col-md-6 col-12">
                <label>{{----}}</label>
                <div class="form-group">
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" name="dem_approb_ds" id="dem_approb_ds" id="dem_approb_ds" class="custom-control-input" value="Préparé">
                        <label for="dem_approb_ds" class="custom-control-label">Demande d'approb. DS</label>
                    </div>
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" name="dem_approb_if" id="dem_approb_if" id="dem_approb_if" class="custom-control-input" value="Préparé">
                        <label for="dem_approb_if" class="custom-control-label">Demande d'approb. IF</label>
                    </div>
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" name="model_1" id="model_1" id="model_1" class="custom-control-input" value="Préparé">
                        <label for="model_1" class="custom-control-label">Modèle 1</label>
                    </div>
                </div>
            </div>

            <div class="form-group col-lg-3 col-md-6 col-12">
            <label>Rapport déposé</label>
            <div class="input-group">
                <div class="input-group-prepend">
                <span class="input-group-text">
                    <input type="checkbox" name="rpt_depose" id="rpt_depose" value="Préparé">
                </span>
                </div>
                <input class="form-control {{ $errors->has('dt_depos_rpt') ? ' is-invalid' : 'dt_depos_rpt' }}" value="{{old('dt_depos_rpt')}}" type="text" name="dt_depos_rpt" id="dt_depos_rpt" onmouseover="(this.type='date')" placeholder="Date dépôt">
                    @if ($errors->has('dt_depos_rpt'))
                        <span class="invalid-feedback" role="alert">
                            {{ $errors->first('dt_depos_rpt') }}
                        </span>
                    @endif
            </div>
            </div>

            <div class="form-group col-lg-3 col-md-6 col-12">
            <label>Attestation d'approbation</label>
            <div class="input-group">
                <div class="input-group-prepend">
                <span class="input-group-text">
                    <input type="checkbox" name="at_approb" id="at_approb" value="Préparé">
                </span>
                </div>
                <input class="form-control {{ $errors->has('dt_approb') ? ' is-invalid' : 'dt_approb' }}" value="{{old('dt_approb')}}" type="text" name="dt_approb" id="dt_approb" onmouseover="(this.type='date')" placeholder="Date d'approbation">
                    @if ($errors->has('dt_approb'))
                        <span class="invalid-feedback" role="alert">
                            {{ $errors->first('dt_approb') }}
                        </span>
                    @endif
            </div>
            </div>

            <div class="form-group col-12">{{--**************HR**************--}}<hr></div>

            <div class="form-group col-12 text-center">
                <h4>État du demande</h4>
                <div class="btn-group btn-group-toggle" data-toggle="buttons">
                    <label class="btn btn-warning" name="btnEtat">
                        Initié
                        <i class="fas fa-battery-quarter"></i>
                        <input type="radio" name="etat" id="option1" autocomplete="off" value="initié" checked>
                    </label>
                    <label class="btn btn-warning" name="btnEtat">
                        Instruction dossier
                        <i class="fas fa-hourglass-half"></i>
                        <input type="radio" name="etat" id="option2" autocomplete="off" value="instruction dossier">
                    </label>
                    <label class="btn btn-warning" name="btnEtat">
                        Déposé
                        <i class="fas fa-folder-open"></i>
                        <input type="radio" name="etat" id="option3" autocomplete="off" value="déposé">
                    </label>
                    <label class="btn btn-warning" name="btnEtat">
                        Accordé
                        <i class="fas fa-signature"></i>
                        <input type="radio" name="etat" id="option4" autocomplete="off" onchange="AccordValidate()" value="accordé">
                    </label>
                    <label class="btn btn-warning" name="btnEtat">
                        Réalisé
                        <i class="fas fa-check-square"></i>
                        <input type="radio" name="etat" id="option5" autocomplete="off" onchange="AccordValidate()" value="réalisé">
                    </label>
                    <label class="btn btn-warning" name="btnEtat">
                        Approuvé
                        <i class="fas fa-check-double"></i>
                        <input type="radio" name="etat" id="option6" autocomplete="off" onchange="AccordValidate()" value="approuvé">
                    </label>
                    <label class="btn btn-danger" name="btnEtat">
                        Annulé
                        <i class="fas fa-times"></i>
                        <input type="radio" name="etat" id="option0" autocomplete="off" value="annulé">
                    </label>
                </div>
            </div>

            <div class="form-group col-12"><label>Commentaire</label><textarea class="form-control" type="text" rows="4" name="commentaire" maxlength="4900" placeholder="Commentaire ..">{{old('commentaire')}}</textarea></div>

        </div><!--./row-->
        </div><!--./card-body-->

        <div class="card-footer text-center">
            @if (count($client)!=0)
                <button class="btn bu-add" type="submit" id="add"><i class="fas fa-plus-circle"></i>&nbsp;Ajouter</button>
            @endif
            <a class="btn btn-danger" href="/df"><i class="fas fa-window-close"></i>&nbsp;Annuler</a>
        </div>

        <div class="modal" tabindex="-1" role="dialog" id="msg_error_accord">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                  <div class="modal-header bg-danger text-lite">
                    <h5 class="modal-title">Error Message</h5>
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

        </form>

</div><!-- ./CARD -->



{{-- DROP DOWN SCRIPT --}}
<script type="text/javascript">

$(document).ready(function() {

    //chercher le giac associé au client choisi dans "DF"
    $(document).on('change', '#nrc_e', function() {
      var nrc = $(this).val();

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
    });

    setInterval(() => {
      checkEtat();
      CalcQuotePart();
      CalcBdgAccordTTC();
    },500);

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
